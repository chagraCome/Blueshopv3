<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Modules_Saleorder_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * Module Entry Point.
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $system->publishModel('Saleorder_Model', 'Sales Order');
        $system->publishModel('Saleorder_Item_Model', 'Sales Order Item');
        $system->publishModel('Saleorder_Address_Model', 'Sales Order Invoice Address');
        $system->publishModel('Saleorder_Shipping_Address_Model', 'Sales Order Shipping Address');
    }

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $admin = $system->getMenuContainer()->findMenuByName('Saleorder');
        $admin->setLabel(_t("Sales Order"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Today Sales Order"), "admin.php?module=saleorder&page=saleorder-list&event=today"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Accepted Sales Order"), "admin.php?module=saleorder&page=saleorder-list&event=accepted"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Open Sales Order"), "admin.php?module=saleorder&page=saleorder-list&event=open"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Created Sales Order"), "admin.php?module=saleorder&page=saleorder-list&event=created"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Sales Order"), "admin.php?module=saleorder&page=saleorder-list"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add a new Sales Order"), "admin.php?module=saleorder&page=saleorder-add"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Sales Order Comments"), "admin.php?module=saleorder&page=comment-list"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Settings"), "admin.php?module=saleorder&page=setting"));
    }

    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder', _t('Sales Order Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Comment_List_Controller', _t('List Sales Order Comment'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Document_Add_Controller', _t('Add Sales Order Document'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Document_Delete_Controller', _t('Delete Sales Order Document'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Document_Detail_Controller', _t('Details Sales Order Document'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Document_Generate_Controller', _t('Generate Sales Order Document'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Item_Add_Controller', _t('Add Sales Order Item'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Item_Delete_Controller', _t('Delet Sales Order Item'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Item_List_Controller', _t('List Sales Order Item'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Item_Modify_Controller', _t('Modify Sales Order Item'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Add_Controller', _t('Add Sales Order '), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Delete_Controller', _t('Delete Sales Order '), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Details_Controller', _t('Details Sales Order '), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_List_Controller', _t('List Sales Order '), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Modify_Controller', _t('Modify Sales Order '), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Updatestate_Controller', _t('Update Sales Order State'), 'Saleorder'));
        //$system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_State_Add_Controller', _t('Add Sales Order State'), 'Saleorder'));
        //$system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_State_Delete_Controller', _t('Delete Sales Order State'), 'Saleorder'));
        //$system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_State_List_Controller', _t('List Sales Order State'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_State_Modify_Controller', _t('Modify Sales Order State'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Saleorder_Quicklist_Controller', _t('Quicklist Sales Order'), 'Saleorder'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Saleorder_Backend_Setting_Controller', _t('Setting Sales Order '), 'Saleorder'));
    }

    /**
     * Add Translation.
     * @param Amhsoft_System $system
     */
    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        if (version_compare('1.1', $installedVersion)) {
            $file = dirname(dirname(__FILE__)) . '/Install/update_1.1.sql';
            $this->executeSQLFile($file);
        }
    }

    /**
     * Get Last 5 sales orders for portlet.
     * @return string
     */
    public static function getLastSalesOrders() {
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->limit(5);
        $saleOrderModelAdapter->orderBy('id DESC');
        $result = $saleOrderModelAdapter->fetch();
        $str = '<table class="grid" style="margin:0"> <tr><th>' . _t("Item") . '</th><th>' . _t("Date Time") . '</th><th>' . _t("Link") . '</th></tr>';
        foreach ($result as $salesOrder) {
            $link = '<a href="admin.php?module=saleorder&page=saleorder-details&id=' . $salesOrder->getId() . '">' . _t('Details') . '</a>';
            $str .= '<tr>';
            $str .= '<td>' . $salesOrder->getName() . '</td>';
            $str .= '<td>' . Amhsoft_Locale::DateTime($salesOrder->insertat) . '</td>';
            $str .= '<td>' . $link . '</td>';
            $str .= '</tr>';
        }
        $str .= '</table>';
        return $str;
    }

    /**
     * Calculate MonthlyRevenues.
     * @global type $system
     * @return type
     */
    public static function getMonthlyRevenues() {
        global $system;

        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->select('insertat');
        $saleOrderModelAdapter->select('total_price');

        $daily_this_month_sql = "SELECT DAY(insertat), total_price from sale_order WHERE MONTH(insertat) = '" . date('m') . "' GROUP BY DAY(insertat) ";
        $monthly_this_year_sql = "SELECT MONTH(insertat), total_price from sale_order WHERE YEAR(insertat) = '" . date('Y') . "' GROUP BY MONTH(insertat) ";

        $stmt = Amhsoft_Database::getInstance()->query($monthly_this_year_sql);
        $monthly_this_year_result = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        $monthly_this_year_result_array = array();
        for ($i = 1; $i < 13; $i++) {
            $monthly_this_year_result_array[] = array($i, isset($monthly_this_year_result[$i]) ? intval($monthly_this_year_result[$i]) : 0);
        }

        $system->getView()->assign('monthly_revenue_json', json_encode($monthly_this_year_result_array));

        return $system->getView()->fetch('Modules/Saleorder/Backend/Views/Portlet/Monthlyrevenue.html');
    }

    /**
     * Gets Daily Revenue.
     * @global type $system
     * @return type
     */
    public static function getDailyRevenues() {
        global $system;
        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->select('insertat');
        $saleOrderModelAdapter->select('total_price');

        $daily_this_month_sql = "SELECT DAY(insertat), total_price from sale_order WHERE MONTH(insertat) = '" . date('m') . "' GROUP BY DAY(insertat) ";

        $stmt = Amhsoft_Database::getInstance()->query($daily_this_month_sql);
        $daily_this_month_result = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);
        $daily_this_month_result_array = array();
        for ($i = 1; $i < 32; $i++) {
            $daily_this_month_result_array[] = array($i, isset($daily_this_month_result[$i]) ? intval($daily_this_month_result[$i]) : 0);
        }

        $system->getView()->assign('daily_revenue_json', json_encode($daily_this_month_result_array));

        return $system->getView()->fetch('Modules/Saleorder/Backend/Views/Portlet/Dailyrevenue.html');
    }

    /**
     * Module Install Action.
     * @param type $system
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

    public function getFolderToBackup() {
        return array('media/saleorder');
    }

    public function getTablesToBackup() {
        return array(
            'sale_order',
            'sale_order_address',
            'sale_order_comment',
            'sale_order_discount_type',
            'sale_order_has_document',
            'sale_order_item',
            'sale_order_item_lang',
            'sale_order_lang',
            'sale_order_state',
            'sale_order_state_lang',
            'saleorder_has_email',
        );
    }

}

?>
