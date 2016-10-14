<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
class Workflow_Action_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $type;
    public $name;
    public $template_id;
    public $workflow_id;
    
    public $template;
    
    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getType() {
        return $this->type;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getTemplate_id() {
        return $this->template_id;
    }

    public function setTemplate_id($template_id) {
        $this->template_id = $template_id;
    }

    public function getWorkflow_id() {
        return $this->workflow_id;
    }

    public function setWorkflow_id($workflow_id) {
        $this->workflow_id = $workflow_id;
    }


    
}
?>
