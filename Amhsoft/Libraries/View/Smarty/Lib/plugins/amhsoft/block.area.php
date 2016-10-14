<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: block.area.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_block_area($params, $content, &$smarty)
{
  if(!isset($content)){
    return;
  }

  $area = $params['name'];

  if(function_exists("override_".$area))
  {
    $override = call_user_func("override_".$area, $smarty );
    return $override;
  }

  $before = null;
  $after = null;


  if(function_exists("before_".$area))
  $before = call_user_func("before_".$area,  $smarty);

  if(function_exists("after_".$area))
  $after = call_user_func("after_".$area, $smarty );

  if (isset($content))
  {
    return $before.$content.$after;
  }

}
?>