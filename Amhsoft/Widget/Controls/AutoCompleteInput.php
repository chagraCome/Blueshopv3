<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: AutoCompleteInput.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of DirectoryInput
 *
 * @author cherif
 */
class Amhsoft_AutoCompleteInput_Control extends Amhsoft_Input_Control implements Amhsoft_Widget_Interface {

    public $Icon = "images/folder_open.gif";
    public $Source;
    public $DataSource;

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
            $res .= ' value="' . $this->Value . '"';
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
        $hiddenName = "";
        if (is_object($this->Value)) {
            //if (isset($this->Value->{$this->DataBinding->Index}) && isset($this->DataBinding->Text)) {
                $hiddenValue = $this->Value->{$this->DataBinding->Index};
                $hiddenName =$this->DataBinding->Text;
                $hidden = '<input type="hidden" id="'.$hiddenName.'" name="'.$hiddenName.'" Value="'.$hiddenValue.'" />';
            //}
        }
        else{
                if(isset($this->DataBinding->Text)){
                    $hiddenValue = "";
                    $hiddenName =$this->DataBinding->Text;
                    $hidden = '<input type="hidden" id="h'.$hiddenName.'" name="'.$hiddenName.'" Value="'.$hiddenValue.'" />';
                }
            }
        $res .= ' />&nbsp;'.$hidden;
        $res .= '<script>$(function() {
            $( "#'.$this->Id.'" ).autocomplete({
                source: "'.$this->Source.'",
               minLength: 2,
               select: function( event, ui ) {
               
                  $("#h'.$hiddenName.'").val(ui.item.'.$this->DataBinding->Index.');
                  $("#'.$this->Name.'").val(ui.item.'.$this->DataBinding->Text.');
                },
               
            });
            
$.ui.autocomplete.prototype._renderItem = function( ul, item) {
 return $( "<li></li>" )
                                            .data( "item.autocomplete", item )
                                            .append( "<a>" + item.'.$this->DataBinding->Text.' + "</a>" )
                                            .appendTo( ul );
};
            
            });</script>';
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
