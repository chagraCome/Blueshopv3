<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Input.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */
class Amhsoft_Unit_Color_Input_Control extends Amhsoft_Input_Control {

    private $availableColors = array();


    public function __construct($name, $label = null, $value = null, $size = null, DataBinding $dataBinding = null) {
        parent::__construct($name, $label, $value, $size, $dataBinding);
    }
    
    public function addAvailableColor($hex){
        $this->availableColors[$hex] = $hex;
    }

    public function Draw() {
        
        $current_lang = Amhsoft_System::getCurrentLang();
        $float = strtoupper($current_lang) == 'AR' ? 'right' : 'left';
        $this->Disabled = false;
        
        if ($this->Required) {
            $this->Class = ($this->Class != null) ? $this->Class . ' required' : 'required';
        }

        $res = '<input style="float:'.$float.';" name="' . $this->Name . '" id="' . $this->Id . '"';

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
        $res .= ' /><span  id="' . $this->Id . '_colorSelector" style="margin: 0 2px; height: 20px; width: 20px; border: 1px solid gray; background-color: #' . $this->Value . '">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>';
       $res .= '<div style="clear:both;" >';
        foreach($this->availableColors as $color){
            $res .= '<span class="others" style="float:'.$float.'; margin: 0 2px; height: 20px; width: 20px; border: 1px solid gray; background-color: #'.$color.'" >&nbsp;</span>';
        }
        $res .='</div>';
        if ($this->ToolTip) {
            $res .= '&nbsp;' . $this->ToolTip;
        }
        $res .= "<script>
    $(function(){
        $('#$this->Id').ColorPicker({
            onShow: function (colpkr) {
                $(colpkr).fadeIn(500);
                return false;
            },
            onHide: function (colpkr) {
                $(colpkr).fadeOut(500);
                return false;
            },
            onSubmit: function(hsb, hex, rgb, el) {
		$(el).val(hex);
		$(el).ColorPickerHide();
	},
            onChange: function (hsb, hex, rgb) {
                $('#$this->Id').val(hex);
                $('#".$this->Id."_colorSelector').css('backgroundColor', '#' + hex);
            }
        });
        $('.others').click(function(){
           
          var rgb = $(this).css('backgroundColor');
          
          rgb = rgb.match(/^rgb\((\d+),\s*(\d+),\s*(\d+)\)$/);
    function hex(x) {return (\"0\" + parseInt(x).toString(16)).slice(-2);}
    var hex =   hex(rgb[1]) + hex(rgb[2]) + hex(rgb[3]);
$('#$this->Id').val(hex);
    $('#".$this->Id."_colorSelector').css('backgroundColor', '#' + hex);
        });
    });
</script>";
        return $res . PHP_EOL;
    }

}

?>
