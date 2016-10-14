<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cart_Frontend_Delete_Controller extends Amhsoft_System_Web_Controller {

  protected $id;

  /**
   * Initialize Event
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id > 0) {
      $cart = Cart_Shoppingcart_Model::getInstance();
      $cart->removeProductByProductId($this->id)
	      ->Persist();
      $this->getRedirector()->go('index.php?module=cart&page=list&erg=true');
    }
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
    
  }

}

?>
