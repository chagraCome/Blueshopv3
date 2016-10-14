<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Site_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput */
  public $nameInput;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNo */
  public $stateYesNo;

  /** @var Amhsoft_Input_Control $titleInput */
  public $titleInput;

  /** @var Amhsoft_Input_Control $rootInput */
  public $rootInput;

  /** @var Amhsoft_Input_Control $widthInput */
  public $widthInput;

  /** @var ListBox $styleList */
  public $styleList;

  /** @var Amhsoft_YesNo_ListBox_Control $requireLoginYesNo */
  public $requireLoginYesNo;

  /** @var TextArea $descriptionTextArea */
  public $descriptionTextArea;

  /** @var ListBox $mainPageSelect */
  public $mainPageSelect;
  public $submitButton;
  public $sitePanel;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->sitePanel = new Amhsoft_Widget_Panel(_t('Site Settings'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Site Name'), null, null, new Amhsoft_Data_Binding('name'));
    $this->nameInput->Required = true;
    $this->nameInput->setWidth(300);
    $this->stateYesNo = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);
    $this->titleInput = new Amhsoft_Input_Control('title', _t('Site Title'), null, null, new Amhsoft_Data_Binding('title'));
    $this->titleInput->setWidth(300);
    $this->rootInput = new Amhsoft_Input_Control('root', _t('Root Directory'), null, null, new Amhsoft_Data_Binding('root'));
    $this->widthInput = new Amhsoft_Input_Control('width', _t('Width'), null, null, new Amhsoft_Data_Binding('width'));
    $this->styleList = new Amhsoft_ListBox_Control('style', _t('Select Site Style'));
    $this->styleList->DataBinding = new Amhsoft_Data_Binding('style');
    $this->styleList->DataSource = new Amhsoft_Data_Set($this->getAvailableStyles());
    $this->requireLoginYesNo = new Amhsoft_YesNo_ListBox_Control('require_login', _t('Require Login'), 'require_login');
    $this->descriptionTextArea = new Amhsoft_TextArea_Control('description', _t('Description'));
    $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');
    $this->mainPageSelect = new Amhsoft_DirectoryInput_Control('page', _t('Select Homepage'));
    $this->mainPageSelect->DataBinding = new Amhsoft_Data_Binding('page', 'id', 'cms_page_id');
    $this->mainPageSelect->PopUpUrl = '?module=cms&page=page-quicklist';
    $this->mainPageSelect->setWidth(300);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'Button Save';
    $this->sitePanel->addComponent($this->nameInput);
    $this->sitePanel->addComponent($this->titleInput);
    $this->sitePanel->addComponent($this->rootInput);
    $this->sitePanel->addComponent($this->widthInput);
    $this->sitePanel->addComponent($this->styleList);
    $this->sitePanel->addComponent($this->descriptionTextArea);
    $this->sitePanel->addComponent($this->requireLoginYesNo);
    $this->sitePanel->addComponent($this->stateYesNo);
    $this->sitePanel->addComponent($this->mainPageSelect);
    $this->sitePanel->addComponent($this->submitButton);
    $this->addComponent($this->sitePanel);
  }

  /**
   * Get Frontend Style
   * @return type
   */
  protected function getAvailableStyles() {
    $array = array();
    $styles = new DirectoryIterator('Design/Frontend/');
    foreach ($styles as $style) {
      if ($style->isDir() && !$style->isDot() && $style->getFilename() != '.svn' && $style->getFilename() != 'global') {
	$array[] = $style->getFilename();
      }
    }
    return $array;
  }

  /**
   * Send Form Method
   * @return type
   */
  function isSend() {
    return isset($_POST['submit']);
  }

}

?>
