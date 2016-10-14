<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Ressources_Fullcalendar_Event_Collection{
    private $items = array();
    
    public function addItem(Amhsoft_Ressources_Fullcalendar_Event_Item $item){
        $this->items[] = $item;
    }
    
    public function asArray(){
        $array = array();
        foreach($this->items as $item){
            $array[] = $item->asArray();
        }
        return $array;
    }
    
    public function asJson(){
        return json_encode($this->asArray());
    }

}
?>
