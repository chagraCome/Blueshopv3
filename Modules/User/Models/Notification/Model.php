<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Notification_Model {

  protected $userConfiguration;

  /** @var User_User_Model $userModel */
  protected $userModel;
  protected $throwsExceptions = false;

  /**
   * Construct
   * @param User_User_Model $user
   * @param type $throwsExceptions
   */
  function __construct(User_User_Model $user, $throwsExceptions = false) {
    $this->userModel = $user;
    $this->throwsExceptions = ($throwsExceptions == true);
    $this->userConfiguration = new Amhsoft_Config_Table_Adapter('users');
  }

  /**
   * Send Password to User.
   * @param type $password
   */
  public function sendPasswordToUser($password) {
    $subject = _t("Your Username & Password");
    $message = _t("Dear") . "   " . $this->userModel->getFullName() . " , <br />";
    $message .= _t("Your Username") . " : " . $this->userModel->getUsername() . "<br />";
    $message .= _t("Your Password is") . " : " . $password . " <br/>";
    $message .= _t("Best Regards");
    //TODO: not support@amhsoft.com
    $this->sendEmail($this->userModel->getEmail(), "support@amhsoft.com", $subject, $message);
  }

  public function sendPasswordResetTokenByEmail($token) {
    $emailTemlate = new Setting_Template_Email_Model();
    $subject = _t('Reset password');
    $emailTemlate->setSubject($subject);
    $content = _t('Dear Admin') . "<br />" . _t('You can reset your password throught  the following link') . "<br />";
    $content .= "<a href='__RESET_PASSWORD_LINK__'>Click Here</a>" . "</br>";
    $content .= _t('Best regards') . "</br>";
    $emailTemlate->setContent($content);
    $link = Amhsoft_System_Config::getProperty('appurl') . 'admin.php?module=user&page=user-resetpassword&token=' . $token;
    $vars = array(
	'__RESET_PASSWORD_LINK__' => $link
    );
    $content = $emailTemlate->getFilledContent(array($this->userModel, $vars));
    $subject = $emailTemlate->getSubject();
    return $this->sendEmail($this->userModel->getEmail(), $this->userModel->getEmail(), $subject, $content);
  }

  /**
   * Send Email .
   * @param type $to
   * @param type $from
   * @param type $subject
   * @param type $message
   */
  public function sendEmail($to, $from, $subject, $message) {
    $emailValidatorFrom = new Amhsoft_Email_Validator($from);
    $emailValidatorTo = new Amhsoft_Email_Validator($to);
    if (!$emailValidatorFrom->isValid() || !$emailValidatorTo->isValid()) {
      if ($this->throwsExceptions == false) {
	return false;
      } else {
	throw new Exception(_t('invalid email address'));
      }
    }
    try {
      $mailClient = new Amhsoft_Mail_Client();
      $mailClient->AddAddress($to);
      $mailClient->setSubject($subject);
      $mailClient->SetFrom($from);
      $mailClient->SetHtmlBody(@htmlspecialchars_decode($message));
      $mailClient->Send();
      return true;
    } catch (Exception $e) {
      if ($this->throwsExceptions == false) {
	return false;
      } else {
	throw $e;
      }
    }
  }

  /**
   * Send SMS
   * @param type $to
   * @param type $message
   */
  protected function sendSMS($to, $message) {
    Amhsoft_Log::info('SMS WILL BE SEND TO' . $to . ' message : ' . $message);
  }

}

?>
