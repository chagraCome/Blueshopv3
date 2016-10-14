<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Setting_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * Initialize Menu Container
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $admin = $system->getMenuContainer()->findMenuByName("Setting");
        $admin->setLabel(_t('Setting'));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("General"), "admin.php?module=setting&page=general"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Currencies"), "admin.php?module=setting&page=currency-list"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Email Templates"), "admin.php?module=setting&page=template-email-list"));
        
    }

    /**
     * Translation
     * @param Amhsoft_System $system
     */
    public function initTranslation(Amhsoft_System $system) {
        if ($system->getCurrentLang() == 'ar') {
            $arabic = new Amhsoft_Config_Po_Adapter('Modules/Setting/I18N/ar.po');
            $system->appendToTranslation($arabic->getDataAsArray());
        }
        if ($system->getCurrentLang() == 'de') {
            $transConfig = new Amhsoft_Config_Po_Adapter('Modules/Setting/I18N/de.po');
            $system->appendToTranslation($transConfig->getConfiguration());
        }
         if ($system->getCurrentLang() == 'fr') {
            $arabic = new Amhsoft_Config_Po_Adapter('Modules/Setting/I18N/fr.po');
            $system->appendToTranslation($arabic->getDataAsArray());
        }
    }

    /**
     * Init RBAC Rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting', _t('Setting Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_Currency_List_Controller', _t('List all Currency'), 'Setting'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_Template_Email_Modify_Controller', _t('Modify Email Template'), 'Setting'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_Template_Print_Header_Controller', _t('Header Print Template'), 'Setting'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_Template_Print_Footer_Controller', _t('Footer Print Template'), 'Setting'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_Template_Print_Modify_Controller', _t('Modify Print Template'), 'Setting'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Setting_Backend_General_Controller', _t('General Setting'), 'Setting'));
    }

    /**
     * On Module Install
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
     * On Module Update
     * @param Amhsoft_System $system
     * @param type $installedVersion
     * @return boolean
     */
    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        $e = true;
        if (version_compare($installedVersion, '1.5.4') < 0) {
            $e = Amhsoft_Sms_Gateway::register("BulSMS", 'Amhsoft_Sms_Gateway_BulkSms_Adapter', 'amirtest', 'password', 'AMHSOFT');
            $e &= Amhsoft_Sms_Gateway::register("Mobily WS", 'Amhsoft_Sms_Gateway_MobilyWs_Adapter', 'amirtest', 'password', 'AMHSOFT');
            if ($e == true) {
                return true;
            } else {
                return false;
            }
        }
        if (version_compare('1.6', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade_1.6.sql';
            $this->executeSQLFile($file);
        }
    }

    /**
     * Table To Backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'email_template',
            'email_template_lang',
            'print_template',
            'print_template_lang',
            'sms_gateway',
            'currency',
            'currency_lang',
            'currency_set',
            'settings',
            'config',
            'locale',
            'locale_lang',
            'setting',
            'setting_lang',
        );
    }

}

?>
