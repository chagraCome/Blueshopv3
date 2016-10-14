<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Index.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cashu
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cashu_Frontend_Index_Controller extends Amhsoft_System_Web_Controller {

  protected $orderId;

  /** @var Saleorder_Model $saleOrder */
  protected $saleOrder;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->orderId = $this->getRequest()->getId();
    if ($this->orderId > 0) {
      $saleOrderModelAdapter = new Saleorder_Model_Adapter();
      $this->saleOrder = $saleOrderModelAdapter->fetchById($this->orderId);
    }
    if (!$this->saleOrder instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    $cashuConfiguration = new Amhsoft_Config_Table_Adapter('cashu');
    $paymentAbstractModel = new Payment_Abstract_Model();
    $paymentAbstractModel->setWaitMessage("Please wait while you will redirected to cashu.com");
    $paymentAbstractModel->setProductionUrl('https://www.cashu.com/cgi-bin/pcashu.cgi');
    $paymentAbstractModel->setSandBoxUrl('https://sandbox.cashu.com/cgi-bin/pcashu.cgi');
    $paymentAbstractModel->setTestMode($cashuConfiguration->getValue('test_mode')); //from setting
    $paymentAbstractModel->addField('session_id', session_id());
    $paymentAbstractModel->addField('merchant_id', $cashuConfiguration->getValue('cashuid')); //setting cashu email
    $currency = $cashuConfiguration->getValue('cashu_currency'); //from setting
    $paymentAbstractModel->addField('currency', $currency); //setting cashu currency
    $paymentAbstractModel->addField('return', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=cashu&page=confirm&event=success&id=' . md5($this->saleOrder->getId()));
    $paymentAbstractModel->addField('notify_url', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=cashu&page=confirm&notify&id=' . md5($this->saleOrder->getId()));
    $paymentAbstractModel->addField('cancel_return', Amhsoft_System_Config::getProperty("appurl") . 'index.php?module=cashu&page=confirm&event=cancel&id=' . md5($this->saleOrder->getId()));
    $i = 1;
    foreach ($this->saleOrder->getItems() as $item) {
      $paymentAbstractModel->addField('amount', Amhsoft_Currency_Converter::tableConvert($this->saleOrder->getSubTotal(), $currency));
      $art = $item->getItemName() . " ,";
    }
    $paymentAbstractModel->addField('display_text', $art);
    $paymentAbstractModel->addField('txt1', $art);
    $paymentAbstractModel->addField('token', $this->makeTocken($this->saleOrder->total_price));
    $paymentAbstractModel->addField('language', $cashuConfiguration->getValue("cashu_language"));
    $paymentAbstractModel->invokeAsHtml();
    exit;
  }

  /**
   * Make Tocken
   * @param type $total
   * @return type
   */
  public function makeTocken($total) {
   
    $cashuConfiguration = new Amhsoft_Config_Table_Adapter('cashu');
    $total =  Amhsoft_Currency_Converter::tableConvert( $total, $cashuConfiguration->getValue('cashu_currency'));
	$str = strtolower(($cashuConfiguration->getValue('cashuid') . ":" . $total . ":" . $cashuConfiguration->getValue('cashu_currency'))).':'. $cashuConfiguration->getValue("encryption_keyword");
	return md5($str);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    
  }

}

?>
