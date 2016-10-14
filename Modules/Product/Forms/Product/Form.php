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
class Product_Product_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Amhsoft_Input_Control $titleInput * */
    public $titleInput;

    /** @var Amhsoft_Input_Control $numberInput * */
    public $numberInput;

    /** @var Amhsoft_ListBox_Control $categoryInput */
    public $categoryInput;

    /** @var Amhsoft_YesNo_ListBox_Control $manageStockYesNo */
    public $manageStockYesNo;

    /** @var Amhsoft_Input_Control $quantityInput */
    public $quantityInput;

    /** @var Amhsoft_TextArea_Control $descriptionTextArea * */
    public $descriptionTextArea;

    /** @var Amhsoft_TextArea_Control $shortDescriptionTextArea * */
    public $shortDescriptionTextArea;

    /** @var Amhsoft_Input_Control $remoteIdInput * */
    public $remoteIdInput;
    public $submitButton;

    /** @var Product_Set_Model $productSetModel */
    public $productSetModel;

    /** @var Amhsoft_Widget_Event $beforeAddComponent */
    public $beforeAddComponent;

    /** @var Amhsoft_YesNo_ListBox_Control $markAsNewYesNo */
    public $markAsNewYesNo;

    /** @var Amhsoft_YesNo_ListBox_Control $markAsNewYesNo */
    public $showInHomeListBox;

    /** @var Amhsoft_YesNo_ListBox_Control $showInBannerYesNo */
    public $showInBannerYesNo;

    /** @var Amhsoft_YesNo_ListBox_Control $manufacturerListBox */
    public $manufacturerListBox;

    /**
     * Form COnstruct
     * @param type $name
     * @param type $model
     * @param type $method
     */
    public function __construct($name, $model, $method = null) {
        $this->beforeAddComponent = new Amhsoft_Widget_Event();
        parent::__construct($name, $method);
        $this->productSetModel = $model;
        $this->initializeComponents();
    }

    /**
     * Initialize Form Components
     */
    public function initializeComponents() {
        $this->titleInput = new Amhsoft_Input_Control('title', _t('Title'));
        $this->titleInput->DataBinding = new Amhsoft_Data_Binding('title');
        $this->titleInput->Required = true;
        $this->titleInput->addValidator('String|2');
        $this->titleInput->setWidth(300);
        $this->numberInput = new Amhsoft_Input_Control('number', _t('Number'));
        $this->numberInput->DataBinding = new Amhsoft_Data_Binding('number');
        $this->numberInput->Required = true;
        $this->numberInput->setWidth(150);

        $this->categoryInput = new Amhsoft_ListBox_Control('category_id', _t('Category'));
        $categoryAdapter = new Product_Category_View_Model_Adapter();
        $this->categoryInput->DataSource = new Amhsoft_Data_Set($categoryAdapter->fetchAllAsTree());
        $this->categoryInput->DataBinding = new Amhsoft_Data_Binding('category_id', 'id', 'name');
        $this->categoryInput->setRequired(true);

        $this->manufacturerListBox = new Amhsoft_ListBox_Control('manufacturer_id', _t('Manufacturer'));
        $this->manufacturerListBox->DataSource = new Amhsoft_Data_Set(new Product_Manufacturer_Model_Adapter());
        $this->manufacturerListBox->DataBinding = new Amhsoft_Data_Binding('manufacturer_id', 'id', 'name');
        $this->manufacturerListBox->WithNullOption = true;


        $this->markAsNewYesNo = new Amhsoft_YesNo_ListBox_Control('is_new', _t('Mark as new Product'), 'is_new');

        $this->showInBannerYesNo = new Amhsoft_YesNo_ListBox_Control('show_in_banner', _t('Show in Banner'), 'show_in_banner');

        $this->showInHomeListBox = new Amhsoft_YesNo_ListBox_Control('show_in_home', _t('Show In Home'), 'show_in_home');
        $this->descriptionTextArea = new Amhsoft_TextArea_Wysiwyg_Control('description', null);
        $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('description');

        $this->shortDescriptionTextArea = new Amhsoft_TextArea_Control('short_description', _t('Short Description'));
        $this->shortDescriptionTextArea->DataBinding = new Amhsoft_Data_Binding('short_description');
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Next Step'));
        $this->submitButton->Class = 'Button For';
        $panelInformation = new Amhsoft_Widget_Panel(_t('Product Information'));
        $panelInformation->addComponent($this->numberInput);
        $panelInformation->addComponent($this->titleInput);
        $panelInformation->addComponent($this->categoryInput);
        $panelInformation->addComponent($this->manufacturerListBox);
      /*  if ($formModuleInstalled) {
            $panelInformation->addComponent($productSetSelect);
        }*/
        $panelInformation->addComponent($this->markAsNewYesNo);
        $panelInformation->addComponent($this->showInBannerYesNo);
        $panelInformation->addComponent($this->showInHomeListBox);
        $panelPrice = new Amhsoft_Widget_Panel(_t('Stock Management'));
        $this->manageStockYesNo = new Amhsoft_YesNo_ListBox_Control('manage_stock', _t('Manage Stock for this Product'), 'manage_stock');
        $panelPrice->addComponent($this->manageStockYesNo);
        $this->quantityInput = new Amhsoft_Input_Control('quantity', _t('Available Quantity'));
        $this->quantityInput->DataBinding = new Amhsoft_Data_Binding('quantity');
        $this->quantityInput->setRequired(true);
        $this->quantityInput->addValidator('Integer');
        $this->quantityInput->onValidate->registerEvent($this, 'Validate_Quantity_CallBack');
        $panelPrice->addComponent($this->quantityInput);
        $panelDescription = new Amhsoft_Widget_Panel(_t('Product Description'));
        $panelDescription->addComponent($this->descriptionTextArea);

        $panelDescription->addComponent($this->shortDescriptionTextArea);
        $panelNavigation = new Amhsoft_Widget_Panel(_t('Navigation'));
        $panelNavigation->addComponent($this->submitButton);
        $this->addComponent($panelInformation);
        $this->addComponent($panelPrice);
        $this->addComponent($panelDescription);
        $this->addCustomComponents();
        $this->addComponent($panelNavigation);
    }

    /**
     * Validate Quantity Callback 
     * @param Amhsoft_Abstract_Control $control
     * @return boolean
     */
    public static function Validate_Quantity_CallBack(Amhsoft_Abstract_Control $control) {
        if (@$_REQUEST['manage_stock'] == '0') {
            return true;
        }
    }

    /**
     * Add Custom Component
     * @return type
     */
    protected function addCustomComponents() {
        if (!$this->productSetModel instanceof Eav_Set_Model) {
            return;
        }
        $attributes = $this->productSetModel->getGeneralAttributes();
        if (count($attributes) == 0) {
            
        }
        $panel = new Amhsoft_Widget_Panel($this->productSetModel->getName() . ' ' . _t('Attributes'));
        foreach ($attributes as $attribute) {
            $component = $attribute->getControlComponent($this->productSetModel->getEntity()->table);
            Amhsoft_Event_Handler::trigger('productform.before.add.component', $this, $component);
            $panel->addComponent($component);
        }
        $this->addComponent($panel);
        foreach ($this->productSetModel->getViews() as $view) {
            $panelView = new Amhsoft_Widget_Panel($view->getName());
            foreach ($view->attributes as $attribute) {
                $component = $attribute->getControlComponent($this->productSetModel->getEntity()->table);
                Amhsoft_Event_Handler::trigger('productform.before.add.component', $this, $component);
                $panelView->addComponent($component);
            }
            $this->addComponent($panelView);
        }
    }

    /**
     * Send Form
     * @return type
     */
    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
