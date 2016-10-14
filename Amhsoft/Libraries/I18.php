<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: I18.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_I18{

  var $customfunctions = array();


  function error($element, &$tpl)
  {

    $var2 = 	"$('$element').addClass('error');";
    $this->customfunctions[] = $var2;

    $tpl->assign("customfunction", $this->customfunctions);
  }


  function submitModal(&$tpl, $element, $title, $text)
  {
    $var = "$('$element').onsubmit = function()";
    $var .= "{";
    $var .= "return Modal(this, 'submit' ,'$title', '$text');";
    $var .= "}";
    $this->customfunctions[] = $var;
    $tpl->assign("customfunction", $this->customfunctions);
  }

  function clickModal(&$tpl, $element, $title, $text)
  {
    $var = "$('$element').onclick = function()";
    $var .= "{";
    $var .= "return Modal(this, 'click' ,'$title', '$text', '$goto');";
    $var .= "}";
    $this->customfunctions[] = $var;
    $tpl->assign("customfunction", $this->customfunctions);
  }

  function actionModal(&$tpl, $element, $title, $text, $goto)
  {
    $var = "$('$element').onclick = function()";
    $var .= "{";
    $var .= "return Modal(this, 'goto' ,'$title', '$text', '$goto');";
    $var .= "}";
    $this->customfunctions[] = $var;
    $tpl->assign("customfunction", $this->customfunctions);
  }



  function changeModal($element, $title, $text)
  {
    $var = "$('$element').onchange = function()";
    $var .= "{";
    $var .= "return Modal(this, 'change' ,'$title', '$text');";
    $var .= "}";
    $this->customfunctions[] = $var;
    $this->Application->template->assign("customfunction", $this->customfunctions);
  }

  function ajax(&$tpl, $ClickedElement, $url, $returnElement, $method="get")
  {

    $var = "$('$ClickedElement').addEvent('click', function(e) {
		e = new Event(e).stop();
		new Request({  
             method: '$method',  
             url: '$url',  
             onRequest: function() {  
             },  
             onComplete: function(response) {
             	$('$returnElement').innerHTML =  response;
             }  
         }).send(); 
         });"; 
    $this->customfunctions[] = $var;

    $tpl->assign("customfunction", $this->customfunctions);
  }

  function customFunction($func, &$tpl){
    $this->customfunctions[] = $func;
    $tpl->assign("customfunction", $this->customfunctions);
  }


}

?>