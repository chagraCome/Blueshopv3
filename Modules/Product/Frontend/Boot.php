<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 332 2016-02-04 16:18:02Z montassar.amhsoft $
 * $Rev: 332 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-04 17:18:02 +0100 (jeu., 04 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Modules_Product_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $categoryAdapter = new Product_Category_Model_Adapter();
        $categoryAdapter->where('parent_id IS NULL');
        $system->getView()->assign('categorylilst', $categoryAdapter);
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        $cmsConfiguration = new Amhsoft_Config_Table_Adapter("cms_settings");
        $system->getView()->assign("product_setting", $productConfig->getConfiguration());
        try {
            $productViewModelAdapter = new Product_Product_Model_Adapter();
            $productViewModelAdapter->where('online = 1');
            $limit = $cmsConfiguration->getValue('homepage_product_count', 12);
            $productViewModelAdapter->limit($limit);
            $productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
            $productViewModelAdapter->select('*');
            $productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
            $productViewModelAdapter->groupBy('gr');
            $productViewModelAdapter->orderBy('id DESC');
            $latestProducts = $productViewModelAdapter->fetch();
            $system->getView()->assign('specialproducts', $productViewModelAdapter->fetchSpecialProducts());
            $system->getView()->assign('latestproducts', $latestProducts);
            $system->getView()->assign('newproducts', self::fetchNewProducts());
            $system->getView()->assign('mostRatedproducts', $productViewModelAdapter->fetchMostRatedProducts());
            $system->getView()->assign('cat_products', self::getMainCategories());
        } catch (Exception $e) {
            if (preg_match("/product_pivot_en' doesn't exist/i", $e->getMessage())) {
                Amhsoft_Data_Db_Model_Multilanguage_EAV_Adapter::flushEntityPivotView('product', true);
            }
        }
        $data = Amhsoft_Common::GetCookie('productwishlist');
        if ($data) {
            $_data = (array) explode(',', $data);
            $system->getView()->assign('whishlist_items_count', count($_data));
        }
        if (Amhsoft_Common::GetCookie('productcompare') == null) {
            $system->getView()->assign('compare_items_count', 0);
        } else {
            $compare_data = (array) explode(',', Amhsoft_Common::GetCookie('productcompare'));
            $system->getView()->assign('compare_items_count', count($compare_data));
        }
    }

    /**
     * Fetch new Products
     * @return type
     */
    public static function fetchNewProducts() {
        $cmsConfiguration = new Amhsoft_Config_Table_Adapter("cms_settings");
        $productViewModelAdapter = new Product_Product_Model_Adapter();
        $productViewModelAdapter->where('online =1');
        $productViewModelAdapter->where('is_new = 1');
        $limit = $cmsConfiguration->getValue('homepage_product_count', 4);
        $productViewModelAdapter->limit($limit);
        $productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
        $productViewModelAdapter->select('*');
        $productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
        $productViewModelAdapter->groupBy('gr');
        $productViewModelAdapter->orderBy('id DESC');
        return $productViewModelAdapter->fetch();
    }

    /**
     * Get Main Category
     * @return type
     */
    public static function getMainCategories() {
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        $categoryModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
        $categoryModelAdapter->where('state = 1');
        $categoryModelAdapter->orderBy("previous");
        return $categoryModelAdapter->fetch()->fetchAll();
    }

    /**
     * Get Product by Category
     * @param type $categoryID
     * @param type $limit
     * @param type $withSubCategories
     * @return type
     */
    public static function getProductsByCategory($categoryID, $limit, $withSubCategories = false) {
        if ($categoryID <= 0) {
            return array();
        }
        $id_array = array();
        if ($withSubCategories == true) {
            $id_array = Product_Category_Model_Adapter::getChildrenIdArray($categoryID);
        }
        $productViewModelAdapter = new Product_Product_Model_Adapter();
        $productViewModelAdapter->where('online =1');
        $productViewModelAdapter->limit($limit);
        $productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
        $productViewModelAdapter->select('*');
        $productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
        $productViewModelAdapter->groupBy('gr');
        if (empty($id_array)) {
            $productViewModelAdapter->where('category_id = ?', $categoryID);
        } else {
            $id_array[] = $categoryID;
            $cat_str = implode(', ', $id_array);
            $productViewModelAdapter->where('category_id IN  (' . $cat_str . ')');
        }
        $productViewModelAdapter->orderBy('sort_id ASC');
        $result = $productViewModelAdapter->fetch();
        $products = array();
        while ($product = $result->fetch()) {
            $products[] = $product;
        }
        return $products;
    }

    /**
     * Get Product by Category Limit
     * @param type $limit
     * @return type
     */
    public static function getCategories() {
        $categories = self::getMainCategories();
        $data = array();
        foreach ($categories as $cat) {
            $data[] = array('category' => $cat->getName(), 'url' => $cat->getUrl(), 'child' => $cat->getChildern(), 'id' => $cat->getId());
        }
        return $data;
    }

    /**
     * Get Product by Category Limit
     * @param type $limit
     * @return type
     */
    public static function getProductsByCategories($limit = 8) {
        $categories = self::getMainCategories();
        $data = array();
        foreach ($categories as $cat) {
            $products = self::getProductsByCategory($cat->getId(), $limit, true);
            if (!empty($products)) {
                $data[] = array('category' => $cat->getName(), 'child' => $cat->getChildern(), 'id' => $cat->getId(), 'products' => $products);
            }
        }
        return $data;
    }

    /**
     * Get Category Html
     * @param type $catid
     * @return string
     */
    public static function getCategoriesHtml($catid = null) {
        $str_categorytree = '<h3 class="active filterh3">' . _t('Categories') . '</h3><ul class="filter_ul categories">';
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        if ($catid == null) {
            $categoryModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
        } else {
            $categoryModelAdapter->where('parent_id =' . $catid);
        }
        $mainCats = $categoryModelAdapter->fetch()->fetchAll();
        foreach ($mainCats as $mainCat) {
            $str_categorytree .= '<li><a  href="' . $mainCat->getUrl() . '">' . $mainCat->getName() . "</a></li>\n";
        }
        $str_categorytree .= '</ul>';
        return $str_categorytree;
    }

    public static function getManufacturer() {
        $productManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
        $productManufacturerModelAdapter->orderBy('name ASC');
        return $productManufacturerModelAdapter->fetch()->fetchAll();
    }

    public static function getCategoriesByMainCat($id) {
        $adapter = new Product_Category_Model_Adapter();
        $cat = $adapter->fetchById($id);
        if (!$cat instanceof Product_Category_Model) {
            return;
        }

        return $cat->getChildern();
    }

    public static function getCategory($id) {
        $adapter = new Product_Category_Model_Adapter();
        $cat = $adapter->fetchById($id);
        return $cat;
    }

    public static function getMainManifactures() {
        $manufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
        $manufacturerModelAdapter->limit(11);
        return $manufacturerModelAdapter->fetch()->fetchAll();
    }

    public static function getProductsByManifacture($manifactureID, $limit) {
        if ($manifactureID <= 0) {
            return array();
        }
        $id_array = array();
        $productViewModelAdapter = new Product_Product_Model_Adapter();
        $productViewModelAdapter->where('online =1');
        $productViewModelAdapter->limit($limit);
        $productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
        $productViewModelAdapter->select('*');
        $productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
        $productViewModelAdapter->groupBy('gr');
        if (empty($id_array)) {
            $productViewModelAdapter->where('manufacturer_id = ?', $manifactureID);
        } else {
            $id_array[] = $manifactureID;
            $cat_str = implode(', ', $id_array);
            $productViewModelAdapter->where('manufacturer_id IN  (' . $cat_str . ')');
        }
        $result = $productViewModelAdapter->fetch();
        $products = array();
        while ($product = $result->fetch()) {
            $products[] = $product;
        }
        return $products;
    }

    public static function getProductsByManifactures($limit = 3) {
        $manifactures = self::getMainManifactures();
        $data = array();
        foreach ($manifactures as $man) {
            $products = self::getProductsByManifacture($man->getId(), $limit);
            if (!empty($products)) {
                $data[] = array('manifactures' => $man->getName(), 'products' => $products);
            }
        }
        return $data;
    }

    public static function getSuperdeals($limit = 7, $special = false) {
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->where('online = 1');
        $productModelAdapter->orderBy('special_price DESC');

        if ($special == true) {
            $productModelAdapter->where('special_price > 0');
            $productModelAdapter->where('special_price_date_from <= NOW()');
            $productModelAdapter->where('special_price_date_to >= NOW()');
        }

        $productModelAdapter->limit($limit);
        return $productModelAdapter->fetch();
    }

    public static function getNewProducts() {
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->where('online = 1');
        $productModelAdapter->limit(1);
        $productModelAdapter->where('is_new = 1');
        $productModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
        $productModelAdapter->select('*');
        $productModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id)', 'gr');
        $productModelAdapter->groupBy('gr');
        $productModelAdapter->orderBy('id DESC');
        $new_products = $productModelAdapter->fetch();
        return $new_products;
    }

    public static function getHot() {
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->where('online = 1');
        $productModelAdapter->where('is_new = 1');
        $productModelAdapter->orderBy('id DESC');
        $productModelAdapter->limit(20);
        return $productModelAdapter->fetch();
    }

}

?>