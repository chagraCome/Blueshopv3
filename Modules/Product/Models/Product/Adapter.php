<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 321 2016-02-04 13:57:41Z amira.amhsoft $
 * $Rev: 321 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-04 14:57:41 +0100 (jeu., 04 févr. 2016) $
 * $Author: amira.amhsoft $
 */
class Product_Product_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Semi_Eav_Adapter {

    /**
     * Model Adapter Construct
     */
    public function __construct() {
        $this->table = 'product';
        $this->className = 'Product_Product_Model';
        $this->map = array(
            'id' => 'id',
            'number' => 'number',
            'price' => 'price',
            'online' => 'online',
            'remote_id' => 'remote_id',
            'insertat' => 'insertat',
            'updateat' => 'updateat',
            'type_id' => 'type_id',
            'entity_set_id' => 'entity_set_id',
            'special_price' => 'special_price',
            'special_price_date_to' => 'special_price_date_to',
            'special_price_date_from' => 'special_price_date_from',
            'manage_stock' => 'manage_stock',
            'quantity' => 'quantity',
            'show_only' => 'show_only',
            'account_id' => 'account_id',
            'is_new' => 'is_new',
            'sort_id' => 'sort_id',
            'show_in_home' => 'show_in_home',
            'show_in_banner' => 'show_in_banner',
            'form_id' => 'form_id',
            'purchasing_price' => 'purchasing_price',
        );
        $this->defineOne2One('user', 'user_id', 'User_User_Model');
        $this->defineOne2One('category', 'category_id', 'Product_Category_Model');
        $this->defineOne2One('manufacturer', 'manufacturer_id', 'Product_Manufacturer_Model');
        $this->defineMany2Many('documents', 'Product_Document_Model', 'product_has_document', 'product_id', 'document_id', false, true);
        $this->defineMany2Many('images', 'Product_Image_Model', 'product_has_image', 'product_id', 'image_id', false, false, 'sortid');
        $this->defineOne2Many('price_table', 'product_id', 'Product_Price_Table_Model', false, false, 'table_quantity');
        parent::__construct();
    }

    /**
     * Save Adapter
     * @param Amhsoft_Data_Db_Model_Interface $object
     * @param type $cascade
     * @return type
     */
    public function save(Amhsoft_Data_Db_Model_Interface $object, $cascade = false) {
        $object->updateat = Amhsoft_Locale::UCTDateTime();
        return parent::save($object, $cascade);
    }

    /**
     * Delete Product
     * @param type $id
     */
    public function deleteById($id) {
        $object = parent::fetchById($id);
        if ($object instanceof Product_Product_Model) {
            $images = $object->getImages();
            foreach ($images as $image) {
                $image->delete();
                Amhsoft_Database::getInstance()->exec("DELETE FROM image WHERE id = " . $image->id);
            }
            if (Amhsoft_System_Module_Manager::isModuleInstalled('Rating')) {
                Amhsoft_Database::getInstance()->exec("DELETE From entity_rating where entity_class='Product_Product_Model' AND entity_id = " . $id);
            }
        }
        parent::deleteById($id);
    }

    /**
     * Language Table Name
     * @return string
     */
    public function getLanguageTableName() {
        return "product_lang";
    }

    /**
     * Get Join Column
     * @return string
     */
    public function getJoinColumn() {
        return "product_id";
    }

    /**
     * Get Lang Map
     * @return type
     */
    public function getLangMap() {
        return array(
            'title' => 'title',
            'description' => 'description',
            'short_description' => 'short_description',
        );
    }

    /**
     * Gets Most Saled Products.
     * @return type
     */
    public function fetchMostSaledProducts($limit = 4) {
        $adapter = new Product_Product_Model_Adapter();
        $adapter->select('COUNT(*) as sale_count');
        $adapter->where('online = 1');
        $adapter->rightJoin('sale_order_item', 'id', 'item_id');
        $adapter->groupBy('id');
        $adapter->orderBy('sale_count DESC');
        $adapter->limit($limit);
        $products = $adapter->fetch();
        return $products;
    }

    /**
     * Gets Most Rated Products.
     * @return type
     */
    public function fetchMostRatedProducts($limit = 4) {
        $adapter = new Product_Product_Model_Adapter();
        $adapter->where('online = 1');
        $adapter->limit($limit);
        $adapter->leftJoin('product_rating_view', 'id', 'entity_id');
        $adapter->where('product.id = product_rating_view.entity_id');
        $adapter->orderby('rate');
        $products = $adapter->fetch();
        return $products;
    }

    /**
     * Get Special Products
     * @return type
     */
    public function fetchSpecialProducts() {
        $cmsConfiguration = new Amhsoft_Config_Table_Adapter("cms_settings");
        $adapter = new Product_Product_Model_Adapter();
        $adapter->where('online = 1');
        $adapter->where('special_price > 0');
        $now = Amhsoft_Locale::UCTDateTime();
        $adapter->where("'$now' > special_price_date_from AND '$now' < special_price_date_to");
        $limit = $cmsConfiguration->getValue('homepage_product_count',4);
        $adapter->limit($limit);
        $products = $adapter->fetch();
        return $products;
    }

    /**
     * Gets Recommended Products
     * @return type
     */
    public function fetchRecommendedProducts() {
        $this->where('online = 1');
        $this->leftJoin("product_recommended", 'id', 'product_id');
        $this->where('product_recommended.product_id = product.id');
        $this->orderBy('id DESC');
        $this->limit(4);
        $products = $this->fetch();
        return $products;
    }

    public function getUid() {
        return 1;
    }

}

?>