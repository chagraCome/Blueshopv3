<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Frontend_Detail_Controller extends Amhsoft_System_Web_Controller {

  /** @var Product_Product_Model $productModel */
  private $productModel;
  private $id;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      new InvalidArgumentException('id ist invalid', 0, null);
    }
    $productModelAdapter = new Product_Product_Model_Adapter();
    $this->productModel = $productModelAdapter->fetchById($this->id);
    if (!$this->productModel instanceof Product_Product_Model) {
      throw new Amhsoft_Item_Not_Found_Exception('Product not found');
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
    $this->getView()->assign('product', $this->productModel);
    $this->show();
  }

}

?>
