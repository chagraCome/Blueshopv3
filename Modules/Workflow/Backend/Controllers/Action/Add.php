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
class Workflow_Backend_Action_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Workflow_Action_Form $workFlowForm */
  protected $workFlowForm;

  /** @var Workflow_Model $workFlowModel */
  protected $workFlowModel;
  public $id;

  public function __initialize() {
    $this->workFlowForm = new Workflow_Action_Form('$workFlowForm_form', 'POST');
    $this->workFlowModel = new Workflow_Action_Model();
    $this->getView()->setMessage(_t('Create new Workflow Action'), View_Message_Type::INFO);
  }

  public function __default() {
    $this->workFlowForm->DataSource = Amhsoft_Data_Source::Post();
    if ($this->workFlowForm->isSend()) {
      if ($this->workFlowForm->isValid()) {
        $this->workFlowForm->DataBinding = $this->workFlowModel;
        $workFlowModelAdapter = new Workflow_Action_Model_Adapter();
        $this->workFlowModel = $this->workFlowForm->getDataBindItem();
        $this->id = $workFlowModelAdapter->save($this->workFlowModel);
        $this->handleSuccess();
      } else {
        $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
      }
    }
  }

  public function __select() {
     $id = $this->getRequest()->getId();
    if ($id > 0) {
      Amhsoft_Registry::register('workflow_action_selected_id', $id);
    }
    $this->close();
  }

  /**
   * Handle success.
   */
  protected function handleSuccess() {
    $this->getRedirector()->go("admin.php?module=workflow&page=action-add&event=select&id=$this->id");
  }

  public function __finalize() {
    $this->getView()->assign('form', $this->workFlowForm);
    $this->popup();
  }

}

?>
