<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Template_Print_Model implements Amhsoft_Data_Db_Model_Interface {

    public $id;
    public $name;
    public $content;
    public $variablelist;
    public $header;
    public $footer;

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
     * Gets PrintTemplate id.
     * @return Integer $id 
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Sets PrintTemplate id.
     * @param Integer $id
     * @return PrintTemplateModel 
     */
    public function setId($id) {
        $this->id = $id;
        return $this;
    }

    /**
     * Gets PrintTemplate name.
     * @return String $name
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Sets PrintTemplate name.
     * @param String $name
     * @return PrintTemplateModel 
     */
    public function setName($name) {
        $this->name = $name;
        return $this;
    }

    /**
     * Gets PrintTemplate content.
     * @return String $content
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Sets PrintTemplate content.
     * @param String $content
     * @return PrintTemplateModel 
     */
    public function setContent($content) {
        $this->content = $content;
        return $this;
    }

    private $_search = array();
    private $_replace = array();

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
                usort($attrs, '_content_sort_by_length_print');
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
        if (preg_match("/(total|price|discount)/i", $key)) {
            $currencyLabelControl = new Amhsoft_Currency_Label_Control('label');
            $currencyLabelControl->Value = $value;
            return $currencyLabelControl->getFormattedValue();
        }

        if (preg_match("/(policy|description)/i", $key)) {
            return nl2br($value);
        }
        return $value;
    }

    /**
     * 
     * @param array $objects
     * @return type
     */
    public function getOldFilledContent(array $objects) {
        $content = $this->getContent();
        foreach ($objects as $object) {
            if (is_array($object)) { //variable and not object (model
                foreach ($object as $name => $value) {
                    $content = str_replace($name, $value, $content);
                }
                continue;
            }
            $className = get_class($object);
            $attrs = get_class_vars($className);
            foreach ($attrs as $key => $value) {
                $search = '__' . $className . '::' . $key . '__';
                $replace = (string) $object->$key;
                $content = str_replace($search, $replace, $content);
            }
        }
        return $content;
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

    /**
     * Get Header
     * @return type
     */
    public function getHeader() {
        return $this->header;
    }

    /**
     * Set Header
     * @param type $header
     */
    public function setHeader($header) {
        $this->header = $header;
    }

    /**
     * Get Footer
     * @return type
     */
    public function getFooter() {
        return $this->footer;
    }

    /**
     * Set Footer
     * @param type $footer
     */
    public function setFooter($footer) {
        $this->footer = $footer;
    }

}

function _content_sort_by_length_print($a, $b) {
    return strlen($b) - strlen($a);
}

?>
