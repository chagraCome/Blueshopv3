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
class Workflow_Backend_Action_Mail_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Workflow_Action_Mail_Form $workFlowForm */
  protected $workFlowForm;

  /** @var Workflow_Action_Mail_Model $workFlowModel */
  protected $workFlowModel;

  public function __initialize() {
    $this->workFlowForm = new Workflow_Action_Mail_Form('project_form', 'POST');
    $this->getView()->setMessage(_t('Edit Workflow Mail Action'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $workFlowModelAdapter = new Workflow_Action_Mail_Model_Adapter();
      $this->workFlowModel = $workFlowModelAdapter->fetchById($id);
    }
    if (!$this->workFlowModel instanceof Workflow_Action_Mail_Model) {
      die('Requested Workflow Action Mail not found');
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
        $workFlowModelAdapter = new Workflow_Action_Mail_Model_Adapter();
        $this->workFlowModel = $this->workFlowForm->getDataBindItem();
       
        $workFlowModelAdapter->save($this->workFlowModel);
        $this->handleSuccess();
      } else {
        $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  protected function handleSuccess() {
    $this->close();
  }

  public function __finalize() {
    $this->getView()->assign('form', $this->workFlowForm);
    $this->popup();
  }

}

?>
