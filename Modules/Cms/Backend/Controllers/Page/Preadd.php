<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Preadd.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:58:41
 * @encoding   UTF-8
 */
class Cms_Backend_Page_Preadd_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Controller
   */
  public function __initialize() {
    
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Add new Page'), View_Message_Type::INFO);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->show();
  }

}

?>
