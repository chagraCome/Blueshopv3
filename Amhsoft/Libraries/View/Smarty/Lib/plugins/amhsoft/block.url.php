<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: block.url.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_block_url($params, $content, &$smarty){
  if(isset($content)){
    global $config;
    $url = isset($params['url']) ? $params['url'] : null;
	if($url == null){
		return;
	}
    $u = array();
    if($smarty->url_friendly == true){
      $pairs = explode('&', $content);
      foreach($pairs as $pair) {
        $new = explode('=', $pair, 2);
        $code_entities_match = array( '"' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&amp;' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'&lt;' ,'&gt;' ,'?' ,'[' ,']' ,'' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,'—' ,'–','–');
        $code_entities_replace = array('');
        $u[] = str_replace($code_entities_match, $code_entities_replace, $new[1]);
      }
      $friendly_url = implode("-",$u). ".html";
      return $config->shop_url.$friendly_url;
    }
    return ($config->shop_url.$content);
  }
}


function clean_url($text){
  $code_entities_match = array( '"' ,'!' ,'@' ,'#' ,'$' ,'%' ,'^' ,'&amp;' ,'*' ,'(' ,')' ,'+' ,'{' ,'}' ,'|' ,':' ,'"' ,'&lt;' ,'&gt;' ,'?' ,'[' ,']' ,'' ,';' ,"'" ,',' ,'.' ,'_' ,'/' ,'*' ,'+' ,'~' ,'`' ,'=' ,' ' ,'—' ,'–','–');
  $code_entities_replace = array('');
  $text = str_replace($code_entities_match, $code_entities_replace, $text);  // for replacing
  return $text;
}
?>