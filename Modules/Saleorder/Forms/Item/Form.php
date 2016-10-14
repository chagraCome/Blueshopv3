<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Item_Form extends Amhsoft_Widget_Form {

    /** @var Amhsoft_Input_Control $itemNumberInput * */
    public $itemNumberInput;
    
    /** @var Amhsoft_Input_Control $itemInput * */
    public $itemNameInput;

    /** @var TextArea $itemDescriptionTextArea * */
    public $itemDescriptionTextArea;

    /** @var Amhsoft_Input_Control $priceInput * */
    public $priceInput;

    /** @var Amhsoft_Input_Control $discountInput * */
    public $discountInput;

    /** @var Amhsoft_Input_Control $quantityInput * */
    public $quantityInput;

    /** @var Amhsoft_Input_Control $itemIdInput * */
    public $itemIdInput;

    /** @var Amhsoft_ListBox_Control $productListBox * */
    public $productListBox;

    /** @var Amhsoft_ListBox_Control $saleOrderListBox * */
    public $saleOrderListBox;

    /** @var Amhsoft_ListBox_Control $projectListBox * */
    public $projectListBox;
    public $submitButton;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $this->itemNumberInput = new Amhsoft_Input_Control('item_number', _t('Item No'));
        $this->itemNumberInput->DataBinding = new Amhsoft_Data_Binding('item_number');

        
        
        $this->itemNameInput = new Amhsoft_Input_Control('item_name', _t('Item Name'));
        $this->itemNameInput->setWidth(350);
        $this->itemNameInput->DataBinding = new Amhsoft_Data_Binding('item_name');
        $this->itemNameInput->setRequired(true);


        $this->itemDescriptionTextArea = new Amhsoft_TextArea_Control('item_description', _t('Item Description'));
        $this->itemDescriptionTextArea->DataBinding = new Amhsoft_Data_Binding('item_description');

        $this->priceInput = new Amhsoft_Currency_Input_Control('unit_price', _t('Price'));
        $this->priceInput->DataBinding = new Amhsoft_Data_Binding('unit_price');
        $this->priceInput->setRequired(true);
        $this->priceInput->addValidator('Integer');

        $this->discountInput = new Amhsoft_Input_Control('discount', _t('Discount'));
        $this->discountInput->DataBinding = new Amhsoft_Data_Binding('discount');
        $this->discountInput->ToolTip = _t('20 '.Amhsoft_System_Config::getProperty('base_currency').' or 20% (Fixed or Percent)');

        $this->quantityInput = new Amhsoft_Input_Control('quantity', _t('Quantity'));
        $this->quantityInput->DataBinding = new Amhsoft_Data_Binding('quantity');
        $this->quantityInput->setRequired(true);
        $this->quantityInput->setDefaultValue(1);
        $this->quantityInput->addValidator('Integer');

        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';

        $this->addComponent($this->itemNumberInput);
        $this->addComponent($this->itemNameInput);
        $this->addComponent($this->itemDescriptionTextArea);
        $this->addComponent($this->priceInput);
        $this->addComponent($this->discountInput);
        $this->addComponent($this->quantityInput);

        $this->addComponent($this->submitButton);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
