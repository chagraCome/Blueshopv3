<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Table
 *
 * @author administrator
 */
class Amhsoft_Currency_Converter_Adapter_Table extends Amhsoft_Currency_Converter_Adapter_Abstract{

    private $tableName;
    private $rateCol;
    private $setId;

    public function getTableName() {
        return $this->tableName;
    }

    public function setTableName($tableName) {
        $this->tableName = $tableName;
    }


    public function getRateCol() {
        return $this->rateCol;
    }

    public function setRateCol($rateCol) {
        $this->rateCol = $rateCol;
    }

    function __construct($tableName = null, $rateCol = null, $setId=null) {
        $this->tableName = $tableName;
        $this->setId = $setId;
        $this->rateCol = $rateCol;
    }

    public function getRates() {
        try {
            $db = Amhsoft_Database::getInstance();
            $where = null;
            if(intval($this->setId) > 0){
                $where = " WHERE id = '$this->setId' ";
            }
            $stmt = $db->query("SELECT  `$this->rateCol`  FROM `$this->tableName` $where ORDER BY id DESC LIMIT 1");
            $stmt->execute();
            $rates_string = $stmt->fetchColumn();
            $rates = array();
            if($rates_string){
               $rates = json_decode($rates_string);
               return $rates;
            }else{
                return $rates;
            }
        } catch (Exception $e) {
            return array();
        }
    }

}

?>
