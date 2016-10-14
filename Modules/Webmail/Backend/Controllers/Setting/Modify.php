<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Webmail_Backend_Setting_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Setting_Form webmailSettingForm */
  protected $webmailSettingForm;

  /** @var Webmail_Setting_Model webmailSettingModel */
  protected $webmailSettingModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->webmailSettingForm = new Webmail_Setting_Form('webmailSettingForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Webmail Account'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $webmailSettingModelAdapter = new Webmail_Setting_Model_Adapter();
      $this->webmailSettingModel = $webmailSettingModelAdapter->fetchById($id);
    }
    if (!$this->webmailSettingModel instanceof Webmail_Setting_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->webmailSettingModel->password = Amhsoft_Common::decrypt($this->webmailSettingModel->password, $this->webmailSettingModel->hash);
    $this->webmailSettingForm->DataSource = new Amhsoft_Data_Set($this->webmailSettingModel);
    $this->webmailSettingForm->Bind();
  }

  /**
   * Default Event
   * @return type
   */
  public function __default() {
    if ($this->webmailSettingForm->isSend()) {
      $this->webmailSettingForm->DataSource = Amhsoft_Data_Source::Post();
      $this->webmailSettingForm->Bind();
      if ($this->webmailSettingForm->isValid()) {
	$this->webmailSettingForm->DataBinding = $this->webmailSettingModel;
	$webmailSettingModelAdapter = new Webmail_Setting_Model_Adapter();
	$this->webmailSettingModel = $this->webmailSettingForm->getDataBindItem();
	$this->webmailSettingModel->password = Amhsoft_Common::encrypt($this->webmailSettingModel->password, $this->webmailSettingModel->hash);
	try {
	  $this->checkSettings();
	} catch (Exception $ex) {
	  $this->getView()->setMessage($ex->getMessage(), View_Message_Type::ERROR);
	  return;
	}
	$webmailSettingModelAdapter->save($this->webmailSettingModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Check Setting
   * @return boolean
   * @throws Exception
   */
  protected function checkSettings() {
    if($this->webmailSettingModel->type == 'Outgoing'){
      return true;
    }
      
    $connection = $this->webmailSettingModel->getConnectionString();
    $username = $this->webmailSettingModel->getEmail();
    $password = $this->webmailSettingModel->getPassword();
    /* try to connect */
    @imap_timeout(IMAP_OPENTIMEOUT, 2);
    $inbox = @imap_open($connection . $box, $username, $password);
    $str = imap_errors();  echo("imap_errors():\n");  print_r($str); exit;
    if (!$inbox) {
      throw new Exception(_t('Cannot establish connection to server: ') . $connection);
    } else {
      imap_close($inbox);
      return true;
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->webmailSettingForm);
    $this->show();
  }

}
?>