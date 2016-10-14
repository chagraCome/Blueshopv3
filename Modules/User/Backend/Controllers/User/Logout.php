<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Logout.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class User_Backend_User_Logout_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Components.
   */
  public function __initialize() {
    
  }

  /**
   * Default event
   */
  public function __default() {
    Amhsoft_Authentication::getInstance()->clear();
    Amhsoft_Session::destroyAll();
    $_SESSION['amhsoft_reg_'] = array();
    unset($_SESSION);
    Amhsoft_Navigator::go('admin.php');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    
  }

}