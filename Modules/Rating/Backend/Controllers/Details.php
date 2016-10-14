<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Details.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Rating_Backend_Details_Controller extends Amhsoft_System_Web_Controller {

  public $ratingModel;
  public $ratingPanel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $id = $this->getRequest()->getId();
    $this->ratingPanel = new Rating_Panel();
    if ($id > 0) {
      $ratingModelAdapter = new Rating_Model_Adapter();
      $this->ratingModel = $ratingModelAdapter->fetchById($id);
      if (!$this->ratingModel instanceof Rating_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->getView()->setMessage(_t('Rating Details'), View_Message_Type::INFO);
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
    $this->ratingPanel->setDataSource(new Amhsoft_Data_Set($this->ratingModel));
    $this->ratingPanel->Bind();
    $this->getView()->assign('widget', $this->ratingPanel);
    $this->show();
  }

}

?>
