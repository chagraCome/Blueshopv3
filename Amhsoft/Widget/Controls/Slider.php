<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Slider.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Slider_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

  protected $orientation;
  protected $snapIncrements;
  protected $fixedMinimum;
  protected $fixedMaximum;
  public $minValue;
  public $maxValue;

  public function __construct($name, $label = null, $value = null, $size = null, Amhsoft_Data_Binding $dataBinding = null) {
    parent::__construct($name, $value);
    $this->Label = $label;
    $this->Id = $this->Name;
    $this->DataBinding = $dataBinding;
  }

  public function Draw() {
    $str = '';
    $script = '
      <link rel="stylesheet" href="http://code.jquery.com/ui/1.10.1/themes/base/jquery-ui.css" />
      <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
      <script src="http://code.jquery.com/ui/1.10.1/jquery-ui.js"></script>';

    $css = 'body {
	font-family: "Trebuchet MS", "Helvetica", "Arial",  "Verdana", "sans-serif";
	font-size: 62.5%;
}';


    $jquery = '<script>
  $(function() {
    $( "#' . $this->Name . '" ).slider({
      range: true,
      min: '.$this->minValue.',
      max: '.$this->maxValue.',
      values: [ ' . $this->minValue . ', ' . $this->maxValue . ' ],
      slide: function( event, ui ) {
        $( "#' . $this->Name . '_val" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
      }
    });
    $( "#' . $this->Name . '_val" ).val( "$" + $( "#' . $this->Name . '" ).slider( "values", 0 ) +
      " - $" + $( "#' . $this->Name . '" ).slider( "values", 1 ) );
  });
  </script>
';
    $str .= $script;
    $str .= $jquery;
    $str .= '<p>
  <label for="' . $this->Name . '_val">' . $this->Label . '</label>
  <input type="text" id="' . $this->Name . '_val" style="border: 0; color: #f6931f; font-weight: bold;" />
</p>
 
<div id="' . $this->Name . '"></div>';

    return $str;
  }

}

?>
