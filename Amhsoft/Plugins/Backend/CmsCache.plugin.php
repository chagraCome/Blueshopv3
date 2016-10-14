<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class CmsCache extends Amhsoft_System_Boot_Event_Listener_Abstract {

    public function __construct() {
        //Amhsoft_System_Boot_Event_Handler::attach($this, 'before.boot');
    }

    public function receive($eventName, Amhsoft_System $system) {
        if ($eventName == 'before.boot' && preg_match("/^Cms/i", $system->getRooter()->getRoot())) {
            //$id = md5(serialize($_GET));
            // $system->getView()->caching = true;
            // $system->getView()->cache_lifetime = 3600;
            // $system->getView()->cache_id = $id;
            // $system->getView()->cache_dir = 'cache/Frontend/tmp/';

           $system->getView()->clearCache(null, 'cms');
            
        }
    }

}

?>
