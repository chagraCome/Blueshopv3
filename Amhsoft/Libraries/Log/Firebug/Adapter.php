<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
require dirname(__FILE__).'/FirePHP.class.php';
require dirname(__FILE__).'/fb.php';
/**
 * Description of Adapter
 *
 * @author administrator
 */
class Amhsoft_Log_Firebug_Adapter extends Amhsoft_Log_Abstract {

    public static function error($msg, $obj=null) {
        FirePHP::getInstance(true)->error('error (' . date('Y-m-d H:i:s') . '): ' . $msg);
    }

    public static function info($msg, $obj=null) {
        FirePHP::getInstance(true)->info('info (' . date('Y-m-d H:i:s') . '): ' .$msg );
                
    }

    public static function warn($msg, $obj=null) {
        FirePHP::getInstance(true)->warn($obj, 'info (' . date('Y-m-d H:i:s') . '): ' . $msg );
    }

}
?>
