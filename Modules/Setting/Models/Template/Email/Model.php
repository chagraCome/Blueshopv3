<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Setting_Template_Email_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $name;
  public $subject;
  public $content;
  public $variablelist;

  /**
   * Construct model.
   *
   * @param integer $id primary key of db table
   */
  public function __construct($id = null) {
    if ($id) {
      $this->id = $id;
    }
  }

  /**
   * Gets EmailTemplate id.
   * @return Integer $id 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Sets EmailTemplate id.
   * @param Integer $id
   * @return EmailTemplateModel 
   */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets EmailTemplate name.
   * @return String $name
   */
  public function getName() {
    return $this->name;
  }

  /**
   * Sets EmailTemplate name.
   * @param String $name
   * @return EmailTemplateModel 
   */
  public function setName($name) {
    $this->name = $name;
    return $this;
  }

  /**
   * Gets EmailTemplate subject.
   * @return String $subject
   */
  public function getSubject() {
    return $this->subject;
  }

  /**
   * Sets EmailTemplate subject.
   * @param String $subject
   * @return EmailTemplateModel 
   */
  public function setSubject($subject) {
    $this->subject = $subject;
    return $this;
  }

  /**
   * Gets EmailTemplate content.
   * @return String $content
   */
  public function getContent() {
    return $this->content;
  }

  /**
   * Sets EmailTemplate content.
   * @param String $content
   * @return EmailTemplateModel 
   */
  public function setContent($content) {
    $this->content = $content;
    return $this;
  }

  /**
   * Get filled content
   * @param array $objects
   * @return string 
   */
  public function getFilledContent($objects, $parserow = false) {
    foreach ($objects as $object) {
      if (is_array($object)) {
	foreach ($object as $name => $value) {
	  $this->content = str_replace($name, $value, $this->content);
	}
	continue;
      }
      if (is_object($object)) {
	$className = get_class($object);
	$attrs = array_keys(get_class_vars($className));
        usort($attrs,'_content_sort_by_length');
	//arsort($attrs);
	foreach ($attrs as $key) {
	  if (is_object($object->$key)) {
	    $this->getFilledContent(array($object->$key));
	    continue;
	  } elseif (is_array($object->$key)) {
	    $count = count($object->$key);
	    if ($count > 0) {
	      preg_match_all("/<table.*?>.*?<\/[\s]*table>/s", $this->content, $table_html);
	      foreach ($table_html[0] as $table) {
		preg_match_all("/<tr.*?>(.*?)<\/[\s]*tr>/s", $table, $matches);
		$result = null;
		$o = $object->$key;
		foreach ($matches[0] as $row) {
		  $className1 = get_class($o[0]);
		  if (strpos($row, $className1 . '::')) {
		    foreach ($object->$key as $item) {
		      $attrsx = get_class_vars(get_class($item));
		      $searchx = array();
		      $replacex = array();
		      foreach ($attrsx as $keyx => $valuex) {
			$searchx[] = get_class($item) . '::' . $keyx;
			$replacex[] = $this->refineValue($keyx, $item->$keyx);
		      }
		      $combined1 = array_combine($searchx, $replacex);
		      $result .= strtr($row, $combined1);
		    }
		    if ($result) {
		      $this->content = str_replace($row, $result, $this->content);
		    }
		  }
		}
	      }
	    }
	    continue;
	  } else {
	    
	  }
	  $this->_search[] = $className . '::' . $key;
	  $this->_replace[] = $this->refineValue($key, (string) $object->$key);
	}
      }
    }
    $combined = array_combine($this->_search, $this->_replace);
    $this->content = strtr($this->content, $combined);
    return $this->content;
  }

  /**
   * 
   * @param type $key
   * @param type $value
   * @return type
   */
  public function refineValue($key, $value) {
    if (preg_match("/(discount|total|price)/i", $key)) {
      $currencyLabelControl = new Amhsoft_Currency_Label_Control('label');
      $currencyLabelControl->Value = $value;
      return $currencyLabelControl->getFormattedValue();
    }
    if (preg_match("/(insertat|updateat|time)/i", $key)) {
      return Amhsoft_Locale::DateTime($value);
    }
    return $value;
  }

  /**
   * Send Email
   * @param Amhsoft_Mail_Client $client
   * @param array $objects
   * @return type
   */
  public function SendAsEmail(Amhsoft_Mail_Client $client, array $objects) {
    $client->SetSubject($this->getSubject());
    $client->SetHtmlBody($this->getFilledContent($objects));
    return $client->Send();
  }

}

function _content_sort_by_length($a,$b){
    return strlen($b)-strlen($a);
}



?>
