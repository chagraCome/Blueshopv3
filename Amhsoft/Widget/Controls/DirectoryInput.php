<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DirectoryInput.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_DirectoryInput_Control
 *
 * @author cherif
 */
class Amhsoft_DirectoryInput_Control extends Amhsoft_Input_Control implements Amhsoft_Widget_Interface {

    public $OpenIcon = "Amhsoft/Ressources/Icons/folder_open.gif";
    public $AddIcon = "Amhsoft/Ressources/Icons/add.gif";
    public $PopUpUrl;
    public $AddPopUpUrl;
    public $PopUpWidth = 640;
    public $PopUpHeight = 480;
    public $DataSource;
    public $OnlyIcon = false;
    public $HiddenValue;

    public function Render() {
        // $this->Disabled = true;

        if ($this->Required) {
            $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
        }

        $res = '<input name="' . $this->Name . '" id="' . $this->Id . '"';

        if ($this->Type != null) {
            $res .= ' type="' . $this->Type . '"';
        }
        if ($this->Size != null) {
            $res .= ' size="' . $this->Size . '"';
        }
        if ($this->Maxlength != null) {
            $res .= ' maxlength="' . $this->Maxlength . '"';
        }
        if ($this->Value != null) {
            $res .= ' value="' . (string)$this->Value . '"';
        }
        if ($this->Class != null) {
            $res .= ' class="' . $this->Class . '"';
        }
        if ($this->LTR == true) {
            $res .= ' dir="ltr"';
        }
        if ($this->Disabled == true) {
            $res .= ' disabled="disabled" ';
        }
        if (!empty($this->JavaScript)) {
            $res .= ' onclick="' . $this->JavaScript . '"';
        }
        if (!empty($this->DockStyle)) {
            $res .= ' style="' . $this->DockStyle . '"';
        }

        $hidden = null;
        if (is_object($this->Value)) {
            //if (isset($this->Value->{$this->DataBinding->Index}) && isset($this->DataBinding->Text)) {
            $hiddenValue = $this->Value->{$this->DataBinding->Index};
            $hiddenName = $this->DataBinding->Text;
            $hidden = '<input type="hidden" name="' . $hiddenName . '" value="' . $hiddenValue . '" />';
            //}
        } else {
            if (isset($this->DataBinding->Text)) {
                $hiddenValue = $this->HiddenValue;
                $hiddenName = $this->DataBinding->Text;
                $hidden = '<input type="hidden" name="' . $hiddenName . '" value="' . $hiddenValue . '" />';
            }
        }
        $url = $this->PopUpUrl ? 'onClick="return popup(\'' . $this->PopUpUrl . '\', ' . $this->PopUpWidth . ', ' . $this->PopUpHeight . ')"' : null;
        $add_url = $this->AddPopUpUrl ? 'onClick="return popup(\'' . $this->AddPopUpUrl . '\', ' . $this->PopUpWidth . ', ' . $this->PopUpHeight . ')"' : null;
        if ($this->OnlyIcon == true) {
            $res = '<img style="cursor:pointer;" src="' . $this->OpenIcon . '" border="0" ' . $url . ' />' . $hidden;
        } else {
            $res .= ' />&nbsp;<img style="cursor:pointer;" src="' . $this->OpenIcon . '" border="0" ' . $url . ' />';
            if($add_url){
              $res .= '&nbsp;<img style="cursor:pointer;" src="' . $this->AddIcon . '" border="0" ' . $add_url . ' />';
            }
            $res .= $hidden;
        }
        if ($this->ToolTip) {
            $res .= '&nbsp;' . $this->ToolTip;
        }
        return $res;
    }

    public function getValue() {
        return $this->Value->{$this->DataBinding->Index};
    }

}

?>
