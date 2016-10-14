<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Comment_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $subjectLabel * */
  public $subjectLabel;

  /** @var Amhsoft_Label_Control $commentLabel * */
  public $commentLabel;

  /** @var Amhsoft_Label_Control $publicLabel * */
  public $publicLabel;

  /** @var Amhsoft_Label_Control $authorLabel * */
  public $authorLabel;

  /** @var Amhsoft_Label_Control $insertAtLabel * */
  public $insertAtLabel;

  /** @var Amhsoft_Label_Control $productLabel * */
  public $productLabel;

  /**
   * Panel Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Panel Components
   */
  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Product Comment Information'));
    $panelInformation->setLayout($layout);
    $this->subjectLabel = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('subject'));
    $this->publicLabel = new Amhsoft_Label_Control(_t('Public'), new Amhsoft_Data_Binding('public'));
    $this->authorLabel = new Amhsoft_Label_Control(_t('Author'), new Amhsoft_Data_Binding('author'));
    $this->insertAtLabel = new Amhsoft_Label_Control(_t('Insert Date'), new Amhsoft_Data_Binding('insertat'));
    $this->productLabel = new Amhsoft_Label_Control(_t('Product'), new Amhsoft_Data_Binding('product_id'));
    $panelInformation->addComponent($this->subjectLabel);
    $panelInformation->addComponent($this->publicLabel);
    $panelInformation->addComponent($this->authorLabel);
    $panelInformation->addComponent($this->insertAtLabel);
    $panelInformation->addComponent($this->productLabel);
    $panelDescription = new Amhsoft_Widget_Panel(_t('Product Comment Description'));
    $panelDescription->setLayout($layout);
    $this->commentLabel = new Amhsoft_Label_Control(_t('Comment'), new Amhsoft_Data_Binding('comment'));
    $panelDescription->addComponent($this->commentLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelDescription);
  }

}

?>
