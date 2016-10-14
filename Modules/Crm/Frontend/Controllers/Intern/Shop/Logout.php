<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Logout.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    28.06.2008 - 21:16:54
 */
class Crm_Frontend_Intern_Shop_Logout_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize event
   */
  public function __initialize() {
    
  }

  /**
   * Default event
   */
  public function __default() {
    Amhsoft_Authentication::getInstance()->clear();
    $this->getRedirector()->go('index.php');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    
  }

}