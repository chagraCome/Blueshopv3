<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributeset_Delete_Controller extends Amhsoft_System_Web_Controller {

  private $entity;

  /**
   * Initialize Controller
   * @throws Exception
   */
  public function __initialize() {
   
    $entityid = $this->getRequest()->get('entity');
    $entityAdapter = new Eav_Entity_Model_Adapter();
    $this->entity = $entityAdapter->fetchById($entityid);
    if(!$this->entity instanceof Eav_Entity_Model){
      throw new Exception('no entity found');
    }
    
    
    
    $id = $this->getRequest()->getId();
    if ($id >= 0) {
      $productSetModelAdapter = new Eav_Set_Model_Adapter();
      $productSetModelAdapter->deleteById($id);
     
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
    } else {
      $this->getRedirector()->go(Amhsoft_History::back() . '&ret=false');
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
