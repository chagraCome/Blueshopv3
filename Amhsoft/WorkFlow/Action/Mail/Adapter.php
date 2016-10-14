<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Action_Mail_Adapter extends Amhsoft_WorkFlow_Action_Abstract {

  /** @var Workflow_Action_Mail_Model $model */
  private $model;

  public function __construct(Workflow_Action_Mail_Model $model) {
    $this->model = $model;
  }

  public function execute($parms = null) {
    
      if (!is_array($parms)) {
      $parms = array($parms);
    }
    


    $mailClient = new Amhsoft_Mail_Client();
    $mailClient->SetFrom($this->model->getFrom());
    $adress = $this->model->getFilledAdress($parms);
    $adresses = @explode(',', $adress);
    $emailValidator = new Amhsoft_Email_Validator();
    foreach ($adresses as $ad) {
      $ad = trim($ad);
      $emailValidator->setValue($ad);
      if ($emailValidator->isValid()) {
        $mailClient->AddAddress($ad);
      }
    }
    $mailClient->SetSubject($this->model->getSubject());
    $mailClient->SetHtmlBody(@htmlspecialchars_decode($this->model->getFilledContent($parms)));
    try {
      $mailClient->Send();
      return true;
    } catch (Exception $e) {
        Amhsoft_Debugger::addException($e);
      return false;
    }
  }

}

?>
