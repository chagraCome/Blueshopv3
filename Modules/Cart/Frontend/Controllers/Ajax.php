<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Ajax.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Ajax_Controller extends Cart_Frontend_Checkout_Preview_Controller {

    public $id;
    public $productModel;

    public function __initialize() {
        $this->id = $this->getRequest()->getId();

        $productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModel = $productModelAdapter->fetchById($this->id);
        if (!$this->productModel instanceof Product_Product_Model) {
            
        }

        if ($this->getRequest()->get('action')) {
            $product_id = $this->id;
            $quantity = $this->getRequest()->getInt('quantity');
            $action = $this->getRequest()->get('action');
            $cart = Cart_Shoppingcart_Model::getInstance();

            try {
                if ($action == 'increment') {
                    if ($product_id > 0 && $quantity == 1) {

                        $productIncart = $cart->incrementQuantityByProductId($product_id, $quantity);

                        $cart->Persist();


                        $currency = new Amhsoft_Currency_Label_Control("");
                        $currency->setValue($cart->getSubTotal());


                        $currencyGrandTotal = new Amhsoft_Currency_Label_Control("");
                        $currencyGrandTotal->setValue($cart->getGrandTotal());

                        $productSubTotal = new Amhsoft_Currency_Label_Control("");
                        $productSubTotal->setValue($productIncart->getSubTotal());


                        $array = array(strip_tags($currency->Render()), strip_tags($currencyGrandTotal->Render()), strip_tags($productSubTotal->Render()));
                        echo json_encode($array);
                        exit;
                    }
                }

                if ($action == 'decrement') {
                    if ($product_id > 0 && $quantity == 1) {

                        $quantity = $quantity * -1;
                        $productIncart = $cart->incrementQuantityByProductId($product_id, $quantity);
                        $cart->Persist();

                        if (!$productIncart instanceof Product_Product_Model) {
                            $currency = new Amhsoft_Currency_Label_Control("");
                            $currency->setValue($cart->getSubTotal());


                            $currencyGrandTotal = new Amhsoft_Currency_Label_Control("");
                            $currencyGrandTotal->setValue($cart->getGrandTotal());

                            $array = array(strip_tags($currency->Render()), strip_tags($currencyGrandTotal->Render()));
                            echo json_encode($array);
                            exit;
                        }

                        $currency = new Amhsoft_Currency_Label_Control("");
                        $currency->setValue($cart->getSubTotal());


                        $currencyGrandTotal = new Amhsoft_Currency_Label_Control("");
                        $currencyGrandTotal->setValue($cart->getGrandTotal());


                        $productSubTotal = new Amhsoft_Currency_Label_Control("");
                        $productSubTotal->setValue($productIncart->getSubTotal());



                        $array = array(strip_tags($currency->Render()), strip_tags($currencyGrandTotal->Render()), strip_tags($productSubTotal->Render()));

                        echo json_encode($array);
                        exit;
                    }
                }
            } catch (Exception $e) {
                $this->getView()->assign('error_msg', $e->getMessage());
            }
        }
    }

    public function __add() {
        $requestedQuantity = $this->getRequest()->getInt('qnt');
        try {
            $cart = Cart_Shoppingcart_Model::getInstance();
            $exist = false;
            if ($cart->productExist($this->id)) {
                $exist = true;
            }
            $cart->addProduct($this->productModel, $requestedQuantity);
            $cart->Persist();
            //cart total
            //add item to cart
            // change total price
            $currencyProduct = new Amhsoft_Currency_Label_Control("");
            $currencyProduct->setValue($this->productModel->getSalePrice());
            $currencyProduct->Render();
            if (!$exist) {
                $var = '<li>
                                        <div class="clearfix">
                                            <!--product image-->
                                            <img class="f_left m_right_10" src="' . $this->productModel->getFirstThumb() . '" width="10%" alt="">
                                            <!--product description-->
                                            <div class="f_left product_description">
                                                <a href="' . $this->productModel->getUrl() . '" class="color_dark m_bottom_5 d_block">' . $this->productModel->getTitle() . '</a>
                                                <span class="f_size_medium">' . _t('Product code') . ':' . $this->productModel->getNumber() . '</span>
                                            </div>
                                            <!--product price-->
                                            <div class="f_left f_size_medium">
                                                <div class="clearfix" style="direction: ltr;">
                                                    ' . $requestedQuantity . ' x <b class="color_dark">' . strip_tags($currencyProduct) . '</b>
                                                </div>
                                                <button class="close_product color_dark tr_hover" data-idproduct="76"><i class="fa fa-times"></i></button>
                                            </div>
                                        </div>
                                    </li>';
            } else {
                $var = '';
            }

            $currencyGrandTotal = new Amhsoft_Currency_Label_Control("");
            $currencyGrandTotal->setValue($cart->getGrandTotal());

            $arrayData = array($cart->getProductsCount(), strip_tags($currencyGrandTotal->Render()), $var);
            echo json_encode($arrayData);
            exit;
        } catch (Exception $e) {
            echo "NO";
        }
    }

    public function __delete() {
        try {
            $cart = Cart_Shoppingcart_Model::getInstance();
            $cart->removeProductByProductId($this->productModel->getId())->Persist();

            $currencyGrandTotal = new Amhsoft_Currency_Label_Control("");
            $currencyGrandTotal->setValue($cart->getGrandTotal());

            $currencySubTotal = new Amhsoft_Currency_Label_Control("");
            $currencySubTotal->setValue($cart->getSubTotal());



            $arrayData = array($cart->getProductsCount(), strip_tags($currencyGrandTotal->Render()), strip_tags($currencySubTotal->Render()));
            echo json_encode($arrayData);
            exit;
        } catch (Exception $e) {
            echo "NO";
        }
    }

    /**
     * Default event
     */
    public function __default() {
        
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>
