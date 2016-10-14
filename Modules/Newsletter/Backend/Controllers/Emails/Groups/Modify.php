<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newslatter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_Groups_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Newsletter_Emails_Groups_Form newsletterEmailsGroupsForm */
  protected $newsletterEmailsGroupsForm;

  /** @var Newsletter_Email_Group_Model newsletterEmailGroupModel */
  protected $newsletterEmailGroupModel;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->newsletterEmailsGroupsForm = new Newsletter_Emails_Groups_Form('newsletterEmailsGroupsForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Email Group'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $newsletterEmailGroupModelAdapter = new Newsletter_Email_Group_Model_Adapter();
      $this->newsletterEmailGroupModel = $newsletterEmailGroupModelAdapter->fetchById($id);
    }
    if (!$this->newsletterEmailGroupModel instanceof Newsletter_Email_Group_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->newsletterEmailsGroupsForm->DataSource = new Amhsoft_Data_Set($this->newsletterEmailGroupModel);
    $this->newsletterEmailsGroupsForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->newsletterEmailsGroupsForm->isSend()) {
      $this->newsletterEmailsGroupsForm->DataSource = Amhsoft_Data_Source::Post();
      $this->newsletterEmailsGroupsForm->Bind();
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

