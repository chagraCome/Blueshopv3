<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
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
class Crm_Backend_Account_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Account_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var Crm_Account_Model_Adapter $accountModelAdapter */
  protected $accountModelAdapter;

  public function __initialize() {
    $this->dataGridView = new Crm_Account_DataGridView();
    $this->accountModelAdapter = new Crm_Account_Model_Adapter();
    $this->dataGridView->Sortable = false;
    $this->dataGridView->Searchable = true;
    $this->dataGridView->setWithPagination(true);
    $this->dataGridView->performSort($this->getRequest(), $this->accountModelAdapter);
    $this->dataGridView->performSearch($this->getRequest(), $this->accountModelAdapter);
    $this->getView()->setMessage(_t('Manage Accounts'), View_Message_Type::INFO);
  }

  public function __default() {
    
  }

  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->accountModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->show();
  }

}

?>
