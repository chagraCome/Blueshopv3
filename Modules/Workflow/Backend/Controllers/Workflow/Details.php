<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: index.class.php 879 2011-06-20 04:31:08Z Montasser $
 * $Rev: 879 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2011-06-20 06:31:08 +0200 (Mo, 20. Jun 2011) $
 * $Author: Montasser $
 */
class Workflow_Backend_Workflow_Details_Controller extends Amhsoft_System_Web_Controller {

  /** @var Workflow_Panel $workFlowPanel */
  protected $workFlowPanel;

  /** @var Workflow_Model $workFlowModel */
  protected $workFlowModel;

  public function __initialize() {
    $id = $this->getRequest()->getId();
    if ($id <= 0) {
      die('Access denied');
    }
    $this->workFlowPanel = new Workflow_Panel();
    $workFlowModelAdapter = new Workflow_Model_Adapter();
    $this->workFlowModel = $workFlowModelAdapter->fetchById($id);


    if (!$this->workFlowModel instanceof Workflow_Model) {
      die('Requested Workflow not found');
    }

    $this->getView()->setMessage(_t('Workflow Details'), View_Message_Type::INFO);
  }

  public function __default() {
    $this->setUpConditionGrid();
    $this->setUpMailActionGrid();
    $this->setUpActionSmsGrid();
  }

  protected function setUpConditionGrid() {

    $panel = new Amhsoft_Widget_Panel(_t("WorkFlow Condition"));
    $dataGridView = new Workflow_Condition_DataGridView();
    $dataGridView->DataSource = new Amhsoft_Data_Set($this->workFlowModel->getConditions());

    $addLink = new Amhsoft_Link_Control(_t('Add new Condition'), 'admin.php?module=workflow&page=condition-add&id='. $this->workFlowModel->getId());
    $addLink->onClickOpenInPopUp('680', '320');
    $addLink->Class = 'add';
    $panel->addComponent($dataGridView);
    $panel->addComponent($addLink);
    $this->workFlowPanel->addComponent($panel);
  }

  protected function setUpMailActionGrid() {
    $panel = new Amhsoft_Widget_Panel(_t("WorkFlow Mail Action"));
    $dataGridView = new Workflow_Action_Mail_DataGridView();
    $dataGridView->DataSource = new Amhsoft_Data_Set($this->workFlowModel->getMailactions());
    $addLink = new Amhsoft_Link_Control(_t('Add new Mail Action'), 'admin.php?module=workflow&page=action-mail-add&id=' . $this->workFlowModel->getId());
    $addLink->onClickOpenInPopUp('800', '760');
    $addLink->Class = 'add';
    $panel->addComponent($dataGridView);
    $panel->addComponent($addLink);
    $this->workFlowPanel->addComponent($panel);
  }

  protected function setUpActionSmsGrid() {
    $panel = new Amhsoft_Widget_Panel(_t("WorkFlow Sms Action"));
    $dataGridView = new Workflow_Action_Sms_DataGridView();
    $dataGridView->DataSource = new Amhsoft_Data_Set($this->workFlowModel->getSmsactions());
    $addLink = new Amhsoft_Link_Control(_t('Add new Sms Action'), 'admin.php?module=workflow&page=action-sms-add&id=' . $this->workFlowModel->getId());
    $addLink->onClickOpenInPopUp('860', '380');
    $addLink->Class = 'add';
    $panel->addComponent($dataGridView);
    $panel->addComponent($addLink);
    $this->workFlowPanel->addComponent($panel);
  }

  public function __finalize() {

    $this->workFlowPanel->setDataSource(new Amhsoft_Data_Set($this->workFlowModel));
    $this->workFlowPanel->Bind();
    $this->getView()->assign('panel', $this->workFlowPanel);
    $this->show();
  }

}

?>
