<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Category_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $nameInput * */
  public $nameInput;

  /** @var Amhsoft_ListBox_Control $parentInput * */
  public $parentInput;

  /** @var Amhsoft_Input_Control $sortIdInput * */
  public $sortIdInput;

  /** @var $stateInput * */
  public $stateInput;

  /** @var Amhsoft_TextArea_Control $descriptionTextArea * */
  public $descriptionTextArea;
  public $categoryLogo;
  public $categoryBanner;
  public $submitButton;

  /**
   * From Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->setMultipart(true);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->Required = true;
    $this->parentInput = new Amhsoft_ListBox_Control('parent_id', _t('Parent Category'));
    $this->parentInput->DataBinding = new Amhsoft_Data_Binding('parent_id', 'id', 'name');
    $categoryViewModelAdapter = new Product_Category_View_Model_Adapter();
    $categorieSet = $categoryViewModelAdapter->fetchAllAsTree();
    $this->parentInput->DataSource = new Amhsoft_Data_Set($categorieSet);
    $this->parentInput->WithNullOption = true;
    $this->sortIdInput = new Amhsoft_Input_Control('sortid', _t('Sort Id'));
    $this->sortIdInput->DataBinding = new Amhsoft_Data_Binding('sortid');
    $this->stateInput = new Amhsoft_OnlineOffline_ListBox_Control('state', _t('State'), 'state', 1);
    $this->descriptionTextArea = new Amhsoft_TextArea_Control('description', _t('Description'));
    $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');
    $this->iconInput = new Amhsoft_Input_Control('icon', _t('Icon Class'));
    $this->iconInput->DataBinding = new Amhsoft_Data_Binding('icon');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->categoryLogo = new Amhsoft_ImageControl_Control('logosrc');
    $fileUpload = new Amhsoft_FileInput_Control('logo', _t('Category Logo'));
    $this->categoryLogo->setUploadControl($fileUpload);
    $this->categoryLogo->setWidth(200);
    $this->categoryLogo->DataBinding = new Amhsoft_Data_Binding('logosrc');
    $logoPanel = new Amhsoft_Widget_Panel(_t('Logo'));
    $logoPanel->addComponent($this->categoryLogo);
    $bannerPanel = new Amhsoft_Widget_Panel(_t('Category Banner'));
    $this->categoryBanner = new Amhsoft_ImageControl_Control('bannersrc');
    $fileUpload = new Amhsoft_FileInput_Control('banner', _t('Category Banner'));
    $this->categoryBanner->setUploadControl($fileUpload);
    $this->categoryBanner->setWidth(200);
    $this->categoryBanner->DataBinding = new Amhsoft_Data_Binding('bannersrc');
    $bannerPanel->addComponent($this->categoryBanner);
    $mainPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $mainPanel->addComponent($this->nameInput);
    $mainPanel->addComponent($this->parentInput);
    $mainPanel->addComponent($this->sortIdInput);
    $mainPanel->addComponent($this->stateInput);
    $mainPanel->addComponent($this->descriptionTextArea);
    $mainPanel->addComponent($this->iconInput);
    $this->addComponent($mainPanel);
    $this->addComponent($bannerPanel);
    $this->addComponent($logoPanel);
    $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $panelNavigation->addComponent($this->submitButton);
    $this->addComponent($panelNavigation);
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
