<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Price.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Tyre_Backend_Price_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Form $priceForm */
  protected $priceForm;

  /** @var Tyre_Model tyreModel */
  protected $entityModel;
  protected $id;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $adapter = new Tyre_Model_Adapter();
    $this->entityModel = $adapter->fetchById($this->id);
    if (!$this->entityModel instanceof Tyre_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->priceForm = new Amhsoft_Widget_Form('price_form', 'POST');
    $this->getView()->setMessage(_t('Product Prices'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $panel = new Amhsoft_Widget_Panel(_t('Prices'));
    $priceInput = new Amhsoft_Currency_Input_Control('price', _t('Price'));
    $priceInput->DataBinding = new Amhsoft_Data_Binding('price');
    $panel->addComponent($priceInput);
    $specialPriceInput = new Amhsoft_Currency_Input_Control('special_price', _t('Special Price'));
    $specialPriceInput->DataBinding = new Amhsoft_Data_Binding('special_price');
    $panel->addComponent($specialPriceInput);
    $specialPriceDateFrom = new Amhsoft_Date_Input_Control('special_price_date_from', _t('Date From'));
    $specialPriceDateFrom->setId('datefrom');
    $specialPriceDateFrom->DataBinding = new Amhsoft_Data_Binding('special_price_date_from');
    $panel->addComponent($specialPriceDateFrom);
    $specialPriceDateTo = new Amhsoft_Date_Input_Control('special_price_date_to', _t('Date To'));
    $specialPriceDateTo->setId('dateto');
    $specialPriceDateTo->DataBinding = new Amhsoft_Data_Binding('special_price_date_to');
    $panel->addComponent($specialPriceDateTo);
    $panelTablePrice = new Amhsoft_Widget_Panel(_t('Table Price'));
    $tablePriceDataGridView = new Amhsoft_Widget_DataGridView();
    $tablePriceDataGridView->Style = 'style="width:350px"';
    $colQuantity = new Amhsoft_Input_Control('table_quantity', _t('Quantity'), null, null, new Amhsoft_Data_Binding('table_quantity', 'q'));
    $tablePriceDataGridView->AddColumn($colQuantity);
    $colPrice = new Amhsoft_Currency_Input_Control('table_price', _t('Price'), null, null, new Amhsoft_Data_Binding('table_price', 'p'));
    $tablePriceDataGridView->AddColumn($colPrice);
    $deleteLink = new Amhsoft_Label_Control(_t('Delete'));
    $deleteLink->DataBinding = new Amhsoft_Data_Binding('table_action');
    $tablePriceDataGridView->addColum($deleteLink);
    $tablePriceModelAdapter = new Tyre_Price_Table_Model_Adapter();
    $tablePriceModelAdapter->where('tyre_id = ?', $this->id);
    $tablePriceData = array();
    $tablePriceModels = $tablePriceModelAdapter->fetch();
    foreach ($tablePriceModels as $tablePriceModel) {
      $tablePriceData[] = array('table_quantity' => $tablePriceModel->table_quantity, 'table_price' => $tablePriceModel->table_price, 'table_action' => '<a href="#" class="delete">del</a>');
    }
    $tablePriceData[] = array('table_quantity' => '', 'table_price' => '', 'table_action' => '<a href="#" class="delete">del</a>');
    $tablePriceDataGridView->DataSource = new Amhsoft_Data_Set($tablePriceData);
    $panelTablePrice->addComponent($tablePriceDataGridView);
    $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $submitButton->Class = 'ButtonSave';
    $panelNavigation->addComponent($submitButton);
    $this->priceForm->addComponent($panel);
    $this->priceForm->addComponent($panelTablePrice);
    $this->priceForm->addComponent($panelNavigation);
    if ($this->getRequest()->isPost('submit')) {
      $this->saveTablePrice();
    }
  }

  /**
   * Save Price Table
   */
  protected function saveTablePrice() {
    $quantities = $this->getRequest()->posts('table_quantity');
    $prices = $this->getRequest()->posts('table_price');
    Amhsoft_Database::getInstance()->exec("DELETE FROM tyre_table_price WHERE tyre_id = " . $this->id);
    foreach ($quantities as $index => $q) {
      if (intval($q) > 0) {
	if ($prices[$index]) {
	  $sql = "INSERT INTO tyre_table_price VALUES (NULL, '$this->id', '$q', '" . $prices[$index] . "')";
	  Amhsoft_Database::getInstance()->exec($sql);
	}
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->priceForm);
    $this->show();
  }

}

?>
