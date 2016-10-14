<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Eav_Entity_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $model;
  public $table;
  public $typeof;

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return Eav_Entity_Model
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets model.
   * @return 
   * */
  public function getModel() {
    return $this->model;
  }

  /**
   * Set model.
   * @param  model 
   * @return Eav_Entity_Model
   * */
  public function setModel($model) {
    $this->model = $model;
    return $this;
  }

  /**
   * Gets table.
   * @return 
   * */
  public function getTable() {
    return $this->table;
  }

  /**
   * Set table.
   * @param  table 
   * @return Eav_Entity_Model
   * */
  public function setTable($table) {
    $this->table = $table;
    return $this;
  }

  /**
   * Gets typeof.
   * @return 
   * */
  public function getTypeof() {
    return $this->typeof;
  }

  /**
   * Set typeof.
   * @param  typeof 
   * @return Eav_Entity_Model
   * */
  public function setTypeof($typeof) {
    $this->typeof = $typeof;
    return $this;
  }

}

?>