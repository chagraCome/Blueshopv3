<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Reader.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    16.06.2010 - 21:58:26
 */

/**
 * CSV file reader as reassource
 *
 * @author Amir Cherif
 * @author Thomas Häber
 */
class Amhsoft_Csv_Reader implements Iterator {

    /** @var array $row row of file */
    private $row;

    /** @var resource $pointer file resource */
    private $pointer = null;

    /** @var string $delimiter separator of values in file per line */
    private $delimiter = '|';

    /** @var integer $length length of line to read */
    private $length = 10000;

    /**
     * constructor
     *
     * binds the resource
     * @param string $file filename
     */
    public function __construct($file) {
        if (!is_file($file)) {
            throw new Amhsoft_Csv_Exception('Sorry file "' . $file . '" not exists');
        }
        if (($this->pointer = fopen($file, "r+")) !== false) {
            //$this->row = fgetcsv($this->pointer, $this->length, $this->delimiter);
        }
    }

    /**
     * destructor to close/free resource
     */
    public function __destruct() {
        fclose($this->pointer);
    }

    public function goToPosition($int) {
        $this->rewind();
        fseek($this->pointer, 0, SEEK_SET);
        $i = 0;
        while ($i < $int) {
            fgetcsv($this->pointer, $this->length, $this->delimiter);
            $i++;
        }
    }

    /**
     * reset pointer to begin of file resource
     */
    public function rewind() {
        fseek($this->pointer, 0, SEEK_SET);
        $this->positionOfPointer = 0;
        $this->row = fgetcsv($this->pointer, $this->length, $this->delimiter, '"');
    }

    /**
     * is current position of file not end of file
     * @return boolean is not end of file
     */
    public function valid() {
        return !feof($this->pointer);
    }

    /**
     * get file pointer
     * @return resource file pointer
     */
    public function key() {
        return $this->positionOfPointer;
    }

    /**
     * get current row
     * @return array string values in row
     */
    public function current() {
        $this->row = fgetcsv($this->pointer, $this->length, $this->delimiter);
        return $this->row;
    }

    /**
     * set pointer to next row/line in file resource
     */
    public function next() {
        $this->positionOfPointer++;
        
    }

    /**
     * set delimiter
     * @param string $delimiter
     */
    public function setDelimiter($delimiter) {
        $this->delimiter = $delimiter;
    }

    /**
     * get delimiter
     * @return string delimiter
     */
    public function getDelimiter() {
        return $this->delimiter;
    }

    /**
     * set length
     * @param string $length line length
     */
    public function setLength($length) {
        $this->length = $length;
    }

    /**
     * get length of line
     * @return string length ofl line
     */
    public function getLength() {
        return $this->length;
    }

}
