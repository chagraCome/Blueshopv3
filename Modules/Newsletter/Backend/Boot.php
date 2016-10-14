<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newsletter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Newsletter_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * Initialize Menu Container
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $adminMenu = $system->getMenuContainer()->findMenuByName("Newsletter");
    $adminMenu->setLabel(_t("Newsletter"));
    $adminMenu->AddItem(new Amhsoft_Widget_Menu_Item(_t("Templates"), "admin.php?module=newsletter&page=template-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Groups"), "admin.php?module=newsletter&page=emails-groups-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("E-mails"), "admin.php?module=newsletter&page=emails-list"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Import"), "admin.php?module=newsletter&page=import"))
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Send E-mails"), "admin.php?module=newsletter&page=sendemails"));
  }

  /*
   * Translation
   */

  public function initTranslation(Amhsoft_System $system) {
    if ($system->getCurrentLang() == 'ar') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Newsletter/I18N/translation_ar.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
    if ($system->getCurrentLang() == 'fr') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Newsletter/I18N/translation_fr.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
  }

  /**
   * Initialize RBAC
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter', _t('Newsletter Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Templates_Controller', _t('Manage Templates'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Emails_Groups_List_Controller', _t('Manage groups'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Emails_Groups_Add_Controller', _t('Add group'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Emails_Groups_Modify_Controller', _t('Edit group'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Emails_Groups_Delete_Controller', _t('Delete group'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Emails_Controller', _t('Manage Emails'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Import_Controller', _t('Import'), 'Newsletter'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Newsletter_Backend_Sendemails_Controller', _t('Sendemails'), 'Newsletter'));
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
   * Table To Backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'newletter_template',
	'newsletter',
	'newsletter_email',
	'newsletter_emails',
	'newsletter_email_groups',
	'newsletter_group',
	'newsletter_templates',
    );
  }

}

?>
