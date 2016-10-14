<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Xml.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Xml  {
	var $parser;

	function Amhsoft_Xml()
	{
		$this->parser = xml_parser_create();

		xml_set_object($this->parser, $this);
		xml_set_element_handler($this->parser, "tag_open", "tag_close");
		xml_set_character_data_handler($this->parser, "cdata");
	}

	function parse($data)
	{
            xml_parse($this->parser, $data);
	}

	function tag_open($parser, $tag, $attributes)
	{
		var_dump($parser, $tag, $attributes);
	}

	function cdata($parser, $cdata)
	{
		var_dump($parser, $cdata);
	}

	function tag_close($parser, $tag)
	{
		var_dump($tag);
		exit;
	}

} 