<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
interface Amhsoft_Session_Interface {
      public function read($key);
      
    public function write($key, $value);

    public function destroyAll();

    public function destroy($key);
	
	public function deleteOld();
}
?>
