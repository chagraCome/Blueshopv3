<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Image.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_YesNo_Image_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    public function __construct($label, $dataBinding) {
        parent::__construct('status', null);
        $this->Label = $label;
        $this->DataBinding = $dataBinding;
        
    }

    public function Draw() {
        if ($this->Value == 1) {
            return '<img src="Amhsoft/Ressources/Icons/checked.gif" />';
        } else {
            return '<img src="Amhsoft/Ressources/Icons/cross.gif" />';
        }
        
    }
   
}
?>
