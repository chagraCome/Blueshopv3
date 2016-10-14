<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of list
 *
 * @author cherif
 */
class Crm_Backend_Contact_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Contact_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var Crm_Contact_Model_Adapter $contactModelAdapter */
  protected $contactModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->dataGridView = new Crm_Contact_DataGridView('admin.php', array('id' => 'c'));
    $this->dataGridView->onSearchColumn->registerEvent($this, 'onSearchCallBack');
    $this->dataGridView->onSortColumn->registerEvent($this, 'onSortCallBack');
    $this->dataGridView->WithActions = true;
    $this->dataGridView->actions = array('delete' => 'Delete selected');
    $this->contactModelAdapter = new Crm_Contact_Model_Adapter();
    $this->contactModelAdapter->orderBy('id DESC');
    $this->dataGridView->Sortable = true;
    $this->dataGridView->Searchable = true;
    $this->dataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('Manage contacts'), View_Message_Type::INFO);
  }

  public static function onSearchCallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
    if ($colName == 'name') {
      $name = $req->get('name');
      $adapter->where("(firstname LIKE '%$name%'  OR lastname LIKE '%$name%')");
      return true;
    }
  }

  public static function onSortCallBack($name, $adapter, $asc) {
    if ($name == 'name') {
      $adapter->orderBy('firstname ' . $asc . ' , lastname ' . $asc);
      return true;
    }
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->getRequest()->get('select_action') == 'delete') {
      $selectedIndexes = $this->getRequest()->getInts('id');
      if (count($selectedIndexes) > 0) {
	$adapter = new Crm_Contact_Model_Adapter();
	foreach ($selectedIndexes as $index) {
	  $adapter->deleteById($index);
	}
	$this->getRedirector()->go('admin.php?module=crm&page=contact-list');
      }
    }
    $this->dataGridView->performSearch($this->getRequest(), $this->contactModelAdapter);
    $this->dataGridView->performSort($this->getRequest(), $this->contactModelAdapter);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->contactModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->show();
  }

}

?>
