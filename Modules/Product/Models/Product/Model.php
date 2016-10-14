<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Product_Model extends Amhsoft_Data_Db_Model_Semi_Eav_Model implements Amhsoft_Data_Db_Model_Interface/* , IImportable */ {

    public $id;
    public $title;
    public $number;
    public $description;
    public $price;
    public $special_price;
    public $special_price_date_to;
    public $special_price_date_from;
    public $sort_id;
    public $online;
    public $remote_id;
    public $insertat;
    public $updateat;
    public $manage_stock;
    public $quantity;
    public $account_id;
    public $user_id;
    public $short_desc;
    public $is_new;
    public $short_description;
    public $show_in_home;
    public $show_in_banner;
    public $form_id;
    public $tax_id;
    public $purchasing_price;
	public $entity_set_id;

    /** @var Setting_Tax_Model $tax * */
    public $tax;

    /** @var Product_Category_Model $category */
    public $category;
    public $type_id = 1; //default value: simple product
    public $images = array();
    public $documents = array();
    public $price_table = array();
    /*     * @var Product_Manufacturer_Model $manufacturer * */
    public $manufacturer;
    public $manufacturer_id;

    const SIMPLE = 1;
    const GROUPED = 2;
    const CONFIGURABLE = 3;
    const SERVICE = 4;
    const DOWNLOADBLE = 5;

    public $show_only;

    /**
     * Model Construct
     */
    public function __construct() {
//$this->retrieveAttributesValues();
    }

    /**
     * Gets Entity Set
     * @return Eav_Set_Model set
     */
    public function getEntitySet() {
        //return default set.
        if ($this->entity_set_id > 0) {
            $entitySetAdapte = new Eav_Set_Model_Adapter();
            return $entitySetAdapte->fetchById($this->entity_set_id);
        }
        return new Eav_Set_Model();
    }

    /**
     * Gets Short Description
     * @param type $maxCount
     * @return type
     */
    public function getShortDesc($maxCount = 100) {
        if (NULL == $this->short_desc) {
            $this->short_desc = htmlspecialchars_decode($this->getDescription());
            $this->short_desc = strip_tags($this->short_desc);
            $this->short_desc = mb_substr($this->short_desc, 0, $maxCount);
        }
        return $this->short_desc . '...';
    }

    /**
     * Save Amount
     * @return boolean
     */
    public function getSaveAmount() {
        if ($this->isOffered()) {
            $saveAmount = $this->getPrice() - $this->getSpecialPrice();
            return $saveAmount;
        }
        return false;
    }

    /**
     * Get Amount Percent 
     * @return type
     */
    public function getPercentSaveAmount() {
        return floor((($this->getPrice() - $this->getSalePrice()) / $this->getPrice()) * 100);
    }

    /**
     * Check of new
     * @return type
     */
    public function isNew() {
        $insertAtPlus3 = Amhsoft_Locale::DateAdd($this->updateat, 0, 0, 0, 3);
        return strtotime($insertAtPlus3) > strtotime(Amhsoft_Locale::UCTDateTime());
    }

    public function __get($name) {
// return firstuhmb link for datagridview.
        if ($name == 'firstthumb') {
            return $this->getFirstThumb();
        }
// return saleprice (we dont have field in db called saleprice , so its help on databinding).
        if ($name == 'saleprice') {
            return $this->getSalePrice();
        }

        if (preg_match("/_value$/", $name)) {
            $_name = str_replace('_value', '', $name);
            return $this->getAttributeValue($_name);
        }
    }

    /**
     * Sets product id.
     * @param Integer $id
     * @return Product_Product_Model $product
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets Product id.
     * @return Integer $id
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets Product title.
     * @param String $title
     * @return Product_Product_Model
     */
    public function setTitle($title) {
        $this->title = $title;
        return $this;
    }

    /**
     * Gets Product title.
     * @return String $title
     */
    public function getTitle() {
        return htmlspecialchars_decode($this->title);
    }

    /**
     * Sets Product number.
     * @param String $number
     * @return Product_Product_Model
     */
    public function setNumber($number) {
        $this->number = $number;
        return $this;
    }

    /**
     * Gets Product number.
     * @return String $number
     */
    public function getNumber() {
        return $this->number;
    }

    public function hasDocument() {
        return !empty($this->documents);
    }

    /**
     * Sets Product price.
     * @param String $price
     * @return Product_Product_Model
     */
    public function setPrice($price) {
        $this->price = $price;
        return $this;
    }

    /**
     * Gets Product price.
     * @return String $price
     */
    public function getPrice() {
        return $this->price;
    }

    /**
     * Sets sort_id.
     * @param <type> sort_id
     * @return Product
     */
    public function setSortId($sort_id) {
        $this->sort_id = $sort_id;
        return $this;
    }

    /**
     * Gets sort_id.
     * @return <type> sort_id
     */
    public function getSortId() {
        return $this->sort_id;
    }

    /**
     * Sets Product online.
     * @param Integer $online
     * @return Product_Product_Model
     */
    public function setOnline($online) {
        $this->online = $online;
        return $this;
    }

    /**
     * Gets Product online.
     * @return Integer $online
     */
    public function getOnline() {
        return $this->online;
    }

    /**
     * Gets product type
     * @return int product type
     */
    public function getProductType() {
        return $this->type_id;
    }

    /**
     * Sets Product description.
     * @param String $description
     * @return Product_Product_Model
     */
    public function setDescription($description) {
        $this->description = $description;
        return $this;
    }

    /**
     * Gets Product description.
     * @return String $description
     */
    public function getDescription() {
        return $this->description;
    }

    public function setShortDescription($short_description) {
        $this->short_description = $short_description;
        return $this;
    }

    public function getShortDescription() {
        return strip_tags($this->short_description);
    }

    /**
     * TODO: not implemented (we must discuss first, let it PENDING)
     * @return \Crm_Account_Model
     */
    public function getOwner() {
        return new Crm_Account_Model();
    }

    /**
     * Sets category_id.
     * @param int category_id
     * @return Product
     */
    public function setCategoryId($category_id) {
        $this->category_id = $category_id;
        return $this;
    }

    /**
     * Gets category_id.
     * @return int category_id
     */
    public function getCategoryId() {
        return $this->category_id;
    }

    /**
     * Gets Category
     * @return Product_Category_Model category
     */
    public function getCategory() {
        return $this->category;
    }

    /**
     * Sets Product remote_id.
     * @param Integer $remote_id
     * @deprecated since version 1.0
     * @return Product_Product_Model
     */
    public function setRemoteId($remote_id) {
        $this->remote_id = $remote_id;
        return $this;
    }

    /**
     * Gets Product remote_id.
     * @deprecated since version 1.0
     * @return Integer $remote_id
     */
    public function getRemoteId() {
        return $this->remote_id;
    }

    /**
     * Gets insert date time
     * @return string insert date time
     */
    public function getInsertat() {
        return $this->insertat;
    }

    /**
     * Sets insert date time
     * <code>
     * $productModel->setInsertat(Amhsoft_Locale::UCTDateTime());
     * </code>
     * @param string $insertat
     * @return \Product_Product_Model
     */
    public function setInsertat($insertat) {
        $this->insertat = $insertat;
        return $this;
    }

    /**
     * Gets update date time.
     * @return string update date time
     */
    public function getUpdateat() {
        return $this->updateat;
    }

    /**
     * Sets update date time.
     * <code>
     * $productModel->setUpdateat(Amhsoft_Locale::UCTDateTime());
     * </code>
     * @param string $updateat
     * @return Product_Product_Model $productModel
     */
    public function setUpdateat($updateat) {
        $this->updateat = $updateat;
        return $this;
    }

    /**
     * Gets images.
     * <code>
     * foreach($productModel->getImages() as $image)
     * {
     *    echo $image->getSrc();
     * }
     * </code>
     * @return array product images
     */
    public function getImages() {
        return $this->images;
    }

    /**
     * Add image to prodcut
     * @param Product_Image_Model $image
     * @return Product_Product_Model $productModel
     */
    public function addImage(Product_Image_Model $image) {
        $this->images[] = $image;
        return $this;
    }

    /**
     * Gets product documents.
     * @return array $documents
     */
    public function getDocuments() {
        return $this->documents;
    }

    /**
     * Add document to product.
     * @param Product_Document_Model $documents
     * @return Product_Product_Model $productModel
     */
    public function addDocument(Product_Document_Model $documents) {
        $this->documents[] = $documents;
        return $this;
    }

    /**
     * Get URL
     * @param boolean $full
     * @return string URL
     */
    public function getUrl($full = false) {
        $url = rtrim(Amhsoft_System_Config::getProperty("appurl"), '/') . '/';
        if ((bool) Amhsoft_System_Config::getProperty('url_friendly', false) == true) {
            $title = Amhsoft_Common::remove_bad_chars_from_word($this->getTitle());
            if ($this->getCategory()) {
                $url .= Amhsoft_Common::remove_bad_chars_from_word($this->getCategory()->getName()) . 'c/' . $this->id . '-' . $title . '.html';
            } else {
                $url .= 'index.php?module=product&amp;page=detail&amp;id=' . $this->id;
            }
        } else {
            $url .= 'index.php?module=product&amp;page=detail&amp;id=' . $this->id;
        }
        return $url;
    }

    /**
     *
     * @return <type>
     */
    public function getFirstBig() {
        if (isset($this->images[0])) {
            return $this->images[0]->getBig();
        }
    }

    /**
     * Gets First Thumb
     * @return type
     */
    public function getFirstThumb() {
        if (isset($this->images[0])) {
            return $this->images[0]->getThumb();
        } else {
            $productModelAdapter = new Product_Product_Model_Adapter();
            $productModel = $productModelAdapter->fetchById($this->id);
            if ($productModel instanceof Product_Product_Model) {
                if (isset($productModel->images[0])) {
                    return $productModel->images[0]->getThumb();
                }
            }
        }
    }

    /**
     * Get First Big Image
     * @return type
     */
    public function getFirstBigAbsolute() {
        if (isset($this->images[0])) {
            return $this->images[0];
        }
    }

    public function __toString() {
        return $this->getTitle();
    }

    /**
     * Get Products related to GroupedProduct
     * @return array of Product_Product_Model
     */
    public function getGroupedProducts() {
        if (!$this->isGrouped()) {
            return array();
        }
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->leftJoin('product_hast_grouped_product', 'id', 'product_id');
        $productModelAdapter->where('product_hast_grouped_product.grouped_id = ?', $this->getId());
        if ($productModelAdapter->getCount() == 0) {
            return array();
        }
        $products = array();
        $res = $productModelAdapter->fetch();
        while ($p = $res->fetch()) {

            $products[] = $p;
        }
        return $products;
    }

    /**
     * Get Cross Products
     * @return array of Product_Product_Model
     */
    public function getCrossProducts($onlyOnline = true) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        if ($onlyOnline == true) {
            $productModelAdapter->where('online =1');
        }
        $productModelAdapter->leftJoin('product_cross_selling', 'id', 'cross_id');
        $productModelAdapter->where('product_cross_selling.product_id = ?', $this->getId());
        $result = $productModelAdapter->fetch();
        $array = array();
        while ($rel = $result->fetch()) {
            $array[] = $rel;
        }
        return $array;
    }

    /**
     * Get Upselling Products
     * @return array of Product_Product_Model
     */
    public function getUpProducts($onlyOnline = true) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        if ($onlyOnline == true) {
            $productModelAdapter->where('online =1');
        }
        $productModelAdapter->leftJoin('product_up_selling', 'id', 'up_id');
        $productModelAdapter->where('product_up_selling.product_id = ?', $this->getId());
        $result = $productModelAdapter->fetch();
        $array = array();
        while ($rel = $result->fetch()) {
            $array[] = $rel;
        }
        return $array;
    }

    /**
     * Get Related Products
     * @return array of Product_Product_Model
     */
    public function getRelatedProducts($setid = 0, $onlyOnline = true) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        if ($onlyOnline == true) {
            $productModelAdapter->where('online =1');
        }
        $productModelAdapter->leftJoin('product_has_related_product', 'id', 'related_product_id');
        $productModelAdapter->where('product_has_related_product.product_id = ?', $this->getId());
        if ($setid > 0) {
            $productModelAdapter->where('product.set_id = ?', $setid);
        }
        $array = array();
        $result = $productModelAdapter->fetch();
        while ($rel = $result->fetch()) {
            $array[] = $rel;
        }
        return $array;
    }

    /**
     * Add cross product 
     * @param int $crossProductId 
     */
    public function addCrossProduct($productId) {
        if ($productId <= 0) {
            return false;
        }
        try {
            $sql = "INSERT INTO product_cross_selling VALUES(:pid, :rid)";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);
            $stmt->bindValue(':pid', $this->getId());
            $stmt->bindParam(':rid', $productId);
            $stmt->execute();
        } catch (Exception $e) {
            Amhsoft_Log::error('Error when assigning product coss selling with proudct id = ' . $productId);
            return false;
        }
    }

    /**
     * Add up product 
     * @param int $crossProductId 
     */
    public function addUpSellingProduct($productId) {
        if ($productId <= 0) {
            return false;
        }
        try {
            $sql = "INSERT INTO product_up_selling VALUES(:pid, :rid)";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);
            $stmt->bindValue(':pid', $this->getId());
            $stmt->bindParam(':rid', $productId);
            $stmt->execute();
        } catch (Exception $e) {
            Amhsoft_Log::error('Error when assigning product up selling with proudct id = ' . $productId);
            return false;
        }
    }

    /**
     * Add related product 
     * @param int $crossProductId 
     */
    public function addRelatedProduct($productId) {
        if ($productId <= 0) {
            return false;
        }
        try {
            $sql = "INSERT INTO product_has_related_product VALUES(:pid, :rid)";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);
            $stmt->bindValue(':pid', $this->getId());
            $stmt->bindParam(':rid', $productId);
            $stmt->execute();
        } catch (Exception $e) {
            Amhsoft_Log::error('Error when adding Related product with proudct id = ' . $productId);
            return false;
        }
    }

    /**
     * Add up product 
     * @param int $crossProductId 
     */
    public function addGroupedProduct($productId) {
        if ($productId <= 0) {
            return false;
        }
        try {
            $sql = "INSERT INTO product_hast_grouped_product VALUES(:pid, :rid)";
            $stmt = Amhsoft_Database::getInstance()->prepare($sql);
            $stmt->bindValue(':pid', $this->getId());
            $stmt->bindParam(':rid', $productId);
            $stmt->execute();
        } catch (Exception $e) {
            Amhsoft_Log::error('Error when addGroupedProduct with proudct id = ' . $productId);
            return false;
        }
    }

    /**
     * Gets sepcial price of the product.
     * @return double sepcial price of product
     */
    public function getSpecialPrice() {
        return $this->special_price;
    }

    /**
     * Sets sepecial price for product.
     * @param double $special_price
     * @return Product_Product_Model $productModel
     */
    public function setSpecialPrice($special_price) {
        $this->special_price = $special_price;
        return $this;
    }

    /**
     * Gets special price end date.
     * @return string special price to date
     */
    public function getSpecialPriceDateTo() {
        return $this->special_price_date_to;
    }

    /**
     * Sets the end date of the special price.
     * @param date $special_price_date_to
     * @return Product_Product_Model $productModel
     */
    public function setSpecialPriceDateTo($special_price_date_to) {
        $this->special_price_date_to = $special_price_date_to;
        return $this;
    }

    /**
     * Gets the start date of the special price.
     * @return string @special_price_date_from
     */
    public function getSpecialPriceDateFrom() {
        return $this->special_price_date_from;
    }

    /**
     * Sets the special price start date.
     * @param string $special_price_date_from
     * @return Product_Product_Model $productModel
     */
    public function setSpecialPriceDateFrom($special_price_date_from) {
        $this->special_price_date_from = $special_price_date_from;
        return $this;
    }

    /**
     * Check if manage stock for this product is enabled.
     * @return boolean $manage_stock
     */
    public function getManageStock() {
        return $this->manage_stock == true;
    }

    /**
     * Enable or Disable Stockmanagement for this product.
     * @param boolean $manage_stock
     * @return Product_Product_Model $productModel
     */
    public function setManageStock($manage_stock) {
        $this->manage_stock = $manage_stock;
        return $this;
    }

    /**
     * Gets the available quantity for product.
     * @return int $product_quantity
     */
    public function getQuantity() {
        return $this->quantity;
    }

    /**
     * Sets the available quantity for product.
     * @param type $quantity
     * @return Product_Product_Model $productModel
     */
    public function setQuantity($quantity) {
        $this->quantity = $quantity;
        return $this;
    }

    /**
     * Gets the table price
     * Quantitiy <-> price
     * @return array table price
     */
    public function getPriceTable() {
        return (array) $this->price_table;
    }

    /**
     * @deprecated since version 1.0
     * @return boolean
     */
    public function isGrouped() {
        return $this->type_id == self::GROUPED;
    }

    public function isService() {
        return $this->type_id == self::SERVICE;
    }

    public function isTangible() {
        return $this->type_id == self::SIMPLE;
    }

    public function isDownloadable() {
        return $this->type_id == self::DOWNLOADBLE;
    }

    public function isConfigurable() {
        return $this->type_id == self::CONFIGURABLE;
    }

    public function isShowOnly() {
        return $this->show_only == true;
    }

    /**
     * Gets Unit price depends on shopping cart quantity of the same item
     * and depend on table price quantity vs price
     * if not table price for this product then return sale price.
     * @param int $shopping_cart_quantity
     */
    public function getUnitPrice() {
        if (!$this->hasTablePrice()) {
            return $this->getSalePrice();
        } else {
            $price = $this->getSalePrice();
            $tables = array_reverse($this->getPriceTable());
            foreach ($tables as $table) {
                if ($this->quantity_in_cart >= $table->table_quantity) {
                    $price = $table->table_price;
                    return $price;
                }
            }
            return $price;
        }
    }

    public function hasTablePrice() {
        return count($this->getPriceTable()) > 0;
    }

    public function getSubTotal() {
        return $this->getUnitPrice() * $this->quantity_in_cart;
    }

    /**
     * Gets sale price, if the product is offered then retrun the offerprice
     * otherwise return the regular price
     * @return double $price
     */
    public function getSalePrice() {
        if ($this->isOffered()) {
            return (double) $this->getSpecialPrice();
        } else {
            return (double) $this->getPrice();
        }
    }

    /**
     * Check if the product is offered, and the offer time is not exited!
     * @return bool $offered
     */
    public function isOffered() {
        if ((double) $this->special_price <= 0) {
            return false;
        }
        if (strtotime(Amhsoft_Locale::UCTDateTime()) > strtotime($this->getSpecialPriceDateFrom()) && strtotime(Amhsoft_Locale::UCTDateTime()) < strtotime($this->getSpecialPriceDateTo())) {
            return true;
        } else {
            return false;
        }
    }

    /**
     * Product has Price table
     * @return type
     */
    public function hasPriceTable() {
        return !empty($this->price_table);
    }

    /**
     * New Quantity = Old Quantity + $quantity
     * @param int $quantiy
     */
    public static function liveIncrementQuantity($db, $productId, $quantity) {
        $productAdapter = new Product_Product_Model_Adapter();
        $product = $productAdapter->fetchById($productId);
        if (!$product instanceof Product_Product_Model) {
            throw new Exception(_t('Product was deleted'));
        }
        if (!self::isGlobalStockManagementEnabled() || !$product->getManageStock()) {
            return;
        }
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            throw new Exception(_t('Given quantity must be greater than 0'));
        }
        $product->quantity += $quantity;
        $db->exec("UPDATE product set quantity = '" . $product->quantity . "' WHERE id = " . $product->id);
    }

    /**
     * Check if Glabal stock managment is enabled
     * @return type
     */
    public static function isGlobalStockManagementEnabled() {
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        return $productConfig->getIntValue('stock_enable_auto_stk_management') == 1;
    }

    /**
     * New Quantity = Old Quantity - $quantity
     * @param type $quantity
     */
    public static function liveDecrementQuantity($connection, $productId, $quantity) {
        $productAdapter = new Product_Product_Model_Adapter();
        $product = $productAdapter->fetchById($productId);
        if (!$product instanceof Product_Product_Model) {
            throw new Exception(_t('Product was deleted'));
        }
        if (!self::isGlobalStockManagementEnabled() || !$product->getManageStock()) {
            return;
        }
        $quantity = intval($quantity);
        if ($quantity <= 0) {
            throw new Exception(_t('Given quantity must be greater than 0' . $product->getTitle() . '[' . $product->getNumber() . ']'));
        }
        if ($product->quantity < 1 || $product->quantity < $quantity) {
            throw new Product_NoEnougthQuantity_Exception(_t('No enougth quantity for %s, max quantity is %s', array($product->title, $product->quantity)));
        }
        $product->quantity -= $quantity;
        $connection->exec("UPDATE product set quantity = '" . $product->quantity . "' WHERE id = " . $product->id);

        /** if quantity alert is enabled we must check the product quantity after live decrement * */
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        $minQuantity = $productConfig->getValue('stock_alert_min_qty');
        if (intval($minQuantity) > 0) {
            if ($product->getQuantity() < $minQuantity) {
                $notificationModel = new Product_Notification_Model();
                $notificationModel->notifyNotEnoughQuantity($product);
            }
        }
    }

    /**
     * Check the availebel Quantitty
     * @param type $product_id
     * @param type $quantity
     * @return boolean
     */
    public static function checkAvailableQuantity($product_id, $quantity) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModel = $productModelAdapter->fetchById($product_id);
        if (!$productModel instanceof Product_Product_Model) {
            return false;
        }
        return $productModel->getQuantity() > 0 && $productModel->getQuantity() >= $quantity;
    }

    /**
     * Ckeck if stock manage is enabled
     * @param type $product_id
     * @return boolean
     */
    public static function isManageStockEnabled($product_id) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModel = $productModelAdapter->fetchById($product_id);
        if (!$productModel instanceof Product_Product_Model) {
            return false;
        }
        return ($productModel->manage_stock == 1) && self::isGlobalStockManagementEnabled();
    }

    /**
     * Get Root path
     * @return type
     */
    public function getPathRoot() {
        $array_root = array();
        $array_root[] = array('name' => $this->getTitle(), 'link' => $this->getUrl());
        $cat = $this->getCategory();
        if ($cat) {
            $array_root[] = array('name' => $cat->getName(), 'link' => $cat->getUrl());
            while ($cat->getParent() instanceof Product_Category_Model) {
                $array_root[] = array('name' => $cat->getParent()->getName(), 'link' => $cat->getParent()->getUrl());
                $cat = $cat->getParent();
            }
        }
        return @array_reverse($array_root);
    }

    /**
     * Get product next number
     * @return type
     */
    public function getNextProductNumber() {
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        $prefix = $productConfig->getValue('prefix', 'QOT');
        $start = $productConfig->getValue('start', 1);
        $lastNumber = Amhsoft_Database::querySingle("SELECT `number` FROM product WHERE `number` LIKE '$prefix%' ORDER By id DESC LIMIT 1");
        if (!$lastNumber) {
            return $prefix . $start;
        } else {
            $lastNumberAsInt = str_replace($prefix, '', $lastNumber);
            if ($lastNumberAsInt >= $start) {
                $lastNumberAsInt = intval($lastNumberAsInt) + 1;
                return $prefix . $lastNumberAsInt;
            } else {
                return $prefix . $start;
            }
        }
    }
    /**
     * Get avrege Rating
     * @return type
     */
  public function getAverageRating() {
        $sql = "SELECT AVG(rate) as avg_rating FROM entity_rating where entity_class = 'Product_Product_Model' AND  entity_id = " . $this->getId();
        $stmt = Amhsoft_Database::getInstance()->query($sql);
        return $stmt->fetchColumn();
    }

    /**
     * Gets avrage Rating comments
     * @return type
     */
    public function getAverageRatingComponent($prefix = null) {
        $value = intval($this->getAverageRating());
        $rating = new Amhsoft_Rating_Control($prefix . 'ratingcomponent' . $this->getId());
        $rating->Disabled = true;
        $rating->Value = $value;  
        return $rating->Render();
    }


    /**
     * Set product as New
     * @param type $is_new
     */
    public function setIsnew($is_new) {
        $this->is_new = $is_new;
    }

    /**
     * Get shipping Methods
     * @return type
     */
    public function getEnabledShippingMethods() {
        $sql = "SELECT shipping_id FROM product_has_shipping WHERE product_id = " . $this->getId();
        $rs = Amhsoft_Database::getInstance()->query($sql);
        $shipping_ids = array();
        while ($row = $rs->fetch(PDO::FETCH_ASSOC)) {
            $shipping_ids[] = $row['shipping_id'];
        }
        return $shipping_ids;
    }

    public function getTaxLabel() {
        if ($this->hasTax()) {
            return $this->tax->getLabel();
        }

        return _t('N/A');
    }

    public function getTaxRate() {
        if ($this->hasTax()) {
            return ($this->getSalePrice() * $this->tax->getValue()) / 100;
        }
        return 0;
    }

    public function hasTax() {
        return $this->tax != null;
    }

    /**
     * Sets Product purchasing_price.
     * @param String $purchasing_price
     * @return Product_Product_Model
     */
    public function setPurchasingPrice($purchasing_price) {
        $this->purchasing_price = $purchasing_price;
        return $this;
    }

    /**
     * Gets Product purchasing_price.
     * @return String $purchasing_price
     */
    public function getPurchasingPrice() {
        return $this->purchasing_price;
    }

    public function getPreviewUrl() {
        $url = 'index.php?module=product&amp;ajax=true&amp;page=preview&amp;id=' . $this->id;
        return $url;
    }

    public function getManufacturer() {
        return $this->manufacturer;
    }

    public function getKeyWords() {
        return $this->getTitle();
    }

    public function inCart() {
        $cart = Cart_Shoppingcart_Model::getInstance();
        foreach ($cart->getProducts() as $prod) {
            if ($prod->getId() == $this->getId()) {
                return true;
            }
        }

        return false;
    }

    public function inCompare() {
        $data = Amhsoft_Common::GetCookie('productcompare');
        if ($data) {
            $compareProducts = (array) explode(',', $data);
        }

        foreach ($compareProducts as $pid) {
            if ($pid == $this->getId()) {
                return true;
            }
        }


        return false;
    }

    public function inWhishlist() {
        $data = Amhsoft_Common::GetCookie('productwishlist');
        if ($data) {
            $compareProducts = (array) explode(',', $data);
        }


        foreach ($compareProducts as $pid) {
            if ($pid == $this->getId()) {
                return true;
            }
        }
        return false;
    }

}

?>