<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Message.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Frontend_Intern_Shop_Message_Controller extends Amhsoft_System_Web_Controller {

  public $commentModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $auth = Amhsoft_Authentication::getInstance();
    if (!$auth->isAuthenticated()) {
      $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
    }
    $this->commentModelAdapter = Crm_Account_Model::getComments($auth->getObject()->id, false);
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('messages', $this->commentModelAdapter);
    $this->show();
  }

}

?>
