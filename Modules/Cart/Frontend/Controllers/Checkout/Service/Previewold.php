<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Previewold.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Cart_Frontend_Checkout_Service_Preview_Controller extends Cart_Frontend_Checkout_Preview_Controller {

  public function __construct() {
    parent::__construct();
    Amhsoft_Event_Handler::attach(new Saleorder_Event_Listner(), 'firsttime.saleorder.saved');
  }

}

class Saleorder_Event_Listner extends Amhsoft_Event_Listener {

  public function receive($eventname, $sender, $args) {
    if ($eventname == 'firsttime.saleorder.saved') {
      $cart_id = Cart_Shoppingcart_Model::getInstance()->id;
      $products = Cart_Shoppingcart_Model::getInstance()->getProducts();
      $product_id = $products[0]->id;
      $form_id = Amhsoft_Database::querySingle("SELECT form_id FROM cart_has_form WHERE cart_id = $cart_id AND product_id = $product_id");
      $sql = "INSERT INTO saleorder_has_form(saleorder_id, product_id, form_id) VALUES ($args->id, $product_id, $form_id)";
      Amhsoft_Database::getInstance()->exec($sql);
    }
    //
  }

}

?>
