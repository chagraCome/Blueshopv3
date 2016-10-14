<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Crm_Backend_Account_Address_Modify_Controller extends Amhsoft_System_Web_Controller {

  protected $id;

  /** @var Crm_Address_Model $addressModel */
  protected $addressModel;

  /** @var Crm_Address_Form $addressFrom */
  protected $addressFrom;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $addressModelAdapter = new Crm_Address_Model_Adapter();
    $this->addressModel = $addressModelAdapter->fetchById($this->id);
    if (!$this->addressModel instanceof Crm_Address_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->addressFrom = new Crm_Address_Form('address_form', 'POST');
    $this->addressFrom->DataSource = new Amhsoft_Data_Set($this->addressModel);
    $this->addressFrom->Bind();
  }

  /**
   * Default event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Manage Address'), View_Message_Type::INFO);
    if ($this->addressFrom->isSend()) {
      if ($this->addressFrom->isFormValid()) {
	$this->addressFrom->DataBinding = $this->addressModel;
	$this->addressFrom->Bind();
	$this->addressModel = $this->addressFrom->getDataBindItem();
	$addressModelAdapter = new Crm_Address_Model_Adapter();
	$e = $addressModelAdapter->save($this->addressModel);
	if ($e > 0) {
	  $this->getRedirector()->go('admin.php?module=crm&page=account-detail&id=' . $this->addressModel->getAccountId() . '&ret=true');
	} else {
	  $this->getView()->setMessage(_t('Data can not be saved'), View_Message_Type::ERROR);
	}
      } else {
	$this->getView()->setMessage(_t('Please check your inputs'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->addressFrom);
    $this->show();
  }

}

?>
