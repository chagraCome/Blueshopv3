<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package Cart
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cart_Frontend_Add_Controller extends Amhsoft_System_Web_Controller {

  protected $products = array();
  protected $quantites = array();

  /**
   * Initialize 
   */
  public function __initialize() {
    //to add product to shopping cart using this url = index.php?module=cart&page=add&prd[]=10&qnt[]=1&prd[]=11&qnt[]=3 
    $this->products = $this->getRequest()->getInts('prd');
    $this->quantites = $this->getRequest()->getInts('qnt');
    if (count($this->products) == 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->add();
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  protected function add() {
    $cart = Cart_Shoppingcart_Model::getInstance();
    foreach ($this->products as $i => $pid) {
      $productModelAdapter = new Product_Product_Model_Adapter();
      $product = $productModelAdapter->fetchById($pid);
      if (!$product instanceof Product_Product_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
      $requestedQuantity = isset($this->quantites[$i]) ? $this->quantites[$i] : 1;
      try {
	$cart->addProduct($product, $requestedQuantity);
      } catch (ShoppingCart_Product_Not_Available_Exception $pNotAvaliableException) {
	$this->getView()->assign('cart_message', $pNotAvaliableException->getMessage());
      } catch (Product_NoEnougthQuantity_Exception $q) {
	$this->getView()->assign('cart_message', $q->getMessage());
      } catch (Exception $e) {
	$this->getView()->assign('cart_message', $e->getMessage());
      }
    }
    $cart->Persist();
    $this->getRedirector()->go('index.php?module=cart&page=list&ret=true');
  }

  /**
   * Final Event
   */
  public function __finalize() {
    
  }

}

?>