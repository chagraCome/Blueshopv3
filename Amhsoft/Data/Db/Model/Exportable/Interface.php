<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

interface Amhsoft_Data_Db_Model_Exportable_Interface{
    public function getExportableAttributes($args=null);
    public function exportData($format, $map);
    public function getExportFormats();
}
?>
