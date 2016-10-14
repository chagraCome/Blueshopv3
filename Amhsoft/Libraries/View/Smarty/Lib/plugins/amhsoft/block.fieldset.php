<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: block.fieldset.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function smarty_block_fieldset($params, $content, $template, &$repeat)
{
  if(!isset($content)){
    return;
  }
  $fieldset = $params['name'];
  $title = $params['title'];

  $fieldsettpl = "<fieldset class='withborder'><legend>$title</legend>";
  
  $fieldsettpl .= $content;
  $fieldsettpl .="</fieldset>";

  if(function_exists("override_fieldset".$fieldset))
  {
    $override = call_user_func("override_fieldset_".$fieldset, $smarty );
    return $override;
  }


  $before = null;
  $after = null;

  if($content)
  {

    $fieldsettpl = "<fieldset class='withborder'><legend>$title</legend>";
    $fieldsettpl .= $content;
    $fieldsettpl .="</fieldset>";


    if(function_exists("before_fieldset_".$fieldset))
    $before = call_user_func("before_fieldset_".$fieldset,  $smarty);

    if(function_exists("after_fieldset_".$fieldset))
    $after = call_user_func("after_fieldset_".$fieldset, $smarty );

    return $before.$fieldsettpl.$after;
  }
}
?>