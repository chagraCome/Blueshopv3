<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Download.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Frontend_Document_Download_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $documentModel = null;
    $documentModelAdapter = new Product_Document_Model_Adapter();
    $hash = $this->getRequest()->get("id");
    if ($hash) {
      $documentModelAdapter->where('hash = ?', $hash, PDO::PARAM_STR);
      $documentModel = $documentModelAdapter->fetch()->fetch();
    }
    if (!$documentModel instanceof Product_Document_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    Amhsoft_Common::force_download($documentModel->getName() . '.' . $documentModel->getExtention(), file_get_contents($documentModel->getAbsolutePath()));
    exit;
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  /*
   * Finalize event
   */

  public function __finalize() {
    $this->show();
  }

}

?>
