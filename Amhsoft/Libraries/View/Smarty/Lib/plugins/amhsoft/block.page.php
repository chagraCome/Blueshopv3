<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: block.page.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_block_page($params, $content, &$smarty)
{

  if(!isset($content)){
    return;
  }

    $page = $params['name'];
    $title = $params['title'];
    $border = $params['border'];
    $content_style = isset($params['content_style']) ? $params['content_style'] : null;


    $cachable = false;
    if(isset($params['cachable']))
    $cachable = $params['cachable'];


    $smarty->caching = $cachable;

    $smarty->assign("page_content", $content);
    $smarty->assign("page_title", $title);
    $smarty->assign("page_border", $border);
    $smarty->assign("content_style", $content_style);

    if(function_exists("override_page_".$page))
    {
      $override = call_user_func("override_page_".$page, $smarty );
      return $override;
    }


    $before = null;
    $after = null;
    $pagetpl = $smarty->fetch("page.tpl.html");

    if(function_exists("before_page_".$page))
    $before = call_user_func("before_page_".$page,  $smarty);

    if(function_exists("after_page_".$page))
    $after = call_user_func("after_page_".$page, $smarty );

    return $before.$pagetpl.$after;


}
?>