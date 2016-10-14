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
class Saleorder_Comment_Form extends Amhsoft_Widget_Form {

  /** @var Amhsoft_TextArea_Control $commentTextArea * */
  public $commentTextArea;

  /** @var Amhsoft_ListBox_Control $userListBox * */
  public $userListBox;

  /** @var Amhsoft_ListBox_Control $saleOrderListBox * */
  public $saleOrderListBox;

  /** @var DateControl $insertAtDate * */
  public $insertAtDate;

  /** @var Amhsoft_ListBox_Control $personListBox * */
  public $personListBox;

  /** @var Amhsoft_YesNo_ListBox_Control $publicYesNoListBox * */
  public $publicYesNoListBox;
  public $submitButton;

  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    $this->commentTextArea = new Amhsoft_TextArea_Control('comment', _t('Comment'));
    $this->commentTextArea->DataBinding = new Amhsoft_Data_Binding('comment');

    $this->publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Is Public'), 'public', 1);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'Button';

    $this->addComponent($this->commentTextArea);
    $this->addComponent($this->publicYesNoListBox);
    $this->addComponent($this->submitButton);
  }

  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
