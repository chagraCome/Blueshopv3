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
class Product_Comment_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $subjectInput * */
  public $subjectInput;

  /** @var Amhsoft_TextArea_Control $commentTextArea * */
  public $commentTextArea;

  /** @var Amhsoft_YesNo_ListBox_Control $publicYesNoListBox * */
  public $publicYesNoListBox;

  /** @var Amhsoft_Input_Control $authorInput * */
  public $authorInput;

  /** @var DateControl $insertAtDate * */
  public $insertAtDate;

  /** @var Amhsoft_ListBox_Control $productListBox * */
  public $productListBox;
  public $submitButton;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $this->subjectInput = new Amhsoft_Input_Control('subject', _t('Subject'));
    $this->subjectInput->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->commentTextArea = new Amhsoft_TextArea_Control('comment', _t('Comment'));
    $this->commentTextArea->DataBinding = new Amhsoft_Data_Binding('comment');
    $this->publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 1);
    $this->authorInput = new Amhsoft_Input_Control('author', _t('Author'));
    $this->authorInput->DataBinding = new Amhsoft_Data_Binding('author');
    $this->insertAtDate = new DateControl('insertat', _t('Insert Date'));
    $this->insertAtDate->DataBinding = new Amhsoft_Data_Binding('insertat');
    $this->productListBox = new Amhsoft_ListBox_Control('product_id', _t('Product '));
    $this->productListBox->DataBinding = new Amhsoft_Data_Binding('product_id', 'id', 'title');
    $this->productListBox->DataSource = Amhsoft_Data_Source::Table('product');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->addComponent($this->subjectInput);
    $this->addComponent($this->commentTextArea);
    $this->addComponent($this->publicYesNoListBox);
    $this->addComponent($this->authorInput);
    $this->addComponent($this->insertAtDate);
    $this->addComponent($this->productListBox);
    $this->addComponent($this->submitButton);
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
