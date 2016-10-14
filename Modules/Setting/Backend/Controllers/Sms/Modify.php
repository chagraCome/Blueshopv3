<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Backend_Sms_Modify_Controller extends Amhsoft_System_Web_Controller {

  protected $id;

  /** @var Amhsoft_Widget_Form $form * */
  protected $form;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Modify Gateway'), View_Message_Type::INFO);
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->setupForm();
    $this->form->DataSource = Amhsoft_Data_Source::SQL("SELECT * FROM `sms_gateway` WHERE id = " . $this->id);
    $salt = Amhsoft_Database::querySingle("SELECT salt FROM `sms_gateway` WHERE id = $this->id");
    $this->form->Bind();
    $this->form->password->Value = Amhsoft_Common::decrypt($this->form->password->Value, $salt);
  }

  /**
   * Default Event 
   */
  public function __default() {
    if ($this->getRequest()->isPost('submit')) {
      if ($this->form->isFormValid()) {
	$values = $this->form->getValues();
	$db = Amhsoft_Database::getInstance();
	$salt = Amhsoft_Database::querySingle("SELECT salt FROM `sms_gateway` WHERE id = $this->id");
	try {
	  $stmt = $db->prepare("UPDATE `sms_gateway` SET `username` = :username , `password` = :password , sender = :sender WHERE id = $this->id ");
	  $stmt->bindParam('username', $values['username']);
	  $stmt->bindParam('password', Amhsoft_Common::encrypt($values['password'], $salt));
	  $stmt->bindParam('sender', $values['sender']);
	  $stmt->execute();
	  $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
	} catch (Exception $e) {
	  $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
	}
      }
    }
  }

  /**
   * Setup Form
   */
  protected function setupForm() {
    $this->form = new Amhsoft_Widget_Form('gate_way', 'POST');
    $username = new Amhsoft_Input_Control('username', _t('Username'));
    $username->DataBinding = new Amhsoft_Data_Binding('username');
    $username->Required = true;
    $password = new Amhsoft_Password_Control('password', _t('Password'));
    $password->DataBinding = new Amhsoft_Data_Binding('password');
    $password->Required = true;
    $sender = new Amhsoft_Input_Control('sender', _t('Sender'));
    $sender->DataBinding = new Amhsoft_Data_Binding('sender');
    $sender->Required = true;
    $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Submit'));
    $this->form->addComponent($username);
    $this->form->addComponent($password)->addComponent($sender)->addComponent($submitButton);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->form);
    $this->show();
  }

}

?>
