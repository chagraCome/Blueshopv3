<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Online.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Cms_Backend_Box_Online_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $cmsBoxModelAdapter = new Cms_Box_Model_Adapter();
      $cmsBoxModel = $cmsBoxModelAdapter->fetchById($id);
      if ($cmsBoxModel instanceof Cms_Box_Model) {
	$cmsBoxModel->setOnline(1);
	$cmsBoxModelAdapter->save($cmsBoxModel);
	$this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
      }
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
