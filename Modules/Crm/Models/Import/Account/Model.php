<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Import_Account_Model extends Amhsoft_Data_Import_Model implements Amhsoft_Data_Db_Model_Importable_Interface {

  public function __construct() {
    parent::__construct();
    $this->modelName = 'Crm_Account_Model';
    $this->adapterName = 'Crm_Account_Model_Adapter';
  }

  public function getDataGridView() {
    $dv = new Crm_Account_DataGridView();
    $dv->removeByIdentName('edit');
    $dv->removeByIdentName('delete');
    $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=importer&page=display&model=' . @$_GET['model'] . '&event=delete');
    $delCol->DataBinding = new Amhsoft_Data_Binding('import_index');
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $dv->addColum($delCol);
    return $dv;
  }

  public function doImport($models = array()) {
    $adapter = new $this->adapterName();
    foreach ($models as $model) {
      $adapter->save($model);
    }
  }

}
