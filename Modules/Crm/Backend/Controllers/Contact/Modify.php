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

/**
 * Description of add
 *
 * @author cherif
 */
class Crm_Backend_Contact_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Crm_Contact_Form $contactForm */
  protected $contactForm;

  /** @var Crm_Contact_Model $contactModel */
  protected $contactModel;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->contactForm = new Crm_Contact_Form('contact_form', 'POST');
    $this->getView()->setMessage(_t('Edit contact'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $contactModelAdapter = new Crm_Contact_Model_Adapter();
      $this->contactModel = $contactModelAdapter->fetchById($id);
    }
    if (!$this->contactModel instanceof Crm_Contact_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->contactForm->DataSource = new Amhsoft_Data_Set($this->contactModel);
    $this->contactForm->Bind();
  }

  /**
   * Default event
   */
  public function __default() {

    if ($this->contactForm->isSend()) {
      $this->contactForm->DataSource = Amhsoft_Data_Source::Post();
      $this->contactForm->Bind();
      if ($this->contactForm->isValid()) {
	$this->contactForm->DataBinding = $this->contactModel;
	$contactModelAdapter = new Crm_Contact_Model_Adapter();
	$contactModel = $this->contactForm->getDataBindItem();
	$contactModel->update_date_time = Amhsoft_Locale::UCTDateTime();
	$contactModelAdapter->save($contactModel);
	$this->getRedirector()->go('?module=crm&page=contact-list&ret=true');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), 'error');
      }
    }
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->getView()->assign('form', $this->contactForm);
    $this->show();
  }

}

?>
