<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Details.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Installer
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created
 */
class Installer_Backend_Details_Controller extends Amhsoft_System_Web_Controller {

  /** @var string moduleName */
  protected $moduleName;

  /** @var SimpleXMLElement module manifest */
  protected $moduleManifest;

  /*
   * Initialize Controller
   */

  public function __initialize() {
    $this->moduleName = $this->getRequest()->get("package");
    if ($this->moduleName == null || trim($this->moduleName) == '') {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->getRequest()->post('install')) {
      $this->getRedirector()->go('admin.php?module=installer&page=list&event=' . $this->getRequest()->get('_event') . '&package=' . $this->moduleName);
    }
    $this->moduleManifest = Amhsoft_System_Module_Manager::getManifest($this->moduleName);
    $installed_version = Amhsoft_System_Module_Manager::getInstalledModuleVersion($this->moduleName);
    if ($this->moduleManifest) {
      $data = array();
      $data["NAME"] = (string) $this->moduleManifest->businessname;
      $data["BUILD_DATE"] = (string) $this->moduleManifest->builddate;
      $data["DESCRIPTION"] = (string) $this->moduleManifest->description;
      $data["CLASS"] = (string) $this->moduleManifest->class;
      $data["VERSION"] = (string) $this->moduleManifest->version;
      $count_of_updates = count($this->moduleManifest->updates->update);
      if ($count_of_updates == 0) {
	$data["VERSION"] = (string) $this->moduleManifest->version;
      } else {
	$current_version = (string) $this->moduleManifest->updates->update[$count_of_updates - 1]->version;
	if (version_compare($current_version, $installed_version, '>')) {
	  $data["VERSION"] = (string) $this->moduleManifest->updates->update[$count_of_updates - 1]->version;
	  $data["DESCRIPTION"] = (string) $this->moduleManifest->updates->update[$count_of_updates - 1]->description;
	  $data["BUILD_DATE"] = (string) $this->moduleManifest->updates->update[$count_of_updates - 1]->builddate;
	}
      }
      $this->getView()->setMessage(_t('Details of the Module ') . "<strong>" . $data["NAME"] . "</strong>", View_Message_Type::INFO);
      $this->getView()->assign('data', $data);
    } else {
      $this->getView()->setMessage(_t('Manifest was not found'), View_Message_Type::ERROR);
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->show();
  }

}
