<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Modules_Cms_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * Module Installation.
     * @param Amhsoft_System $system
     * @return boolean
     */
    public function onInstall(Amhsoft_System $system) {
        $sql_file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
        try {
            $this->executeSQLFile($sql_file);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $cmsMenu = $system->getMenuContainer()->findMenuByName('Cms');
        $cmsMenu->setLabel(_t("Content Management"));
        $cmsMenu
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Home page design"), "admin.php?module=cms&page=setting"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Block"), "admin.php?module=cms&page=box-preadd"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Blocks"), "admin.php?module=cms&page=box-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Page"), "admin.php?module=cms&page=page-preadd"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Pages"), "admin.php?module=cms&page=page-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Menu Point"), "admin.php?module=cms&page=menu-add"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Menu Points"), "admin.php?module=cms&page=menu-list"));
    }

    /**
     * Update Module
     * @param Amhsoft_System $system
     * @param type $installedVersion
     */
    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        if (version_compare('2.6', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-2.6.sql';
            $this->executeSQLFile($file);
        }
    }

    /**
     * Init RBAC Rule.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms', _t("Content Management"), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Preadd_Controller', _t('Select Box Content Design'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_List_Controller', _t('List all Boxes'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Add_Controller', _t('Add new Box'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Detail_Controller', _t('Show Box Information'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Modify_Controller', _t('Modify Box'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Delete_Controller', _t('Delete Box'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Offline_Controller', _t('Set Box Offline'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Box_Online_Controller', _t('Set Box Online'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_List_Controller', _t('List all Menu Items'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_Add_Controller', _t('Add new Menu Item'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_Modify_Controller', _t('Modify Menu Item'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_Delete_Controller', _t('Delete Menu Item'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_Offline_Controller', _t('Set Menu Item Offline'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Menu_Online_Controller', _t('Set Menu Item Online'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Preadd_Controller', _t('Select Page Content Design'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_List_Controller', _t('List Pages'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Add_Controller', _t('Add new Page'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Modify_Controller', _t('Modify Page'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Delete_Controller', _t('Delete Page'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Offline_Controller', _t('Set Page Offline'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Online_Controller', _t('Set Page Online'), 'Cms'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Cms_Backend_Page_Design_Controller', _t('Design Pages'), 'Cms'));
    }

    /**
     * Table to Backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'cms',
            'cms_block',
            'cms_box',
            'cms_box_lang',
            'cms_main_menu',
            'cms_main_menu_has_cms_site',
            'cms_menu_item',
            'cms_menu_item_lang',
            'cms_page',
            'cms_page_archive',
            'cms_page_category',
            'cms_page_category_lang',
            'cms_page_has_cms_block',
            'cms_page_has_cms_box',
            'cms_page_lang',
            'cms_site',
            'cms_site_has_cms_box',
        );
    }

}

?>
