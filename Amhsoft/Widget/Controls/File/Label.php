<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Label.php 102 2016-01-25 21:55:57Z a.cherif $
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
class Amhsoft_File_Label_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

   

    /**
     * Construct component label and bind data to label
     * @param string $label label text for component
     * @param Amhsoft_DataBinding_Component $dataBinding dataBinding for this label
     */
    public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
        parent::__construct('label');
        $this->Label = $label;
        $this->Id = null;
        $this->DataBinding = $dataBinding;
        if ($this->DataBinding) {
            $this->Name = $this->DataBinding->Value;
        }
    }

    /**
     * Get output HTML / string represantation of Control.
     * @return string output HTML / string represantation of Control.
     */
    public function Draw() {
      
        $class = null;
        if ($this->Class) {
            $class = " class='$this->Class' ";
        }
        $id = null;
        if ($this->Id) {
            $id = " id='$this->Id' ";
        }
        
        $extstring = null;
        $ext = @end(@explode('.', $this->Value));
        if($ext){
          $icon_path = 'Amhsoft/Ressources/Icons/fileicons/'.  strtolower($ext).'.png';
          if(file_exists($icon_path)){
            $extstring = '<img src="'.$icon_path.'"></img>';
          }
        }
       
        return '<label ' . $class . $id . '>'.$extstring. nl2br(($this->Value)) . '</label>';
        
    }

}
