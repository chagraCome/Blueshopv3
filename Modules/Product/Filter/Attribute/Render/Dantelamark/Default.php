<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Default.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Modules_Product_Filter_Attribute_Render_Dantelamark_Default {

  /**
   * Render
   * @param type $attributeName
   * @param type $attributeLabel
   * @param type $data
   * @param type $type
   * @return null|string
   */
  public static function Render($attributeName, $attributeLabel, $data, $type = null) {
    if (empty($data)) {
      return null;
    }
    $str = '<div class="box">';
    $str .= '<div class="box-heading toggle">' . $attributeLabel . '<span class="mobile_togglecolumn">&nbsp;</span></div>';
    $str.='<div class="box-content">';
    $str.=' <ul class="box-filter">';
    //render color input
    if ($type == 'color') {
      foreach ($data as $item) {
	$colorLabel = new Amhsoft_ColorLabel_Control('Color');
	$colorLabel->Value = $item['label'];
	switch ($item['status']) {
	  case 1:
	    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $colorLabel->Render() . '</a></li>';
	    break;
	  case 0:
	    $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $colorLabel->Render() . '</a></li>';
	    break;
	  default:
	    $str = null;
	}
      }
      $str .= '</ul></div></div>';
      return $str;
    }
    if ($type == 'range') {
      $str = '<div class="box">';
      $str .= '<div class="box-heading toggle">' . $attributeLabel . '<span class="mobile_togglecolumn">&nbsp;</span></div>';
      $str.='<div class="box-content">';
      $str.=' <ul class="box-filter">';
      foreach ($data as $item) {
	switch ($item['status']) {
	  case 1:
	    $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . ' <img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
	    break;
	  case 0:
	    $str .='<li><a href="index.php?' . $item['link'] . '">' . $item['label'] . '</a></li>';
	    break;
	  default:
	    $str .='<li><a style="cursor:default;" class="disabled"  href="#">' . $item['label'] . '</a></li>';
	}
      }
      $str .= '</ul></div></div>';
      return $str;
    }
    foreach ($data as $item) {
      switch ($item['status']) {
	case 1:
	  $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $item['label'] . '</a></li>';
	  break;
	case 0:
	  $str .='<li><a href="index.php?' . $item['link'] . '"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
	  break;
	default:
	  $str .='<li><a style="cursor:default" class="disabled"  href="#"><img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $item['label'] . '</a></li>';
      }
    }
    $str .= '</ul></ul></div></div></div>';
    return $str;
  }

}

?>
