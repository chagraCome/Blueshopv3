<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of WorkFlow
 *
 * @author administrator
 */
class Amhsoft_WorkFlow extends Amhsoft_Data_Db_Model_Event_Listener_Abstract{

    public $name;
    public $event;
    public $state;

    /** @var Amhsoft_WorkFlow_Action_Collection $actionCollection */
    public $actionCollection;

    /** @var Amhsoft_WorkFlow_Condition_Collection $conditionCollection */
    public $conditionCollection;

    public static function observe() {
        $self = new Amhsoft_WorkFlow();
        $workflowAdapter = new Workflow_Model_Adapter();
        $iterator = $workflowAdapter->fetch();
        foreach ($iterator as $wf) {
            Amhsoft_Data_Db_Model_Event_Handler::attach($self, $wf->getTriggerName());
        }
    }

    public function __construct() {
        $this->actionCollection = new Amhsoft_WorkFlow_Action_Collection();
        $this->conditionCollection = new Amhsoft_WorkFlow_Condition_Collection();
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getEvent() {
        return $this->event;
    }

    public function setEvent($event) {
        $this->event = $event;
    }

    public function getActionCollection() {
        return $this->actionCollection;
    }

    public function setActionCollection(Amhsoft_WorkFlow_Action_Collection $actionCollection) {
        $this->actionCollection = $actionCollection;
    }

    public function getConditionCollection() {
        return $this->conditionCollection;
    }

    public function setConditionCollection(Amhsoft_WorkFlow_Condition_Collection $conditionCollection) {
        $this->conditionCollection = $conditionCollection;
    }

    public function addAction(Amhsoft_WorkFlow_Action_Abstract $action) {

        $this->actionCollection->add($action);
    }

    public function addCondition(Amhsoft_WorkFlow_Condition_Abstract $condition) {
        $this->conditionCollection->add($condition);
    }

    public function getState() {
        return $this->state;
    }

    public function setState($state) {
        $this->state = $state;
    }

    public function run($params = null) {
        if ($this->getState() == true) {
            if ($this->conditionCollection->valid($params)) {
                $this->actionCollection->execute($params);
            }
        }
    }

    public function receive($eventname, Amhsoft_Data_Db_Model_Adapter $sender, $args) {

        $workflowModelAdapter = new Workflow_Model_Adapter();
        $workFlowModel = $workflowModelAdapter->fetchByTriggerName($eventname);

        if ($workFlowModel instanceof Workflow_Model) {
            $wf = new Amhsoft_WorkFlow();
            $wf->setState($workFlowModel->getState());
            foreach ($workFlowModel->getConditions() as $condition) {
                if ($condition->getState() == 1) {
                    $wf->addCondition(new Amhsoft_WorkFlow_Condition($condition->getConditionLeft(), $condition->getConditionRight(), $condition->getConditionOp()));
                }
            }

            //mail part
            $mailActions = $workFlowModel->getMailactions();
            foreach ($mailActions as $mailAction) {
                if ($mailAction->getState() == 1) {
                    $wf->addAction(new Amhsoft_WorkFlow_Action_Mail_Adapter($mailAction));
                }
            }

            $wf->run($args);
        }
    }

}

?>
