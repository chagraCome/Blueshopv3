<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Webmail_Backend_Setting_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Webmail_Setting_Form webmailSettingForm */
  protected $webmailSettingForm;

  /** @var Webmail_Setting_Model webmailSettingModel */
  protected $webmailSettingModel;

  /**
   * Initialize Controler
   */
  public function __initialize() {
    $this->webmailSettingForm = new Webmail_Setting_Form('webmailSettingForm_form', 'POST');
    $this->webmailSettingModel = new Webmail_Setting_Model();
    $this->getView()->setMessage(_t('Add new Webmail account'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   * @return type
   */
  public function __default() {
    $this->webmailSettingForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->webmailSettingForm->isSend()) {
      if ($this->webmailSettingForm->isValid()) {
	$this->webmailSettingForm->DataBinding = $this->webmailSettingModel;
	$webmailSettingModelAdapter = new Webmail_Setting_Model_Adapter();
	$this->webmailSettingModel = $this->webmailSettingForm->getDataBindItem();
	$this->webmailSettingModel->hash = md5(microtime(true));
	$this->webmailSettingModel->user_id = Amhsoft_Authentication::getInstance()->getObject()->id;
	$this->webmailSettingModel->setPassword(Amhsoft_Common::encrypt($this->webmailSettingModel->password, $this->webmailSettingModel->hash));
	try {
	  $this->checkSettings();
	  $webmailSettingModelAdapter->save($this->webmailSettingModel);
	  $this->handleSuccess();
	} catch (Exception $e) {
	  $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
	  return;
	}
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    Amhsoft_Navigator::go('admin.php?module=webmail&page=setting-list&ret=true');
  }

  /**
   * Check Setting
   * @return boolean
   * @throws Exception
   */
  protected function checkSettings() {
    $connection = $this->webmailSettingModel->getConnectionString();
    $username = $this->webmailSettingModel->getEmail();
    $password = $this->webmailSettingModel->getPassword();
    /* try to connect */
    @imap_timeout(IMAP_OPENTIMEOUT, 1);
    $inbox = @imap_open($connection . $box, $username, $password);
    if (!$inbox) {
      throw new Exception(_t('Cannot establish connection to server: ') . $connection);
    } else {
      @imap_close($inbox);
      return true;
    }
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

