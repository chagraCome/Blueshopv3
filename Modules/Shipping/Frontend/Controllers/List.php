<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Frontend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var ShippingModelAdapter $shippingModelAdapter */
  protected $shippingModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->shippingModelAdapter = new Shipping_Shipping_Model_Adapter();
  }

  /**
   * DEfault Event
   */
  public function __default() {
    
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->shippingModelAdapter->where("state = 1");
    $this->getView()->assign('shippings', $this->shippingModelAdapter->fetch());
    $this->show();
  }

}

?>
