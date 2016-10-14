<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: index.php 5 2011-10-19 09:16:11Z cherif $
 * $Rev: 5 $
 * @package    Setting
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2011-10-19 11:16:11 +0200 (Mi, 19 Okt 2011) $
 * $LastChangedDate: 2011-10-19 11:16:11 +0200 (Mi, 19 Okt 2011) $
 * $Author: cherif $
 * *********************************************************************************************** */

class Setting_Backend_Template_Email_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var Setting_EmailTemplate_DataGridView $emailTemplateDataGridView */
  protected $emailTemplateDataGridView;

  /** @var Setting_EmailTemplate_Model_Adapter $emailTemplateModelAdapter */
  protected $emailTemplateModelAdapter;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
    $this->emailTemplateDataGridView = new Setting_Template_Email_DataGridView();
    $this->emailTemplateDataGridView->Sortable = true;
    $this->emailTemplateDataGridView->Searchable = true;
    $this->emailTemplateDataGridView->performSort($this->getRequest(), $this->emailTemplateModelAdapter);
    $this->emailTemplateDataGridView->performSearch($this->getRequest(), $this->emailTemplateModelAdapter);
    $this->emailTemplateDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List email templates'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->emailTemplateDataGridView->performSort($this->getRequest(), $this->emailTemplateModelAdapter);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $projects = $this->emailTemplateModelAdapter->fetch();
    $this->emailTemplateDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->emailTemplateDataGridView);
    $this->show();
  }

}

?>
