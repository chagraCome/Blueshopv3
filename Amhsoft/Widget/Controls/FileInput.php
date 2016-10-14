<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: FileInput.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

/**
 * Amhsoft_FileInput_Control control
 */
class Amhsoft_FileInput_Control extends Amhsoft_Input_Control {

    /** @var Event event class */
    public $onUploadClick;
    public $buttonLabel;

    /**
     * Construct this component submit botton
     * @param string $name id-name of component submit button
     * @param string $value value text of submit button (default: 'Send')
     */
    public function __construct($name, $label = null, $buttonLabel = 'Upload', $validator = null) {
        parent::__construct($name, $label, null);
        $this->Type = 'file';
        $this->buttonLabel = $buttonLabel;
        $this->onUploadClick = new Amhsoft_Widget_Event();
        $this->Label = $label;
        $this->Value = isset($_FILES['trigger_' . $this->Name]) ? $_FILES['trigger_' . $this->Name] : NULL;
        if ($validator instanceof Amhsoft_File_Validator) {
            $this->addValidator($validator);
        }
    }

    public function hasError() {
        if (is_array($this->Value)) {
            return $this->Value['error'] == 4;
        }
    }

    public function getTempFileName() {
        if (is_array($this->Value)) {
            return $this->Value['tmp_name'];
        }
        return null;
    }

    public function Render() {

        if ($this->Required) {
            $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
        }

        $res = '<input type="file" class="inp" name="trigger_' . $this->Name . '"';

        if ($this->Size != null) {
            $res .= ' size="' . $this->Size . '"';
        }
        if ($this->Maxlength != null) {
            $res .= ' maxlength="' . $this->Maxlength . '"';
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
        $res .= ' />';
        if ($this->ToolTip) {
            $res .= '&nbsp;<span class="toottip_msg">' . $this->ToolTip . '</span>';
        }



        return $res;
    }

    public function Draw() {
        return $this->Render();
    }

    public function getExtention() {
        if ($this->Value['name']) {
            $_name = explode('.', $this->Value['name']);
            return end($_name);
        }
        return null;
    }

    public function getMimeType() {
        return $this->Value['type'] ? $this->Value['type'] : null;
    }

    public function getSize() {
        return $this->Value['size'] ? number_format($this->Value['size'] / 1024, 2) : null;
    }

    public function uploadTo($destination) {
        if (is_uploaded_file($this->Value['tmp_name'])) {
            move_uploaded_file($this->Value['tmp_name'], $destination);
        }
    }

}
