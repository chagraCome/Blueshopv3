<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_Panel $mainPanel */
    protected $mainPanel;
    protected $recordNumberingForm;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $layout = new Amhsoft_Grid_Layout(2);
        $layout->setAppendMode(Amhsoft_Abstract_Layout::APPEND);
        $this->getView()->setMessage(_t('Product Settings'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->loadRecordNumberingForm();
        $this->getSetupForm();
    }

    /**
     * Setup Form
     */
    protected function getSetupForm() {
        $productConfig = new Amhsoft_Config_Table_Adapter('product');
        /** Amhsoft_Widget_Panel 1  Product Image Settings */
        $panel = new Amhsoft_Widget_Panel(_t('Product List Frontend'));
        $form = new Amhsoft_Widget_Form('product_form1', 'POST');

        $productPerPage = new Amhsoft_Input_Control('products_per_page', _t('Products per page'));
        $productPerPage->DataBinding = new Amhsoft_Data_Binding('products_per_page', null, null, $productConfig->getIntValue('products_per_page'));
        $panel->addComponent($productPerPage);


        $productDisplayTitle = new Amhsoft_YesNo_ListBox_Control('product_display_title', _t('Display Title'), 'product_display_title', $productConfig->getIntValue('product_display_title'));
        $panel->addComponent($productDisplayTitle);

        $productDisplayPrice = new Amhsoft_YesNo_ListBox_Control('product_display_price', _t('Display Price'), 'product_display_price', $productConfig->getIntValue('product_display_price'));
        $panel->addComponent($productDisplayPrice);

        $productDisplayQuantity = new Amhsoft_YesNo_ListBox_Control('product_display_quantity', _t('Display Quantity'), 'product_display_quantity', $productConfig->getIntValue('product_display_quantity'));
        $panel->addComponent($productDisplayQuantity);

        $productDefault = new Amhsoft_ListBox_Control('product_default_display_mode', _t('Display Mode'));
        $productDefault->DataBinding = new Amhsoft_Data_Binding('product_default_display_mode', 'id', 'name', $productConfig->getIntValue('product_default_display_mode'));
        $productDefault->DataSource = new Amhsoft_Data_Set(array(array('id' => 2, 'name' => 'list'), array('id' => 1, 'name' => 'gallery')));
        $panel->addComponent($productDefault);

        $form->addComponent($panel);

        $panel2 = new Amhsoft_Widget_Panel(_t('Product Image Settings'));

        $productImageWidth = new Amhsoft_Input_Control('product_image_width', _t('Image Width (Pixel)'));
        $productImageWidth->DataBinding = new Amhsoft_Data_Binding('product_image_width');
        $productImageWidth->DefaultValue = $productConfig->getValue('product_image_width');
        $panel2->addComponent($productImageWidth);

        $productImageHeight = new Amhsoft_Input_Control('product_image_height', _t('Image Height (Pixel)'));
        $productImageHeight->DataBinding = new Amhsoft_Data_Binding('product_image_height');
        $productImageHeight->DefaultValue = $productConfig->getValue('product_image_height');
        $panel2->addComponent($productImageHeight);

        $productThumbWidth = new Amhsoft_Input_Control('product_image_thumb_width', _t('Image Thumb Width (Pixel)'));
        $productThumbWidth->DataBinding = new Amhsoft_Data_Binding('product_image_thumb_width');
        $productThumbWidth->DefaultValue = $productConfig->getValue('product_image_thumb_width');
        $panel2->addComponent($productThumbWidth);

        $productThumbHeight = new Amhsoft_Input_Control('product_image_thumb_height', _t('Image Thumb Height (Pixel)'));
        $productThumbHeight->DataBinding = new Amhsoft_Data_Binding('product_image_thumb_height');
        $productThumbHeight->DefaultValue = $productConfig->getValue('product_image_thumb_height');
        $panel2->addComponent($productThumbHeight);

        $form->addComponent($panel2);

        $panel3 = new Amhsoft_Widget_Panel(_t('Shopping Cart & Stock Management'));

        $enableAutoStockYesNo = new Amhsoft_YesNo_ListBox_Control('stock_enable_auto_stk_management', _t('Enable Auto Stock Management?'), 'stock_enable_auto_stk_management', $productConfig->getIntValue('stock_enable_auto_stk_management'));
        $panel3->addComponent($enableAutoStockYesNo);

        $stockDisplayFinished = new Amhsoft_YesNo_ListBox_Control('stock_display_qty_finished', _t('Display Products when Quantity is null?'), 'stock_display_qty_finished', $productConfig->getIntValue('stock_display_qty_finished'));
        $panel3->addComponent($stockDisplayFinished);

        $submitStockButton = new Amhsoft_Button_Submit_Control('submit_stock', _t('Save'));
        $submitStockButton->setClass('ButtonSave');
        $form->addComponent($panel3);

        $submitPlistButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $submitPlistButton->setClass('ButtonSave');
        $form->addComponent($submitPlistButton);

        $this->mainPanel->addComponent($form);
        if ($this->getRequest()->isPost('record_submit')) {
            if ($this->recordNumberingForm->isFormValid()) {
                $values = $this->recordNumberingForm->getValues();
                $productConfig->setValue('prefix', $values['prefix']);
                $productConfig->setValue('start', $values['start']);
                $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
            }
        }
        if ($this->getRequest()->isPost('submit')) {
            $form->DataSource = Amhsoft_Data_Source::Post();
            $values = $form->getValues();

            foreach ($values as $key => $val) {
                $productConfig->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }
        $this->recordNumberingForm->DataSource = new Amhsoft_Data_Set($productConfig->getConfiguration());
        $this->recordNumberingForm->Bind();
    }

    /**
     * Load Record Number Form
     */
    protected function loadRecordNumberingForm() {
        $panel = new Amhsoft_Widget_Panel(_t('Record Numbering'));
        $prefixInput = new Amhsoft_Input_Control('prefix', _t('Prefix'));
        $prefixInput->ToolTip = _t('Like: PROD');
        $prefixInput->setWidth(60);
        $prefixInput->DataBinding = new Amhsoft_Data_Binding('prefix');
        $prefixInput->Required = true;
        $prefixInput->DefaultValue = 'PROD';
        $startInput = new Amhsoft_Input_Control('start', _t('Start Record'));
        $startInput->DataBinding = new Amhsoft_Data_Binding('start');
        $startInput->Required = true;
        $startInput->DefaultValue = 1;
        $submit = new Amhsoft_Button_Submit_Control('record_submit', _t('Save'));
        $submit->setClass('ButtonSave');
        $panel->addComponent($prefixInput);
        $panel->addComponent($startInput);
        $panel->addComponent($submit);
        $this->recordNumberingForm = new Amhsoft_Widget_Form('record_numbering_form', 'POST');
        $this->recordNumberingForm->addComponent($panel);
        $this->mainPanel->addComponent($this->recordNumberingForm);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->mainPanel);
        $this->show();
    }

}

?>
