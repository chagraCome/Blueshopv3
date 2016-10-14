<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Login.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class User_Backend_User_Login_Controller extends Amhsoft_System_Web_Controller {

  /** @var User_User_Model_Adapter userModelAdapter */
  protected $userModelAdapter;

  /**
   * Initialize Components.
   */
  public function __initialize() {
    $this->userModelAdapter = new User_User_Model_Adapter();
  }

  /**
   * Default Event.
   */
  public function __default() {
    if ($this->getRequest()->post('login')) {
      $username = trim($this->getRequest()->post('username'));
      $password = trim($this->getRequest()->post('password'));
      $auth = Amhsoft_Authentication::getInstance();
      $auth->authenticate($username, $password);
      if ($auth->isAuthenticated()) {
	$this->authenticationSuccessfully();
	$this->getRedirector()->go('admin.php');
      } else {
	$this->getView()->setMessage(_t('Username or password is incorrect!'));
      }
    }
  }

  /**
   * Authentication Success
   */
  protected function authenticationSuccessfully() {
    $sql = "UPDATE user SET lastLoginDate = :lastlogindate, lastLoginHost = :lastloginhost WHERE id = :id";
    $stmt = Amhsoft_Database::getInstance()->prepare($sql);
    $now = Amhsoft_Locale::UCTDateTime();
    $hostname = Amhsoft_Common::GetClientHostname();
    $loggeduserid = Amhsoft_Authentication::getInstance()->getObject()->id;
    $stmt->bindParam(':lastlogindate', $now, PDO::PARAM_STR);
    $stmt->bindValue(':lastloginhost', Amhsoft_Common::GetClientHostname(), PDO::PARAM_STR);
    $stmt->bindParam(':id', $loggeduserid);
    $stmt->execute();
    Amhsoft_Registry::register('allow_editor', md5('yes'));
    $userConfTable = 'default_user_' . Amhsoft_Authentication::getInstance()->getObject()->id;
    $settingsUser = new Amhsoft_Config_Table_Adapter($userConfTable);
    $selectedCurrency = $settingsUser->getValue('current_currency', 'EUR');
    Amhsoft_Registry::register('current_currency', $selectedCurrency);
    Amhsoft_Locale::initLocalFromSession();
    Amhsoft_Event_Handler::trigger('after.user.backend.login', $this, array(Amhsoft_Authentication::getInstance()->getObject()));
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $design_file = 'Design/Backend/' . Amhsoft_System::getLayout() . '/Modules/User/Backend/Views/User/Login.html';
    if (file_exists($design_file)) {
      $this->getView()->display($design_file);
    } else {
      $this->getView()->display('Modules/User/Backend/Views/User/Login.html');
    }
  }

}

?>