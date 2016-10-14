<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Shipping_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var ListBox $shippingTypeListBox */
    public $shippingTypeListBox;

    /** @var Amhsoft_Input_Control $titleInput */
    public $titleInput;

    /** @var TextArea $errorTextArea */
    public $errorTextArea;

    /** @var Amhsoft_Currency_Input_Control $minOrderAmountInput */
    public $minOrderAmountInput;

    /** @var Amhsoft_Input_Control $sortIdInput */
    public $sortIdInput;

    /** @var Amhsoft_Currency_Input_Control $priceInput */
    public $costInput;

    /** @var Amhsoft_ListBox_Control $costTypeListBox */
    public $costTypeListBox;

    /** @var Amhsoft_Currency_Input_Control $packagingCostInput */
    public $packagingCostInput;

    /** @var Amhsoft_ListBox_Control $packagingCostTypeListBox */
    public $packagingCostTypeListBox;

    /** @var FileInput $imagefileInput */
    public $imagefileInput;

    /** @var Amhsoft_Input_Control $onlineInput */
    public $onlineInput;

    /** @var Amhsoft_ListBox_Control $countryList */
    public $countryList;
    public $submitButton;

    /** @var Amhsoft_ImageControl_Control $imgCol */
    public $imgCol;
    public $descriptionTextArea;

    /**
     * Form Construct
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
        $this->shippingTypeListBox = new Amhsoft_ListBox_Control('shipping_type_id', _t('Shipping Type'));
        $this->shippingTypeListBox->DataBinding = new Amhsoft_Data_Binding('shipping_type_id', 'id', 'name');
        $this->shippingTypeListBox->DataSource = new Amhsoft_Data_Set(new Shipping_Type_Model_Adapter());
        $this->shippingTypeListBox->Required = true;

        $this->titleInput = new Amhsoft_Input_Control('title', _t('Title'));
        $this->titleInput->DataBinding = new Amhsoft_Data_Binding('title');
        $this->titleInput->setWidth(300);
        $this->titleInput->setRequired(true);

        $this->descriptionTextArea = new Amhsoft_TextArea_Wysiwyg_Control('description', _t('Description'));
        $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');

        $this->errorTextArea = new Amhsoft_Input_Control('error_message', _t('Error Message'));
        $this->errorTextArea->DataBinding = new Amhsoft_Data_Binding('error_message');
        $this->errorTextArea->setWidth(300);

        $this->minOrderAmountInput = new Amhsoft_Currency_Input_Control('min_order_amount', _t('Minimum Order Amount'));
        $this->minOrderAmountInput->DataBinding = new Amhsoft_Data_Binding('min_order_amount');
        $this->minOrderAmountInput->setWidth(100);

        $this->sortIdInput = new Amhsoft_Input_Control('sortid', _t('Sort ID'));
        $this->sortIdInput->DataBinding = new Amhsoft_Data_Binding('sortid');

        $this->costInput = new Amhsoft_Currency_Input_Control('cost', _t('Price'));
        $this->costInput->DataBinding = new Amhsoft_Data_Binding('cost');
        $this->costInput->Required = true;
        $this->costInput->onValidate->registerEvent($this, 'validate_Price_CallBack');
        $this->costTypeListBox = new Amhsoft_ListBox_Control('cost_type', _t('Cost Type'));
        $costtypes = array(
            array('id' => 1, 'name' => _t('Per Item')),
            array('id' => 2, 'name' => _t('Per Cart'))
        );
        $this->costTypeListBox->DataSource = new Amhsoft_Data_Set($costtypes);
        $this->costTypeListBox->DataBinding = new Amhsoft_Data_Binding('cost_type', 'id', 'name');
        $this->costTypeListBox->Required = true;

        $this->packagingCostInput = new Amhsoft_Currency_Input_Control('packaging_cost', _t('Packaging Cost'));
        $this->packagingCostInput->DataBinding = new Amhsoft_Data_Binding('packaging_cost');

        $this->packagingCostTypeListBox = new Amhsoft_ListBox_Control('packaging_cost_type', _t('Packaging Cost Type'));
        $this->packagingCostTypeListBox->DataSource = new Amhsoft_Data_Set($costtypes);
        $this->packagingCostTypeListBox->DataBinding = new Amhsoft_Data_Binding('packaging_cost_type', 'id', 'name');

        $this->onlineInput = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);

        $this->countryList = new Amhsoft_ListBox_Control('countries[]', _t('Select Country'));
        $this->countryList->setWidth(400);
        $country_source = Amhsoft_Locale::getCountryArray();
        array_unshift($country_source, array('iso' => 'ALL', 'name' => _t('All Countries')));
        $this->countryList = new Amhsoft_ListBox_Control('countries[]', _t('Country'));
        $this->countryList->DataBinding = new Amhsoft_Data_Binding('countries', 'iso', 'name');
        $this->countryList->DataSource = new Amhsoft_Data_Set($country_source);
        $this->countryList->multiple = true;
        $this->countryList->Size = 8;
        $this->countryList->setWidth(340);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';
        $this->imgCol = new Amhsoft_ImageControl_Control('logosrc');
        $this->imgCol->DataBinding = new Amhsoft_Data_Binding('logosrc');
        $this->imgCol->setWidth(220);
        $this->imgCol->setHeight(60);
        $imagePanel = new Amhsoft_Widget_Panel(_t('Images'));
        $this->imagefileInput = new Amhsoft_FileInput_Control('image_file', 'Image to upload', 'Add Image');
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
        $this->imagefileInput->addValidator($ImageValidator);
        $this->imgCol->uploadControl = $this->imagefileInput;
        $imagePanel->addComponent($this->imgCol);
        $panelInfo = new Amhsoft_Widget_Panel(_t('Shipping Information'));
        $panelInfo->addComponent($this->shippingTypeListBox);
        $panelInfo->addComponent($this->titleInput);
        $panelInfo->addComponent($this->descriptionTextArea);
        //$panelInfo->addComponent($this->errorTextArea);
        $panelInfo->addComponent($this->minOrderAmountInput);
        $panelInfo->addComponent($this->sortIdInput);
        $shippingCostPanel = new Amhsoft_Widget_Panel(_t('Shipping Cost'));
        $shippingCostPanel->addComponent($this->costInput);
        $shippingCostPanel->addComponent($this->costTypeListBox);
        $packagingCostPanel = new Amhsoft_Widget_Panel(_t('Packaging Cost'));
        $packagingCostPanel->addComponent($this->packagingCostInput);
        $packagingCostPanel->addComponent($this->packagingCostTypeListBox);
        $settingPanel = new Amhsoft_Widget_Panel(_t('Shipping Settings'));
        $settingPanel->addComponent($this->countryList);
        $settingPanel->addComponent($this->onlineInput);
        $this->addComponent($panelInfo);
        $this->addComponent($shippingCostPanel);
        $this->addComponent($packagingCostPanel);
        $this->addComponent($settingPanel);
        $this->addComponent($imagePanel);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($navigationPanel);
    }

    /**
     * Send Form
     * @return type
     */
    public function isSend() {
        return isset($_POST['submit']);
    }

    /**
     * Validate Price Callback
     * @param type $component
     * @return boolean
     */
    public static function validate_Price_CallBack($component) {
        if (Amhsoft_Web_Request::postInt('shipping_type_id') == 1) {
            return true;
        }
    }

}

?>
