<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: block.box.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_block_box($params, $content, &$smarty){
  if(!isset($content)){
    return;
  }

  $box 	= null;
  $title	= null;
  $border = null;
  $style  = "box_top";

  if(isset($params['name']))
  $box = $params['name'];

  if(isset($params['style']))
  $style = $params['style'];

  $cachable = false;
  if(isset($params['cachable']))
  $cachable = $params['cachable'];

  if(isset($params['title']))
  $title = $params['title'];

  if(isset($params['border'])){
    if($params['border'] == 0){
      return $content;
    }else{
      $border = $params['border'];
    }
  }

  $smarty->caching = $cachable;

  $smarty->assign("block_content", $content);
  $smarty->assign("block_title", $title);
  $smarty->assign("block_border", $border);
  $smarty->assign("box_style_class", $style);

  if(function_exists("override_".$box))
  {
    $override = call_user_func("override_".$box, $smarty );
    return $override;
  }

  $before = null;
  $after = null;

  $boxtpl = $smarty->fetch("box.tpl.html");

  if(function_exists("before_".$box))
  $before = call_user_func("before_".$box,  $smarty);

  if(function_exists("after_".$box))
  $after = call_user_func("after_".$box, $smarty );

  return $before.$boxtpl.$after;

}
?>