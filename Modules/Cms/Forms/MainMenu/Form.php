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

class Cms_MainMenu_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $titleInput */
  public $titleInput;

  /** @var Amhsoft_ListBox_Control $siteList */
  public $siteList;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNo */
  public $stateYesNo;
  public $submitButton;

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
    $this->titleInput = new Amhsoft_Input_Control('name', _t('Main Menu Name'), null, null, new Amhsoft_Data_Binding('name'));
    $this->titleInput->Required = true;
    $this->titleInput->setWidth(300);
    $this->stateYesNo = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);
    $this->siteList = new Amhsoft_ListBox_Control('sites[]', _t('Site'));
    $this->siteList->setWidth(300);
    @$this->siteList->DataBinding = new Amhsoft_Data_Binding('sites', 'id', 'name');
    $this->siteList->DataSource = new Amhsoft_Data_Set(new Cms_Site_Model_Adapter());
    $this->siteList->Size = 10;
    $this->siteList->multiple = true;
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'Button Save';

    $this->addComponent($this->titleInput);
    $this->addComponent($this->siteList);
    $this->addComponent($this->stateYesNo);
    $this->addComponent($this->submitButton);
  }

  /**
   * Send Form Method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
