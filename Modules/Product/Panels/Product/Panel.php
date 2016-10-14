<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Product_Panel extends Amhsoft_Widget_Panel {

    /** @var Amhsoft_Label_Control $titleLabel * */
    public $titleLabel;

    /** @var Amhsoft_Label_Control $numberLabel * */
    public $numberLabel;

    /** @var Amhsoft_Label_Control $priceLabel * */
    public $priceLabel;

    /** @var Amhsoft_Label_Control $sortLabel * */
    public $sortIdLabel;

    /** @var Amhsoft_Label_Control $onLineLabel * */
    public $onLineLabel;

    /** @var Amhsoft_Label_Control $descriptionLabel * */
    public $descriptionLabel;

    /** @var Amhsoft_Label_Control $productCategorieLabel * */
    public $productCategorieLabel;

    /** @var Amhsoft_Label_Control $specialPriceLabel * */
    public $specialPriceLabel;

    /** @var Amhsoft_Label_Control $specialPriceDateTo * */
    public $specialPriceDateTo;
    public $specialPriceDateFrom;
    public $manageStock;
    public $quantity;
    public $manufacturer;

    /**
     * Panel Construct
     */
    public function __construct() {
        parent::__construct();
        $this->initializeComponents();
    }

    /**
     * Initialize Panel Components
     */
    public function initializeComponents() {
        $layout = new Amhsoft_Grid_Layout(2);
        $layout->setWidth(600);
        $panelInformation = new Amhsoft_Widget_Panel(_t('Product Information'));
        $panelInformation->setLayout($layout);
        $this->titleLabel = new Amhsoft_Label_Control(_t('Title'), new Amhsoft_Data_Binding('title'));
        $this->numberLabel = new Amhsoft_Label_Control(_t('Number'), new Amhsoft_Data_Binding('number'));
        $this->priceLabel = new Amhsoft_Currency_Label_Control(_t('Price'), new Amhsoft_Data_Binding('price'));
        $this->purchasingLabel = new Amhsoft_Currency_Label_Control(_t('Purchasing Price'), new Amhsoft_Data_Binding('purchasing_price'));
        $this->sortIdLabel = new Amhsoft_Label_Control(_t('Category'), new Amhsoft_Data_Binding('category'));
        $this->onLineLabel = new Amhsoft_YesNo_Image_Control(_t('Status'), new Amhsoft_Data_Binding('online'));
        $this->specialPriceLabel = new Amhsoft_Currency_Label_Control(_t('Special Price'), new Amhsoft_Data_Binding('special_price'));
        $this->specialPriceDateTo = new Amhsoft_Label_Control(_t('Special Price To'), new Amhsoft_Data_Binding('special_price_date_to'));
        $this->specialPriceDateFrom = new Amhsoft_Label_Control(_t('Special Price From'), new Amhsoft_Data_Binding('special_price_date_from'));
        $this->manageStock = new Amhsoft_YesNo_Image_Control(_t('Manage Stock'), new Amhsoft_Data_Binding('manage_stock'));
        $this->specialPriceDateFrom = new Amhsoft_Label_Control(_t('Special Price From'), new Amhsoft_Data_Binding('special_price_date_from'));
        $this->quantity = new Amhsoft_Label_Control(_t('Quantity'), new Amhsoft_Data_Binding('quantity'));
        $this->manufacturer = new Amhsoft_Label_Control(_t('Manufacturer'), new Amhsoft_Data_Binding('manufacturer'));
        $panelInformation->addComponent($this->titleLabel);
        $panelInformation->addComponent($this->numberLabel);
        $panelInformation->addComponent($this->priceLabel);
        $panelInformation->addComponent($this->purchasingLabel);
        $panelInformation->addComponent($this->sortIdLabel);
        $panelInformation->addComponent($this->specialPriceLabel);
        $panelInformation->addComponent($this->specialPriceDateFrom);
        $panelInformation->addComponent($this->manageStock);
        $panelInformation->addComponent($this->specialPriceDateTo);
        $panelInformation->addComponent($this->quantity);
        $panelInformation->addComponent($this->onLineLabel);
        $panelDescription = new Amhsoft_Widget_Panel(_t('Product Description'));
        $panelDescription->setLayout($layout);
        $this->descriptionLabel = new Amhsoft_Label_Control('', new Amhsoft_Data_Binding('description'));
        $panelDescription->addComponent($this->descriptionLabel);
        $this->addComponent($panelInformation);
        $this->addComponent($panelDescription);
    }

}

?>
