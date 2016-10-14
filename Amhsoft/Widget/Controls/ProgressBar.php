<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ProgressBar.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * label component
 * @author Amir Cherif
 */
class Amhsoft_ProgressBar_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    public $overrideRender;
    public $Maximum = 100;
    public $Width = 250; 
    
    public $ValueText = "";

    /**
     * Construct component label and bind data to label
     * @param string $label label text for component
     * @param Databinding $dataBinding dataBinding for this label
     */
    public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
        parent::__construct('label');
        $this->Label = $label;
        $this->DataBinding = $dataBinding;
    }

    public function getTextValue(){
        return $this->ValueText = ceil(intval($this->Value)/$this->Maximum*100).'%';
    }
    
    /**
     * Get output HTML / string represantation of Control.
     * @return string output HTML / string represantation of Control.
     */
    public function Draw() {
        $this->ValueText = ceil(intval($this->Value)/$this->Maximum*100).'%';
        $str = '<div class="progressbar" style="position: relative; margin: 0; width: '.$this->Width.'px; border: 1px solid #CCC; background: #FE642E;">' . PHP_EOL;
        $str .= '<strong style="position: relative;z-index: 10;display: block;line-height: 18px;text-align: center;">'.$this->ValueText .'</strong>' . PHP_EOL;
        $str .= '<span  style="position: absolute; left:0; top:0; line-height: 18px;background-color: #04B431; width: '.$this->ValueText .';">&nbsp;</span>' . PHP_EOL;
        $str .= '</div>';
        return $str;
    }

}
