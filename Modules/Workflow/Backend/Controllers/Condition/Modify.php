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
class Workflow_Backend_Condition_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Workflow_Condition_Form $workFlowForm */
  protected $workFlowForm;

  /** @var Workflow_Condition_Model $workFlowModel */
  protected $workFlowModel;

  public function __initialize() {
    $this->workFlowForm = new Workflow_Condition_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Workflow Condition'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $workFlowModelAdapter = new Workflow_Condition_Model_Adapter();
      $this->workFlowModel = $workFlowModelAdapter->fetchById($id);
    }
    if (!$this->workFlowModel instanceof Workflow_Condition_Model) {
      die('Requested Workflow Condition not found');
    }
    $this->workFlowForm->DataSource = new Amhsoft_Data_Set($this->workFlowModel);
    $this->workFlowForm->Bind();
  }

  public function __default() {
    if ($this->workFlowForm->isSend()) {
      $this->workFlowForm->DataSource = Amhsoft_Data_Source::Post();
      $this->workFlowForm->Bind();
      if ($this->workFlowForm->isValid()) {
        $this->workFlowForm->DataBinding = $this->workFlowModel;
        $workFlowModelAdapter = new Workflow_Condition_Model_Adapter();
        $this->workFlowModel = $this->workFlowForm->getDataBindItem();
        $workFlowModelAdapter->save($this->workFlowModel);
        $this->handleSuccess();
      } else {
        $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  protected function handleSuccess() {
    $this->getRedirector()->go(Amhsoft_History::back());
  }

  public function __finalize() {
    $this->getView()->assign('form', $this->workFlowForm);
    $this->show();
  }

}

?>
