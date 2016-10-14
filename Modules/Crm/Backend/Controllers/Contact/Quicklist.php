<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 112 2016-01-26 13:50:57Z a.cherif $
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
class Crm_Backend_Contact_Quicklist_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_DataGridView $dataGridView */
  protected $dataGridView;

  /** @var Crm_Contact_Model_Adapter $personModelAdapter */
  protected $contactModelAdapter;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->dataGridView = new Amhsoft_Widget_DataGridView();
    $this->contactModelAdapter = new Crm_Contact_Model_Adapter();
    $this->setUpContactDataGridView();
    $this->getView()->setMessage(_t('List contacts'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    
  }

  protected function setUpContactDataGridView() {
    $firstNameCol = new Amhsoft_Link_Control(_t('Name'), 'admin.php?module=crm&page=contact-quicklist&event=select&refresh=' . Amhsoft_Web_Request::get('refresh'));
    $firstNameCol->DisplayValue = "name";
    $firstNameCol->DataBinding = new Amhsoft_Data_Binding('id', 'firstname');
    $emailCol = new Amhsoft_Label_Control(_t('Email'));
    $emailCol->DataBinding = new Amhsoft_Data_Binding('email');
    $mobileCol = new Amhsoft_Label_Control(_t('Phone'));
    $mobileCol->DataBinding = new Amhsoft_Data_Binding('phone');
    $this->dataGridView->AddColumn($firstNameCol);
    $this->dataGridView->AddColumn($emailCol);
    $this->dataGridView->AddColumn($mobileCol);
    $this->dataGridView->addSearcField("text");
    $this->dataGridView->addSearcField("text");
    $this->dataGridView->addSearcField("text");
    $this->dataGridView->Searchable = true;
    $this->dataGridView->Sortable = true;
    $this->dataGridView->setWithPagination(TRUE);
    $this->dataGridView->performSearch($this->getRequest(), $this->contactModelAdapter);
    $this->dataGridView->performSort($this->getRequest(), $this->contactModelAdapter);
  }

  /**
   * Select event
   */
  public function __select() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $contactAdapter = new Crm_Contact_Model_Adapter();
      $contact = $contactAdapter->fetchById($id);
      if ($contact instanceof Crm_Contact_Model) {
	if ($this->getRequest()->get('refresh') == 'true') {
	  Amhsoft_Registry::register('selected_contact_id', $id);
	  $this->close();
	} else {
	  $this->close(array('contact' => $contact->name, 'contact_id' => $contact->getId()));
	}
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->contactModelAdapter->fetch());
    $this->getView()->assign('grid', $this->dataGridView);
    $this->popup();
  }

}

?>