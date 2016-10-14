<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 449 2016-02-23 08:14:06Z imen.amhsoft $
 * $Rev: 449 $
 * @package    Backup
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-23 09:14:06 +0100 (mar., 23 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Backup_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        
    }

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $admin = $system->getMenuContainer()->findMenuByName("Backup");
        $admin->setLabel(_t("Backup Manager"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Generate Backup"), "admin.php?module=backup&page=local"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Backups"), "admin.php?module=backup&page=list"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Upload Backup"), "admin.php?module=backup&page=upload"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Backup Setting"), "admin.php?module=backup&page=setting"));
    }

    /**
     * Init RBAC Rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup', _t('Backup Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Delete_Controller', _t('Delete Backup'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Download_Controller', _t('Download Backup'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_List_Controller', _t('List Backups'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Local_Controller', _t('Local Backups'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Remote_Controller', _t('Remote Backups'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Remotelist_Controller', _t('List Remote Backups'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Restore_Controller', _t('Restore Backup'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Setting_Controller', _t('Setting Backup'), 'Backup'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Backup_Backend_Upload_Controller', _t('Upload Backup'), 'Backup'));
    }

    /**
     * Translation
     * @param Amhsoft_System $system
     */
    public function initTranslation(Amhsoft_System $system) {
        $filename = 'Modules/Backup/I18N/' . strtolower($system->getCurrentLang()) . '.po';
        if (file_exists($filename)) {
            $arabic = new Amhsoft_Config_Po_Adapter($filename);
            $system->appendToTranslation($arabic->getConfiguration());
        }
    }

}

?>
