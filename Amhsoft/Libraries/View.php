<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: View.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_View {

  private $adapter;
  private $layoutName;
  private $skinName;
  private static $instance;

  public function __construct() {
    
  }

  /**
   * Gets View
   * @return Amhsoft_View
   */
  public static function getInstance() {
    if (self::$instance == null) {
      self::$instance = new self();
    }
    return self::$instance;
  }

  public function setAdapter(Amhsoft_View_Interface $adapter) {
    $this->adapter = $adapter;
  }
  
  public function getAdapter(){
      return $this->adapter;
  }
  
  public function setDelimiters($left, $right){
      $this->adapter->left_delimiter = $left;
      $this->adapter->left_delimiter = $right;
  }

  public function setMessage($msg, $type = View_Message_Type::INFO) {
    $this->assign('message', $msg);
    $this->assign('class', $type);
  }

  public function setViewDir($dir) {
    $this->adapter->setTemplateDir($dir);
  }

  public function setLayout($layout) {
    $this->layoutName = $layout;
    $this->adapter->addTemplateDir($this->getLayoutPath());
  }

  public function setSkin($skin) {
    $this->skinName = $skin;
  }

  public function getSkin() {
    return $this->skinName;
  }

  public function getSkinPath() {
    return $this->getLayoutPath() . '/Layout/' . $this->skinName;
  }

  public function getLayoutPath() {
    return 'Design/' . Amhsoft_System::getLevel() . '/' . $this->layoutName;
  }

  public function display($template = null, $cache_id = null) {
    $this->adapter->display($template, $cache_id);
  }

  public function createTemplate($template = null) {
    return $this->adapter->createTemplate($template);
  }

  public function fetch($template = null) {
    return $this->adapter->fetch($template);
  }

    public function assign($tpl_var, $value = null, $nocache = false) {
      return $this->adapter->assign($tpl_var, $value, $nocache);
    }
  
 

  public function appendappend($tpl_var, $value, $merge=false, $nocache=false){
      return $this->adapter->append($tpl_var, $value);
  }
  
   public function isCached($template = null, $cache_id = null, $compile_id = null, $parent = null) {
       return $this->adapter->isCached($template, $cache_id, $compile_id, $parent);
    }
  
  public function __call($name, $arguments) {
    return call_user_func_array(array($this->adapter, $name), $arguments);
  }

  public function __get($name) {
    return $this->adapter->$name;
  }

  public function __set($name, $val) {
    $this->adapter->$name = $val;
  }

}

interface View_Message_Type {

  const ERROR = 'panelError';
  const INFO = 'panelInfo';
  const SUCCESS = 'panelSuccess';

}

