<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

abstract class Amhsoft_Data_Search_Query_Linq_Abstract_Adapter{
    abstract function where($where);
    abstract function orderBy($statement);
    abstract function query($array);
}
?>
