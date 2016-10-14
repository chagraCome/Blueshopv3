<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Modules_Payment_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $paymentMenu = $system->getMenuContainer()->findMenuByName("Payment");
        $paymentMenu->setLabel(_t('Payment'));
        $paymentMenu->AddItem(new Amhsoft_Widget_Menu_Item(_t("List Payment Methods"), "admin.php?module=payment&page=payment-list"));
        $paymentMenu->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Payment Method"), "admin.php?module=payment&page=payment-add"));
    }

    /**
     * Init RBAC rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment', _t('Payment Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_List_Controller', _t('List Payment Methods'), 'Payment'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_Add_Controller', _t('Add new Payment Method'), 'Payment'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_Modify_Controller', _t('Edit Payment Method'), 'Payment'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_Delete_Controller', _t('Delete Payment Method'), 'Payment'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_Offline_Controller', _t('Set Payment Method Offline'), 'Payment'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Payment_Backend_Payment_Online_Controller', _t('Set Payment Method Online'), 'Payment'));
    }

    /**
     * Install Action.
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
     * Folder To Backup
     * @return type
     */
    public function getFolderToBackup() {
        return array('media/payment');
    }

    /**
     * Table To Backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'payment',
        );
    }

    /**
     * Add Translation.
     * @param Amhsoft_System $system
     */
    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        if (version_compare('1.2', $installedVersion)) {
            $file = dirname(dirname(__FILE__)) . '/Install/update_1.2.sql';
            $this->executeSQLFile($file);
        }

        if (version_compare('1.3', $installedVersion)) {
            $file = dirname(dirname(__FILE__)) . '/Install/update_1.3.sql';
            $this->executeSQLFile($file);
        }

    }

}

?>
