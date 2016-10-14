<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: RadioBox.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * radiobox component
 * @author Amir Cherif
 */
class Amhsoft_Bootstrap_RadioBox_Control extends Amhsoft_RadioBox_Control {

 
     public $Class = 'radio';
   
    public function Draw() {
        
        if ($this->Required) {
            $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
        }
        
        $html_class = ($this->Class != null) ? ' class="' . $this->Class . '"' : '';
        $html_checked = ($this->Checked) ? ' checked="checked"' : '';
        $html_disabled = ($this->Disabled) ? ' disabled="disabled"' : '';
        return '<input type="radio" name="' . $this->Name . '" id="' . $this->Id . '" value="' . $this->Value . '"' . $html_checked .$html_disabled . $html_class . ' /> '.$this->ToolTip;
    }

    

}
