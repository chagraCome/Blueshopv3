<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cms_Backend_Box_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Cms_Box_Model_Adapter $boxesModelAdapter */
  protected $boxesModelAdapter;

  /** @var BoxesModel */
  protected $boxesModel;

  /** @var integer $id */
  protected $id;

  /**
   * Initialize Compoenets.
   */
  public function __initialize() {
    $this->boxesModelAdapter = new Cms_Box_Model_Adapter();
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('List Blocks'), View_Message_Type::INFO);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('current_box', $this->boxesModel);
    $this->boxesModelAdpater = new Cms_Box_Model_Adapter();
    $this->boxesModelAdapter->groupBy('id');
    $this->getView()->assign("boxen", $this->boxesModelAdpater->fetch());
    $this->show();
  }

}

?>
