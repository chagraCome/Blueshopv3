<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
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
class Crm_Backend_Contact_Add_Controller extends Amhsoft_System_Web_Controller {

  protected $contactForm;

  /**
   * Initialize event
   */
  public function __initialize() {
    $this->contactForm = new Crm_Contact_Form('contact_form', 'POST');
    $this->getView()->setMessage(_t('Add contact'), View_Message_Type::INFO);
    $contactModel = new Crm_Contact_Model();
    $this->contactForm->numberInput->Value = $contactModel->getNextContactNumber();
  }

  /**
   * Default event
   */
  public function __default() {
    if ($this->contactForm->isSend()) {
      if ($this->contactForm->isValid()) {
	$contactModel = new Crm_Contact_Model();
	$this->contactForm->DataBinding = $contactModel;
	$contactModel = $this->contactForm->getDataBindItem();
	$contactModelAdapter = new Crm_Contact_Model_Adapter();
	$contactModel->create_date_time = Amhsoft_Locale::UCTDateTime();
	$contactModel->update_date_time = Amhsoft_Locale::UCTDateTime();
	$contactModelAdapter->save($contactModel);
	$this->getRedirector()->go('?module=crm&page=contact-list&ret=true');
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
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
