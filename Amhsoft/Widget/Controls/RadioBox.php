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
class Amhsoft_RadioBox_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    /** @var boolean True, if checkbox is checked, false otherwise */
    public $Checked = false;

    /**
     * Construct component radiobox
     * @param string $name id-name of component radiobox
     * @param string $value value text of component radiobox
     */
    public function __construct($name, $label = null, $value = null, $id = null) {
        parent::__construct($name, $value);
        $this->Id = ($id == null) ? $name : $id;
        $this->Label = $label;
        $this->Value = $value;
        
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Draw() {
        
        if ($this->Required) {
            $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
        }
        
        $html_class = ($this->Class != null) ? ' class="' . $this->Class . '"' : '';
        $html_checked = ($this->Checked) ? ' checked="checked"' : '';
        $html_disabled = ($this->Disabled) ? ' disabled="disabled"' : '';
        return '<input type="radio" name="' . $this->Name . '" id="' . $this->Id . '" value="' . $this->Value . '"' . $html_checked .$html_disabled . $html_class . ' /> '.$this->ToolTip;
    }

    /**
     * get True, if checkbox is checked, false otherwise
     * @return boolean True, if checkbox is checked, false otherwise
     */
    public function getChecked() {
        return $this->Checked;
    }

    /**
     * set True, if checkbox is checked, false otherwise
     * @param boolean $Checked True, if checkbox is checked, false otherwise
     */
    public function setChecked($Checked) {
        $this->Checked = $Checked;
    }

}
