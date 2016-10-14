<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Backend_Sms_List_Controller extends Amhsoft_System_Web_Controller {

  protected $gateWaysDataGridView;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Manage SMS Gateways'), View_Message_Type::INFO);
    $this->gateWaysDataGridView = new Amhsoft_Widget_DataGridView(array(
	'gatewayname' => _t('Gateway Name'),
	'username' => _t('User Name'),
	'sender' => _t('Sender'),
    ));
    $editCol = new Amhsoft_Link_Control(_t('Modify'), '?module=setting&page=sms-modify');
    $editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $editCol->Class = 'edit';
    $editCol->setWidth(60);
    $this->gateWaysDataGridView->AddColumn($editCol);
    $default = new Amhsoft_Link_OnOffline_Control(_t('Set as default'), '?module=setting&page=sms-list&event=setdefault');
    $default->DataBinding = new Amhsoft_Data_Binding('id', 'as_default');
    $default->setWidth(120);
    $this->gateWaysDataGridView->AddColumn($default);
  }

  /**
   * Default Event
   */
  public function __default() {
    
  }

  /**
   * Set Default Event
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __setdefault() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $db = Amhsoft_Database::getInstance();
    $db->beginTransaction();
    try {
      $db->exec('UPDATE `sms_gateway` SET as_default = 0');
      $db->exec('UPDATE `sms_gateway` SET as_default = 1 WHERE id = ' . $id);
      $db->commit();
    } catch (Exception $e) {
      var_dump($e->getMessage());
      exit;
      $db->rollBack();
    }
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->gateWaysDataGridView->DataSource = Amhsoft_Data_Source::Table("sms_gateway");
    $this->getView()->assign("grid", $this->gateWaysDataGridView);
    $this->show();
  }

}

?>
