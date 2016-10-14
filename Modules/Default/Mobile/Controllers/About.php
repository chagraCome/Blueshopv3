<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Default_Mobile_About_Controller extends Amhsoft_System_Web_Controller {

  public function __initialize() {
    
  }

  public function __default() {
    
  }

  public function __finalize() {   
    $this->getView()->display('Modules/Default/Mobile/Views/About.html');
    exit;
  }

}

?>
