<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Thankyou.php 348 2016-02-05 16:23:48Z imen.amhsoft $
 * $Rev: 348 $
 * @package Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-02-05 17:23:48 +0100 (ven., 05 févr. 2016) $
 * $LastChangedDate: 2016-02-05 17:23:48 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Saleorder_Frontend_Thankyou_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize 
  */
  public function __initialize() {
$this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=list', 'label' => _t('Orders List')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=thankyou' , 'label' => _t('Confirm Payment submitted')));    
  }

  /**
   * Default Event
  */
  public function __default() {
    
  }

  /**
   * Final Event
  */
  public function __finalize() {
    //show the view
    $this->show();
  }

}