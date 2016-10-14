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
class Product_Price_Form extends Amhsoft_Widget_Form {

    public $tablePriceDataGridView;

    /**
     * Form Construct
     * @param type $name
     * @param type $method
     */
    public function __construct($name, $method = null, $combi = null) {
        parent::__construct($name, $method);
        $this->initializeComponents($combi);
    }

    /**
     * Initailize Form Components
     */
    public function initializeComponents($combi = null) {
        $panel = new Amhsoft_Widget_Panel(_t('Prices'));
        $purchasingInput = new Amhsoft_Currency_Input_Control('purchasing_price', _t('Purchasing Price'));
        $purchasingInput->DataBinding = new Amhsoft_Data_Binding('purchasing_price');
        $panel->addComponent($purchasingInput);

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

        if ($combi) {
            $panelTablePrice = new Amhsoft_Widget_Panel(_t('Attribute Table Price'));
            $panelTablePrice->addComponent(new Amhsoft_Html_Control($combi));
        } else {
            $panelTablePrice = new Amhsoft_Widget_Panel(_t('Table Price'));
            $this->tablePriceDataGridView = new Amhsoft_Widget_DataGridView();
            $this->tablePriceDataGridView->Name = null;
            $this->tablePriceDataGridView->Style = 'style="width:400px"';
            $colQuantity = new Amhsoft_Input_Control('table_quantity', _t('Quantity'), null, null, new Amhsoft_Data_Binding('table_quantity', 'q'));
            $this->tablePriceDataGridView->AddColumn($colQuantity);
            $colPrice = new Amhsoft_Currency_Input_Control('table_price', _t('Price'), null, null, new Amhsoft_Data_Binding('table_price', 'p'));
            $this->tablePriceDataGridView->AddColumn($colPrice);
            $deleteLink = new Amhsoft_Label_Control(_t('Delete'));
            $deleteLink->Html = true;
            $deleteLink->DataBinding = new Amhsoft_Data_Binding('table_action');
            $this->tablePriceDataGridView->addColum($deleteLink);
            $panelTablePrice->addComponent($this->tablePriceDataGridView);
        }



        $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationLayout = new Amhsoft_Grid_Layout(2);
        $panelNavigation->setLayout($navigationLayout);
        $backButton = new Amhsoft_Button_Submit_Control('submit_back', _t('Previous Step'));
        $backButton->Class = 'Button Back';
        $panelNavigation->addComponent($backButton);
        $nextButton = new Amhsoft_Button_Submit_Control('submit_next', _t('Next Step'));
        $nextButton->Class = 'Button For';
        $panelNavigation->addComponent($nextButton);
        $this->addComponent($panel);
        $this->addComponent($panelTablePrice);
        $this->addComponent($panelNavigation);
    }

    /**
     * Send Next Button
     * @return type
     */
    public function isNextSend() {
        return isset($_POST['submit_next']);
    }

    /**
     * Send Back Button
     * @return type
     */
    public function isBackSend() {
        return isset($_POST['submit_back']);
    }

}

?>
