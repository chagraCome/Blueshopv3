<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Contact.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Coupon_Backend_Contact_Controller extends Amhsoft_System_Web_Controller {

  public $Model;
  public $mainpanel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->mainpanel = new Amhsoft_Widget_Panel();
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $ModelAdapter = new Coupon_Model_Adapter();
      $this->Model = $ModelAdapter->fetchById($id);
      if (!$this->Model instanceof Coupon_Model) {
	throw new Amhsoft_Item_Not_Found_Exception();
      }
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }

    $this->getView()->setMessage(_t('Coupon contacts'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {

    if (Amhsoft_Registry::get('selected_contact_id')) {
      $this->addContactById(Amhsoft_Registry::get('selected_contact_id'));
    }
    if ($this->getRequest()->isPost('contact_submit')) {
      $selectedGroupId = $this->getRequest()->postInt('contact_group_id');
      $this->addcontactsByGroup($selectedGroupId);
    }

    $this->loadcontacts();
  }

  /**
   * Delete event
   */
  public function __delete() {
    Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_contact WHERE contact_id = " . $this->getRequest()->getInt('con_id'));
    $this->getRedirector()->go('?module=coupon&page=contact&id=' . $this->Model->getId() . '&ret=true');
  }
  
   /**
   * Delete All event
   */
  public function __deleteall() {
    Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_contact WHERE coupon_id = " . $this->getRequest()->getInt('id'));
    $this->getRedirector()->go('?module=coupon&page=contact&id=' . $this->Model->getId() . '&ret=true');
  }

  protected function loadcontacts() {
    $panel = new Amhsoft_Widget_Panel(_t('Contacts'));
    $dataGridView = new Crm_Contact_DataGridView();
    $dataGridView->Searchable = true;
    $dataGridView->Sortable = true;
    $adapter = new Crm_Contact_Model_Adapter();
    $dataGridView->setWithPagination(true);
    $dataGridView->performSearch($this->getRequest(), $adapter);
    $dataGridView->performSort($this->getRequest(), $adapter);
    $delCol = new Amhsoft_Link_Control(_t('Unassign'), '?module=coupon&page=contact&event=delete&id=' . $this->Model->getId());
    $delCol->DataBinding = new Amhsoft_Data_Binding('id');
    $delCol->Alias = 'con_id';
    $delCol->Class = 'delete';
    $delCol->JavaScript = 'onClick="return confirmDelete();"';
    $dataGridView->removeByIdentName('del');
    $dataGridView->AddColumn($delCol);
    $adapter->leftJoinWithoutCardinality('coupon_contact', 'id', 'contact_id');
    $adapter->where('coupon_contact.coupon_id = ?', $this->Model->getId());
    $dataGridView->DataSource = new Amhsoft_Data_Set($adapter);
    $selectLink = new Amhsoft_Link_Control(_t('Select contact'), 'admin.php?module=crm&page=contact-quicklist&refresh=true');
    $selectLink->onClickOpenInPopUp(640, 480);
    $selectLink->setClass('add');
    $form = new Amhsoft_Widget_Form('contact_by_group', 'POST');
    $personGroupModelAdapter = new Crm_Contact_Group_Model_Adapter();
    $contactsGroups = $personGroupModelAdapter->fetch()->fetchAll();
    $contactGroupList = new Amhsoft_ListBox_Control('contact_group_id', _t('Select contacts By Group'));
    $contactGroupList->WithNullOption = TRUE;
    $contactGroupList->NullOptionLabel = _t('All Groups');
    $contactGroupList->DataBinding = new Amhsoft_Data_Binding('contact_group_id', 'id', 'name');
    $contactGroupList->DataSource = new Amhsoft_Data_Set($contactsGroups);
    $submitButton = new Amhsoft_Button_Submit_Control('contact_submit', _t('Select Contact'));
    $submitButton->setClass('ButtonAdd');
    $panelSelect = new Amhsoft_Widget_Panel();
    $panelSelect->addComponent($contactGroupList);
    $panelSelect->addComponent($submitButton);
    $panelSelect->setLayout(new Amhsoft_Grid_Layout(2));
    $form->addComponent($panelSelect);
    $panelLinks = new Amhsoft_Widget_Panel();
    $panelLinks->addComponent($selectLink);
    $panelLinks->addComponent($form);
    $panel->addComponent($panelLinks);
    $panel->addComponent($dataGridView);
    $deletetLink = new Amhsoft_Link_Control(_t('Delete All'), '?module=coupon&page=contact&event=deleteall&id=' . $this->Model->getId());
    $deletetLink->setClass('delete');
    $panel->addComponent($deletetLink);
    $this->mainpanel->addComponent($panel);
  }

  protected function addContactsByGroup($groupId) {
    $compainid = $this->Model->getId();
    if (intval($groupId) > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_contact WHERE coupon_id = " . $this->Model->getId());
    }
    if (intval($groupId) > 0) {
      $sql = "INSERT INTO coupon_contact SELECT $compainid as cid, id, 'prepared'  FROM contact WHERE group_id = $groupId";
    } else {
      $sql = "INSERT INTO coupon_contact SELECT $compainid as cid, id , 'prepared' FROM contact";
    }
    Amhsoft_Database::getInstance()->exec($sql);
  }

  protected function addContactById($id) {
    $sql = '';
    if (intval($id) > 0) {
      Amhsoft_Database::getInstance()->exec("DELETE FROM coupon_contact WHERE contact_id = " . $id);
    }

    if (intval($id) > 0) {
      $sql = "INSERT INTO coupon_contact VALUES(" . $this->Model->getId() . "," . $id . " , 0)";
      Amhsoft_Database::getInstance()->exec($sql);
    }
    Amhsoft_Registry::destroy('selected_contact_id');
  }

  /**
   * Finalize event
   */
  public function __finalize() {
     if (Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
     $this->getView()->assign('coupon', TRUE);
    }
    $this->getView()->assign('widget', $this->mainpanel);
    $this->show();
  }

}

?>
