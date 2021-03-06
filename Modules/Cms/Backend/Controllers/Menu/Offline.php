<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Offline.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cms_Backend_Menu_Offline_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controler
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
      $cmsMenuModel = $cmsMenuModelAdapter->fetchById($id);
      $cmsMenuModel->state = false;
      $cmsMenuModelAdapter->update($cmsMenuModel);
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
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
    
  }

}

?>
