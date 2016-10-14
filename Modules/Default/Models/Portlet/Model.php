<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    offer
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Default_Portlet_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $module;
  public $callback;
  public $name;

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
   * @return Default_Portlet_Model
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets module.
   * @return 
   * */
  public function getModule() {
    return $this->module;
  }

  /**
   * Set module.
   * @param  module 
   * @return Default_Portlet_Model
   * */
  public function setModule($module) {
    $this->module = $module;
    return $this;
  }

  /**
   * Gets callback.
   * @return 
   * */
  public function getCallback() {
    return $this->callback;
  }

  /**
   * Set callback.
   * @param  callback 
   * @return Default_Portlet_Model
   * */
  public function setCallback($callback) {
    $this->callback = $callback;
    return $this;
  }

  /**
   * Gets name.
   * @return 
   * */
  public function getName() {
    return $this->name;
  }

  /**
   * Set name.
   * @param  name 
   * @return Default_Portlet_Model
   * */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * 
   * GetContent
   */
  public function getContent() {
    $boot = 'Modules_' . $this->module . '_Backend_Boot';
    if (Amhsoft_System_Module_Manager::isModuleInstalled($this->module) && class_exists($boot, false)) {
      return @call_user_func_array(array($boot, $this->callback), array());
    }
  }

   public function __get($name) {

    if ($name == 'name_t') {
      return _t($this->getName());
    }

    
  }
}

?>