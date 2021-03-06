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
class Workflow_Backend_Action_Sms_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Workflow_Action_Sms_Form $workFlowForm */
  protected $workFlowForm;

  /** @var Workflow_Action_Sms_Model $workFlowModel */
  protected $workFlowModel;
  public $id;

  public function __initialize() {
    $this->workFlowForm = new Workflow_Action_Sms_Form('$workFlowForm_form', 'POST');
    $this->workFlowModel = new Workflow_Action_Sms_Model();
    $this->getView()->setMessage(_t('Create new Workflow Sms Action'), View_Message_Type::INFO);
  }

  public function __default() {
    $this->workFlowForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->workFlowForm->isSend()) {
      if ($this->workFlowForm->isValid()) {
        $this->workFlowForm->DataBinding = $this->workFlowModel;
        $workFlowModelAdapter = new Workflow_Action_Sms_Model_Adapter();
        $this->workFlowModel = $this->workFlowForm->getDataBindItem();
        $this->workFlowModel->workflow_id = $this->getRequest()->getId();
        $this->id = $workFlowModelAdapter->save($this->workFlowModel);
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
    $this->close();
  }

  public function __finalize() {
    $this->getView()->assign('form', $this->workFlowForm);
    $this->popup();
  }

}

?>
