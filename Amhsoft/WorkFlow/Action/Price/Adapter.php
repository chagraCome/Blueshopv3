<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Action_Price_Adapter extends Amhsoft_WorkFlow_Action_Abstract{
    
    private $fixedSale;
    private $percentSale;
    
    public function __construct($fixedSale, $percentSale=0) {
        $this->fixedSale = $fixedSale;
        $this->percentSale = $percentSale;
    }
    
    public function execute($parms=null) {
        if($parms->price <= 0){
            return;
        }
        if($this->fixedSale > 0){
            $parms->price = $parms->price - $this->fixedSale;
        }else{
            if($this->percentSale > 0){
                $parms->price = $parms->price - ($parms->price/100)*$this->percentSale;
            }
        }
        
    }
}
?>
