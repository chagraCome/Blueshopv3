<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Rooter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_System_Rooting_Web_Rooter extends Amhsoft_System_Rooting_Abstract {

  public function getRoot() {
    $webResponce = new Amhsoft_Web_Request();
    $module = $webResponce->get('module');
    $page = $webResponce->get('page') ? $webResponce->get('page') : 'index';
    if ($page == "list-api") {
      $page = "api-list";
    }
    if ($page == "add-api") {
      $page = "api-add";
    }

    if ($module == "vehiclerequest") {
      $module = 'request';
    }

    if ($page == "makes-api") {
      $page = "api-makes";
    }

    if ($page == "account-api") {
      $page = "api-account";
    }
    if ($page == "listbb-api") {
      $page == "api-listbb";
    }
    $page_array = explode('-', $page);

    for ($i = 0; $i < count($page_array); $i++) {
      $page_array[$i] = ucfirst(strtolower($page_array[$i]));
    }

    $page_string = implode('_', $page_array);

    if ($module) {
      $root =  ucfirst(strtolower($module)) . '_' . Amhsoft_System::getLevel() . '_' . $page_string . '_Controller';
    } else {
      $root = 'Default_' . Amhsoft_System::getLevel() . '_' . $page_string . '_Controller';
    }
    
    if(preg_match("/^[a-zA-Z0-9_]*$/i", $root)){
      return $root;
    }else{
      return 'Default_' . Amhsoft_System::getLevel() . '_Notfound_Controller';
    }
    
  }

}

?>
