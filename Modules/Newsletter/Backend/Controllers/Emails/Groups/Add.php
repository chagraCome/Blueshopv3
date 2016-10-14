<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newsletter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_Groups_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Emails_Groups_Form newsletterEmailsGroupsForm */
  protected $newsletterEmailsGroupsForm;

  /** @var Newsletter_Email_Group_Model newsletterEmailGroupModel */
  protected $newsletterEmailGroupModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->newsletterEmailsGroupsForm = new Newsletter_Emails_Groups_Form('newsletterEmailsGroupsForm_form', 'POST');
    $this->newsletterEmailGroupModel = new Newsletter_Email_Group_Model();
    $this->getView()->setMessage(_t('Add Email Group'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->newsletterEmailsGroupsForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->newsletterEmailsGroupsForm->isSend()) {
      if ($this->newsletterEmailsGroupsForm->isValid()) {
	$this->newsletterEmailsGroupsForm->DataBinding = $this->newsletterEmailGroupModel;
	$newsletterEmailGroupModelAdapter = new Newsletter_Email_Group_Model_Adapter();
	$this->newsletterEmailGroupModel = $this->newsletterEmailsGroupsForm->getDataBindItem();
	$newsletterEmailGroupModelAdapter->save($this->newsletterEmailGroupModel);
	$this->handleSuccess();
      } else {
	$this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    Amhsoft_Navigator::go('admin.php?module=newsletter&page=emails-groups-list&ret=true');
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->newsletterEmailsGroupsForm);
    $this->show();
  }

}

?>