<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

interface Amhsoft_Cache_Interface{
    public function add($key, $data);
    public function get($key);
}
?>
