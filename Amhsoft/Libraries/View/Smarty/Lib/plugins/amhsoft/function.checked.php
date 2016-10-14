<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: function.checked.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_function_checked($params, &$smarty)
{
  $checked = $params['controller'];
  $alt 	 = isset($params['alt']) ? $params['alt'] : null;
  $default = (isset($params['default'])) ? $params['default'] : "";

  if($default != "")
  {
    if($checked == $default || $alt == $default)
    return 'checked="checked"';
  }
  else
  {
    if($checked == true || $checked == 1 || $alt == true || $alt == 1)
    return 'checked="checked"';
  }
}
?>