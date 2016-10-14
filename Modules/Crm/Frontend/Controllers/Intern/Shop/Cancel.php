<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Cancel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Frontend_Intern_Shop_Cancel_Controller extends Amhsoft_System_Web_Controller {

  public $id;

  /**
   * Initialize event
   */
  public function __initialize() {

    $this->id = $this->getRequest()->getId();

    $auth = Amhsoft_Authentication::getInstance();
    if (!$auth->isAuthenticated()) {
      $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
    }
    $saleOrderModelAdapter = new Saleorder_Model_Adapter();
    $saleOrderModel = $saleOrderModelAdapter->fetchById($this->id);
    if (!$saleOrderModel instanceof Saleorder_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    if ($saleOrderModel->account->id != $auth->getObject()->id) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
    $saleOrderModel->sale_order_state_id = $saleOrderConfiguration->getIntValue(Saleorder_State_Model::CANCELED);
    if ($saleOrderModel->sale_order_state_id != $saleOrderConfiguration->getIntValue(Saleorder_State_Model::CANCELED)) {
      
    }
    $saleOrderModelAdapter->save($saleOrderModel);
    $this->getRedirector()->go('?module=saleorder&page=list');
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
    $this->show();
  }

}

?>
