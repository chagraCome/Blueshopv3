<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Val.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Soap_Val extends nusoap_base {
  /**
   * The XML element name
   *
   * @var string
   * @access private
   */
  var $name;
  /**
   * The XML type name (string or false)
   *
   * @var mixed
   * @access private
   */
  var $type;
  /**
   * The PHP value
   *
   * @var mixed
   * @access private
   */
  var $value;
  /**
   * The XML element namespace (string or false)
   *
   * @var mixed
   * @access private
   */
  var $element_ns;
  /**
   * The XML type namespace (string or false)
   *
   * @var mixed
   * @access private
   */
  var $type_ns;
  /**
   * The XML element attributes (array or false)
   *
   * @var mixed
   * @access private
   */
  var $attributes;

  /**
   * constructor
   *
   * @param    string $name optional name
   * @param    mixed $type optional type name
   * @param	mixed $value optional value
   * @param	mixed $element_ns optional namespace of value
   * @param	mixed $type_ns optional namespace of type
   * @param	mixed $attributes associative array of attributes to add to element serialization
   * @access   public
   */
  function Amhsoft_Soap_Val($name='Amhsoft_Soap_Val',$type=false,$value=-1,$element_ns=false,$type_ns=false,$attributes=false) {
    parent::nusoap_base();
    $this->name = $name;
    $this->type = $type;
    $this->value = $value;
    $this->element_ns = $element_ns;
    $this->type_ns = $type_ns;
    $this->attributes = $attributes;
  }

  /**
   * return serialized value
   *
   * @param	string $use The WSDL use value (encoded|literal)
   * @return	string XML data
   * @access   public
   */
  function serialize($use='encoded') {
    return $this->serialize_val($this->value, $this->name, $this->type, $this->element_ns, $this->type_ns, $this->attributes, $use, true);
  }

  /**
   * decodes a Amhsoft_Soap_Val object into a PHP native type
   *
   * @return	mixed
   * @access   public
   */
  function decode(){
    return $this->value;
  }
}




?>