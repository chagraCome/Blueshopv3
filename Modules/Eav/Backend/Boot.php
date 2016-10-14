<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Modules_Eav_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * Translation 
   * @param Amhsoft_System $system
   */
  public function initTranslation(Amhsoft_System $system) {
    if ($system->getCurrentLang() == 'ar') {
      $arabic = new Amhsoft_Config_Po_Adapter('Modules/Eav/I18N/ar.po');
      $system->appendToTranslation($arabic->getConfiguration());
    }
  }

  /**
   * On Module install
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
   * Init RBAC Rules.
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav', _t('Eav Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributes_Add_Controller', _t('Add Attribute'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributes_Delete_Controller', _t('Delete Attribute'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributes_List_Controller', _t('List Attribute'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributes_Modify_Controller', _t('Modify Attribute'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributeset_Add_Controller', _t('Add Attribute Set'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributeset_Delete_Controller', _t('Delete Attribute Set'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributeset_Detail_Controller', _t('Details Attribute Set'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributeset_List_Controller', _t('List Attribute Set'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributeset_Modify_Controller', _t('Modify Attribute Set'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributesource_Delete_Controller', _t('Delete Attribute Source'), 'Eav'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Eav_Backend_Attributesource_Modify_Controller', _t('Modify Attribute Source'), 'Eav'));
  }

  /**
   * Table To backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'entity_attribute',
	'entity_attribute_datasource',
	'entity_attribute_datasource_lang',
	'entity_attribute_lang',
	'entity_attribute_type',
	'entity_attribute_value',
	'entity_attribute_value_lang',
	'entity_set',
	'entity_set_has_entity_attribute',
	'entity_set_view',
	'entity_set_view_lang',
    );
  }

  /**
   * On Module Update 
   * @param Amhsoft_System $system
   * @param type $installedVersion
   */
  public function onUpdate(Amhsoft_System $system, $installedVersion) {
    if (version_compare('1.1.0', $installedVersion, ">")) {
      $file = dirname(dirname(__FILE__)) . '/Install/update-1.1.0.sql';
      $this->executeSQLFile($file);
    }
    if (version_compare('1.2.0', $installedVersion, ">")) {
      $file = dirname(dirname(__FILE__)) . '/Install/update-1.2.0.sql';
      $this->executeSQLFile($file);
    }
  }

}

?>
