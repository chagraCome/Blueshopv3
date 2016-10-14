<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 490 2016-05-17 10:39:49Z montassar.amhsoft $
 * $Rev: 490 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-05-17 12:39:49 +0200 (mar., 17 mai 2016) $
 * $LastChangedDate: 2016-05-17 12:39:49 +0200 (mar., 17 mai 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Product_Frontend_Detail_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Product_Model $productModel */
    private $productModel;
    private $id;

    /**
     * Initialize Controller
     * @throws Amhsoft_Item_Not_Found_Exception
     */
    public function __initialize() {
        $this->id = $this->getRequest()->getId();
        if ($this->id <= 0) {
            new InvalidArgumentException('id ist invalid', 0, null);
        }
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->where('online = 1');
        $this->productModel = $productModelAdapter->fetchById($this->id);
        if (!$this->productModel instanceof Product_Product_Model) {
            throw new Amhsoft_Item_Not_Found_Exception('Product not found');
        }
        $this->_title = $this->productModel->getTitle();
        $this->_description = $this->productModel->getShortDescription();
        $this->_keywords = $this->productModel->getKeywords();
    }

    /**
     * Default event
     */
    public function __default() {
        
    }

    /**
     * Add to Cart event
     */
    public function __cart() {
        $this->addToCart();
    }

    /**
     * Get Quotation event
     */
    public function __getQuotation() {
        if ($this->getRequest()->isGet('getquotation')) {
            $qnt = $this->getRequest()->getInt('qnt');
            if ($this->id <= 0 || $qnt <= 0) {
                new InvalidArgumentException('id or qnt is not valid', 0, null);
            }
            $array = array();
            $array[] = array(
                'id' => $this->id,
                'qnt' => $qnt
            );
            Amhsoft_Registry::register('quotation_products', $array);
            $this->getRedirector()->go('index.php?module=quotation&page=preview');
        }
    }

    /**
     * Get Attributes relation
     * @return string
     */
    protected function getAttributeRelations() {
        $start = microtime(true);
        $confidsql = "SELECT product_configuration_id FROM product_configuration_has_product WHERE product_id = " . $this->id;
        $stmt = Amhsoft_Database::getInstance()->query($confidsql);
        $stmt->execute();
        $configruationid = $stmt->fetchColumn();
        $attributeModelAdapter = new Eav_Attribute_Model_Adapter();
        $attributeModelAdapter->leftJoin('product_configuration_has_product_attribute', 'id', 'product_attribute_id');

        $attributeModelAdapter->where('product_configuration_id = ?', $configruationid);
        $result = $attributeModelAdapter->fetch();
        $selected_attributes = array();
        $j = 0;
        while ($attribute = $result->fetch()) {
            $selected_attributes[$j]['name'] = $attribute->getName();
            $selected_attributes[$j]['label'] = $attribute->getLabel();
            $selected_attributes[$j]['type'] = $attribute->entity_attribute_type_backend_id;
            foreach ($attribute->datasources as $src) {
                $selected_attributes[$j]['src'][] = $src;
            }
            $j++;
        }
        $combinations = array();
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
        $productModelAdapter->where('product_configuration_has_product.product_configuration_id = ?', $configruationid);
        $product_result = $productModelAdapter->fetch();
        $i = 0;
        while ($product = $product_result->fetch()) {
            if ($product->online == 1) {
                $combinations[$i]['product_id'] = $product->getId();
                $combinations[$i]['product_link'] = $product->getUrl();
                foreach ($selected_attributes as $attr) {
                    $value = $product->{$attr['name']};
                    $combinations[$i][$attr['name']] = $value;
                }
                $i++;
            }
        }
        $str = "";
        $i = 0;

        foreach ($selected_attributes as $attribute) {
            if ($attribute['type'] == 21) { //color
                $source = $this->getColorSource($combinations, $attribute['name']);
                $source = array_unique($source);
            } else {
                $source = @$attribute['src'];
            }
            $str .= $attribute['label'] . "<select name='" . $attribute['name'] . "' id='attribute_select'>";

            foreach ((array) $source as $src) {

                $oldsrc = null;

                $res = $this->isAttributeValueExists($combinations, $attribute['name'], $src, $selected_attributes, $i);


                if ($attribute['type'] == 21) {
                    $oldsrc = $src;
                    $src = "<div  style='height:20px; width:20px; border:1px solid silver; background-color: #$src'></div> ";
                }

                if ($res !== false) {
                    if (@$src->id == $this->productModel->{$attribute['name']} || $src == $this->productModel->{$attribute['name']} || $oldsrc == $this->productModel->{$attribute['name']}) {
                        $str .='<option selected="selected" value="' . $res['product_link'] . '">' . $src . '</option>';
                    } else {
                        $str .='<option value="' . $res['product_link'] . '">' . $src . '</option>';
                    }
                }
            }
            $str .= '</select>';
            $i++;
        }

        return $str;
    }

    /**
     * Event/action print
     */
    public function __print() {
        $this->getView()->assign('item', $this->productModel);
        echo '<script type="text/javascript">window.print();</script>';
        $this->popup("Modules/Product/Frontend/Views/popup-print.tpl.html");
        exit;
    }

    /**
     * Get color source
     * @param type $combinations
     * @param type $attribute_name
     * @return type
     */
    protected function getColorSource($combinations, $attribute_name) {
        $src = array();
        foreach ($combinations as $combi) {
            $src[] = $combi[$attribute_name];
        }
        return $src;
    }

    /**
     * Check if attribute value exist
     * @param type $combinations
     * @param type $attribute_name
     * @param type $attribute_value
     * @param type $selected_attributes
     * @param type $count
     * @return boolean
     */
    protected function isAttributeValueExists($combinations, $attribute_name, $attribute_value, $selected_attributes, $count) {
        if ($count == 0) {
            foreach ($combinations as $combi) {
                if (isset($combi[$attribute_name]) && ($combi[$attribute_name] == $attribute_value || $combi[$attribute_name] == @$attribute_value->id)) {
                    return $combi;
                }
            }
            return false;
        } else {

            foreach ($combinations as $combi) {
                $notfound = true;
                for ($i = 0; $i < $count; $i++) {
                    if ($this->productModel->{$selected_attributes[$i]['name']} == $combi[$selected_attributes[$i]['name']]) {

                        $notfound &= false;
                    } else {
                        break;
                    }
                }
                if ($notfound == false) {
                    if ($combi[$attribute_name] == $attribute_value || $combi[$attribute_name] == $attribute_value->id) {
                        return $combi;
                    }
                }
            }
            return false;
        }
    }

    /**
     * Add to cart
     */
    public function addToCart() {
        $requestedQuantity = $this->getRequest()->getInt('qnt');
        try {
            $cart = Cart_Shoppingcart_Model::getInstance();
            //$cart->reset();
            $cart->addProduct($this->productModel, $requestedQuantity);
            $cart->Persist();
            //$this->getRedirector()->go('index.php?module=form&page=data&setid='.$this->productModel->form_id);
            $this->getRedirector()->go('index.php?module=cart&page=list&ret=true');
        } catch (ShoppingCart_Product_Not_Available_Exception $pNotAvaliableException) {
            $this->getView()->assign('cart_message', $pNotAvaliableException->getMessage());
        } catch (Product_NoEnougthQuantity_Exception $q) {
            $this->getView()->assign('cart_message', $q->getMessage());
        } catch (Exception $e) {
            $this->getView()->assign('cart_message', $e->getMessage());
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $html = $this->getAttributeRelations();
        $this->getView()->assign('attrs', $html);
        if (Amhsoft_System_Module_Manager::isModuleInstalled('Rating')) {
            Modules_Rating_Frontend_Boot::getRating('product_rating_block', $this->id);
        }
        $this->getView()->assign('product', $this->productModel);
        $this->show();
    }

}

?>
