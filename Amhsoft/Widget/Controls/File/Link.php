<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Link.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * link component
 * @author Amir Cherif
 */
class Amhsoft_File_Link_Control extends Amhsoft_Link_Control implements Amhsoft_Widget_Interface {

  
  /**
   * Draw/Render component
   * @return string output like HTML
   */
  public function Render() {

    if ($this->popup == true) {
      $this->JavaScript = "return onClick='popup(\"" . $this->Href . "\", $this->popupWidth, $this->popupHeight)'";
      $this->Href = 'javascript:void(0)';
    }

    if ($this->overrideRender != null) {
      return $this->overrideRender->dispatchEvent($this);
    }


    $intern_value = ($this->DisplayValue == true) ? $this->ValueToDisplay : $this->Label;
    $extstring = null;
    $ext = @end(@explode('.', $intern_value));
    if ($ext) {
      $icon_path = 'Amhsoft/Ressources/Icons/fileicons/' . strtolower($ext) . '.png';
      if (file_exists($icon_path)) {
        $extstring = '<img src="' . $icon_path . '"></img>&nbsp;';
      }
    }

    $fragment = $this->Fragment == null ? null : '#' . $this->Fragment;
    $str = '<a href="' . $this->Href . $fragment . '"';
      
    if ($this->Target)
      $str .= ' target="' . $this->Target . '"';
    if ($this->Class) {
      $str .= ' class="' . $this->Class . '"';
    }
    if ($this->JavaScript) {
      $str .= ' ' . $this->JavaScript . ' ';
    }
    if ($this->Id) {
      $str .= ' id="' . $this->Id . '"';
    }
    if ($this->DisplayValue == true)
      $str .= '>' .$extstring. $this->ValueToDisplay . '</a>';
    else
      $str .= '>' .$extstring. $this->Label . '</a>';

    return $str;
  }

}

