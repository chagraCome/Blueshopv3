<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Online.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Rating_Backend_Online_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $ratingModelAdapter = new Rating_Model_Adapter();
      $ratingModel = $ratingModelAdapter->fetchById($id);
      if ($ratingModel instanceof Rating_Model) {
	$ratingModel->setState(1);
	$ratingModelAdapter->save($ratingModel);
	$this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
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
