<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Plugin_Mail_Action implements Amhsoft_WorkFlow_Plugin_Interface{
    public function execute($sender, array $params) {
        foreach($params as $model){
            //mail client
            //to? from? subject?, content?
            //?? template_id. to?? [CarOwner::email],  from?, subject?, template->getContent($params)
        }
    }
}
?>
