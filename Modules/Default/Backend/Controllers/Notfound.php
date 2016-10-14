<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Notfound.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Default_Backend_Notfound_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize controller
   */
  public function __initialize() {
    header("HTTP/1.0 404 Not Found");
    header("Status: 404 Not Found");
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Requested page not found!'), View_Message_Type::ERROR);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->show();
  }

}

?>
