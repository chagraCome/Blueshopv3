<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */


class Saleorder_Item_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $itemLabel * */
  public $itemNameLabel;

  /** @var Amhsoft_Label_Control $itemDescriptionLabel * */
  public $itemDescriptionLabel;

  /** @var Amhsoft_Label_Control $priceLabel * */
  public $priceLabel;

  /** @var Amhsoft_Label_Control $discountLabel * */
  public $discountLabel;

  /** @var Amhsoft_Label_Control $quantityLabel * */
  public $quantityLabel;

  /** @var Amhsoft_Label_Control $itemIdLabel * */
  public $itemIdLabel;

  /** @var Amhsoft_Label_Control $productLabel * */
  public $productLabel;

  /** @var Amhsoft_Label_Control $saleOrderLabel * */
  public $saleOrderLabel;

  /** @var Amhsoft_Label_Control $projectLabel * */
  public $projectLabel;

  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Sales Order Item Information'));
    $panelInformation->setLayout($layout);
    $this->itemNameLabel = new Amhsoft_Label_Control(_t('Item Name'), new Amhsoft_Data_Binding('item_name'));
    $this->itemDescriptionLabel = new Amhsoft_Label_Control(_t('Item Description'), new Amhsoft_Data_Binding('item_description'));
    $this->priceLabel = new Amhsoft_Label_Control(_t('Price'), new Amhsoft_Data_Binding('price'));
    $this->quantityLabel = new Amhsoft_Label_Control(_t('Quantity'), new Amhsoft_Data_Binding('quantity'));
    $this->itemIdLabel = new Amhsoft_Label_Control(_t('Related Item'), new Amhsoft_Data_Binding('item_id'));
    $this->saleOrderLabel = new Amhsoft_Label_Control(_t('Related Sales Order'), new Amhsoft_Data_Binding('sale_order_id'));
    $this->projectLabel = new Amhsoft_Label_Control(_t('Related project'));
  }

}

?>
