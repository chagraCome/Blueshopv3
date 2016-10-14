<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
require_once dirname(__FILE__) . '/Lib/Smarty.class.php';

class Amhsoft_View_Smarty_Adapter extends Smarty implements Amhsoft_View_Interface {

  public function __construct() {
    parent::__construct();

    $this->compile_dir = 'cache/';
    $this->plugins_dir = array(SMARTY_DIR . 'plugins', SMARTY_DIR . 'plugins' . DIRECTORY_SEPARATOR . 'amhsoft');
    $this->error_reporting = E_ALL ^ E_NOTICE;
    $this->compile_check = false;
    $this->force_compile = false;
    $this->merge_compiled_includes = false;
    $this->caching = false;
    $this->cache_lifetime = 1440;
    $this->cache_id = $this->calculateCacheId();
  }

  
  public function calculateCacheId(){
    return md5(var_export($_REQUEST, true));
  }
  
  public function setMessage($message, $typ = 'panelInfo') {

    if ($typ == 'error')
      $this->assign('class', 'panelError');

    if ($typ == 'info')
      $this->assign('class', 'panelInfo');

    if ($typ == 'success')
      $this->assign('class', 'panelSuccess');

    $this->assign('message', $message);
  }

}

/**
 * Smarty {php}{/php} block function
 *
 * @param array   $params   parameter list
 * @param string  $content  contents of the block
 * @param object  $Amhsoft_Template Amhsoft_Template object
 * @param boolean &$repeat  repeat flag
 * @return string content re-formatted
 */
function smarty_php_tag($params, $content, $Amhsoft_Template, &$repeat) {
  eval($content);
  return '';
}

?>
