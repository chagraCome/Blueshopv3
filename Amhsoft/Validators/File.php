<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: File.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of StringValidator
 *
 * @author cherif
 */
class Amhsoft_File_Validator extends Amhsoft_Abstract_Validator {

    protected $_value;
    protected $_maxsize;
    protected $_allowedMimeTypes;
    protected $message = '';

    public function __construct($maxsize = 0, $allowedmimetype = '*') {
        $this->_maxsize = intval($maxsize);
        $this->_allowedMimeTypes = $allowedmimetype;
    }

    public function setValue($value) {
        $this->_value = $value;
    }

    public function getErrorMessage() {
        return $this->message;
    }

    public function isValid() {

        if ($this->_value['error']) {
            $this->message = _t($this->_value['error']);
            return false;
        }

        $fileName = ltrim($this->_value['name']);
        if (!is_string($fileName)) {
            $this->message = _t('is invalid');
            return false;
        }
        if (strlen($fileName) == 0) {
            $this->message = _t('is empty');
            return false;
        }
        $fileSize = $this->_value['size'] / 1024;
        if ($this->_maxsize > 0 && $this->_maxsize < $fileSize) {
            $this->message = _t('must maximum %s Kilobyte, file size is %s', array($this->_maxsize, $fileSize));
            return false;
        }

        $mime = self::detect_mime($this->_value['tmp_name'], $this->_value['name']);
        if ($this->_allowedMimeTypes && $this->_allowedMimeTypes != '*') {
            $mimetypes = explode(';', $this->_allowedMimeTypes);
            if (!in_array($mime, $mimetypes)) {
                $this->message = _t('is not allowed while mime type is %s, allowed types %s', array($mime, $this->_allowedMimeTypes));
                return false;
            }
        }

        return true;
    }

    public static function detect_mime($filename, $name) {
        preg_match("/\.(.*?)$/", $name, $m);    # Get File extension for a better match 
        switch (strtolower($m[1])) {
            case "js": return "application/javascript";
            case "json": return "application/json";
            case "jpg": case "jpeg": case "jpe": return "image/jpg";
            case "png": case "gif": case "bmp": return "image/" . strtolower($m[1]);
            case "css": return "text/css";
            case "pdf" : return "application/pdf";
            case "zip" : return "application/x-compressed";
            case "doc" : return "application/msword";    
            case "xml": return "application/xml";
            case "html": case "htm": case "php": return "text/html";
            default:
                if (function_exists("mime_content_type")) { # if mime_content_type exists use it. 
                    $m = mime_content_type($filename);
                } else if (function_exists("")) {    # if Pecl installed use it 
                    $finfo = finfo_open(FILEINFO_MIME);
                    $m = finfo_file($finfo, $filename);
                    finfo_close($finfo);
                } else {    # if nothing left try shell 
                    if (strstr($_SERVER['HTTP_USER_AGENT'], "Windows")) { # Nothing to do on windows 
                        return ""; # Blank mime display most files correctly especially images. 
                    }
                    if (strstr($_SERVER['HTTP_USER_AGENT'], "Macintosh")) { # Correct output on macs 
                        $m = trim(exec('file -b --mime ' . escapeshellarg($filename)));
                    } else {    # Regular unix systems 
                        $m = trim(exec('file -bi ' . escapeshellarg($filename)));
                    }
                }
                $m = explode(";", $m);
                return trim($m[0]);
        }
    }

}

?>
