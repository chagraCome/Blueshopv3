<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Api
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_Api_Abstract_Adapter {

  /** @var Amhsoft_Api_Package $package */
  protected $package;

  abstract function responce(Amhsoft_System $system);

  abstract function error($message);

  

  /**
   * 
   * @return Amhsoft_Api_Package $package
   */
  public function getPackage() {
    return $this->package;
  }
  
  public function isLoginPackage() {
    if (!$this->package->Class && $this->package->Procedure == 'login') {
      return true;
    }
    return false;
  }
  
  
  public function analysePackage($rpc_request) {
    
    $rpc_request = html_entity_decode($rpc_request);
    $simpleXml = @simplexml_load_string($rpc_request);
    if (!$simpleXml) {
      $this->error('xml malformed');
      exit;
    }
    
    $this->package = new Amhsoft_Api_Package();
    $this->package->Procedure = (string) $simpleXml->package->custom;
    if ($this->package->Procedure == 'login') {
      $this->package->Params['username'] = (string) $simpleXml->package->params->username;
      $this->package->Params['password'] = (string) $simpleXml->package->params->password;
      return $this->package;
    }
    $this->package->Class = (string) ($simpleXml->package->class);
    $this->package->Procedure = (string) $simpleXml->package->procedure;

    if ($this->package->Procedure == 'deleteById') {
      $this->package->Params['id'] = (string) $simpleXml->package->id;
      return $this->package;
    }
    if ($this->package->Procedure == 'fetch') {
      $this->package->Params['filter']['where'] = (string) $simpleXml->package->filter->where;
      $this->package->Params['filter']['limit'] = (string) $simpleXml->package->filter->limit;
      $this->package->Params['filter']['orderby'] = (string) $simpleXml->package->filter->orderby;
      return $this->package;
    }
    if ($this->package->Procedure == 'save') {
      foreach ($simpleXml->package->{$this->package->Class}->children() as $attribute) {
        $this->package->Params['attr'][$attribute->getName()] = (string) $attribute;
      }
      return $this->package;
    }
    
    $this->package->WebForm['module'] = (string) $simpleXml->webform->module;
    $this->package->WebForm['controller'] = (string) $simpleXml->webform->controller;
    $this->package->WebForm['event'] = (string) $simpleXml->webform->event;
    
    foreach ($simpleXml->webform->params->param as $param) {
      $this->package->WebForm['param'][] = array('name'=>(string) $param['name'], 'rtype' => (string) $param['rtype'], 'value' => (string) $param['value']);
    }
     
    return $this->package;
   
  }

}
