<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

interface Amhsoft_System_Runnable{
    public function run(Amhsoft_System_Thread_Progress $progress, $parms=array()); 
}
?>
