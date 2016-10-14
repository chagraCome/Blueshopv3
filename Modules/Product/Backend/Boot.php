<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 482 2016-03-18 11:02:50Z imen.amhsoft $
 * $Rev: 482 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-03-18 12:02:50 +0100 (ven., 18 mars 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Product_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * on Module boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $e = $system->getLoadedModules();
    }

    /**
     * On Module init create backend menu.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $productMenu = $system->getMenuContainer()->findMenuByName('Product');
        $productMenu->setLabel(_t("Inventory"));
        $productMenu
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Categories"), "admin.php?module=product&page=category-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add a Category"), "admin.php?module=product&page=category-add"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Products"), "admin.php?module=product&page=product-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Group Edit"), "admin.php?module=product&page=product-modify-multi-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add a new Product"), "admin.php?module=product&page=product-prepare"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Manufactures"), "admin.php?module=product&page=manufacturer-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Product Sets"), "admin.php?module=eav&page=attributeset-list&entity=1"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Product Attributes"), "admin.php?module=eav&page=attributes-list&entity=1"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Products Settings"), "admin.php?module=product&page=setting"));
    }

    /**
     * Initi RBAC rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product', _t('Product Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Add_Controller', _t('Add Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Delete_Controller', _t('Delete Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_List_Controller', _t('List all Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Modify_Controller', _t('Modify Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Offline_Controller', _t('Offline Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Online_Controller', _t('Online Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Category_Sort_Controller', _t('Sort Product Category'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Document_Add_Controller', _t('Add Product Document'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Document_Delete_Controller', _t('Delete Product Document'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Document_Detail_Controller', _t('Detail Product Document'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Image_Add_Controller', _t('Add Product Image'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Image_Delete_Controller', _t('Delete Product Image'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Image_List_Controller', _t('List all Product Image'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Image_Modify_Controller', _t('Modify Product Image'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Price_Modify_Controller', _t('Modify Product Price'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_List_Controller', _t('List  Products'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Delete_Controller', _t('Delete Product'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Modify_Controller', _t('Modify Product'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Modify_Multi_List_Controller', _t('Group Edit'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Detail_Controller', _t('Product Details'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Online_Controller', _t('Set Product Online'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Offline_Controller', _t('Set Product Offline'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Media_Controller', _t('Manage Product Media'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Grouped_Controller', _t('Manage Grouped Product'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Quicklist_Controller', _t('Product Quicklist'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Marketing_Controller', _t('Marketing Product'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Offlineproduct_Controller', _t('List Offline Products'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Specialproduct_Controller', _t('List Special Products'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Product_Configuration_Controller', _t('Manage Product Configuration'), 'Product'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Product_Backend_Setting_Controller', _t('Setting Product'), 'Product'));
    }

    /**
     * Module Install method.
     * @param Amhsoft_System $system
     * @return boolean
     */
    public function onInstall(Amhsoft_System $system) {
        $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
        try {
            $this->executeSQLFile($file);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Translation
     * @param Amhsoft_System $system
     * @param type $module
     */
    public function initTranslation(Amhsoft_System $system, $module = null) {
        parent::initTranslation($system, $module);
        parent::initTranslation($system, 'Eav'); //translate also eav module.
    }

    /**
     * Folder to backup
     * @return type
     */
    public function getFolderToBackup() {
        return array('media/product/image');
    }

    /**
     * Tables to backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'product',
            'product_category',
            'product_category_lang',
            'product_category_view',
            'product_comment',
            'product_configuration',
            'product_configuration_has_product',
            'product_configuration_has_product_attribute',
            'product_cross_selling',
            'product_hast_grouped_product',
            'product_has_document',
            'product_has_image',
            'product_has_product_category',
            'product_has_related_product',
            'product_lang',
            'product_pivot_ar',
            'product_pivot_en',
            'product_table_price',
            'product_has_related_product',
            'product_up_selling',
            'document?LEFT JOIN product_has_document ON document.id=product_has_document.document_id',
            'image?LEFT JOIN product_has_image ON image.id=product_has_image.image_id',
            'setting?WHERE entity = \'product\''
        );
    }

    /**
     * On update Module
     * @param Amhsoft_System $system
     * @param type $installedVersion
     */
    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        if (version_compare('1.1', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.1.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('1.2', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.2.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('1.3', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.3.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('1.4', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.4.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('1.5', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.5.sql';
            $this->executeSQLFile($file);
        }

        if (version_compare('1.6', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.6.sql';
            $this->executeSQLFile($file);
        }

        if (version_compare('1.7', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.7.sql';
            $this->executeSQLFile($file);
        }

        if (version_compare('1.8', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.8.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('1.9', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-1.9.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('2.1', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-2.1.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('2.2', $installedVersion, '>')) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-2.2.sql';
            $this->executeSQLFile($file);
        }
    }

}

?>