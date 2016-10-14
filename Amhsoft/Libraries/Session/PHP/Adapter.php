<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Session_PHP_Adapter {

    public function read($key) {
        return @$_SESSION[$key];
    }

    public function write($key, $value) {
        $_SESSION[$key] = $value;
    }

    public function destroyAll() {
        $_SESSION = array();
    }

    public function destroy($key) {
        $_SESSION[$key] = null;
        unset($_SESSION[$key]);
    }
	public function deleteOld(){
		
	}

}

?>
