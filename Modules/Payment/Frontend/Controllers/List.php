<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Payment_Payment_Model_Adapter $paymentModelAdapter */
  protected $paymentModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->paymentModelAdapter = new Payment_Payment_Model_Adapter();
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->paymentModelAdapter->where("online = 1");
    $this->getView()->assign('payments', $this->paymentModelAdapter->fetch());
    $this->show();
  }

}

?>
