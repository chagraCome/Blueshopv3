<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class ProductCache extends Amhsoft_System_Boot_Event_Listener_Abstract {

  public function __construct() {
    //Amhsoft_System_Boot_Event_Handler::attach($this, 'before.boot');
  }

  public function receive($eventName, Amhsoft_System $system) {
      if ($eventName == 'before.boot' && preg_match("/^(product\.backend|eav\.backend)(.*)(delete|modify|add|online|offline)/i", $system->getChannel())) {
        $system->getView()->clearCache(null, 'product');
      }
  }

}
?>
