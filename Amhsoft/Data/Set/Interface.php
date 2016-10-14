<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Interface.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
interface Amhsoft_Data_Set_Interface{
       public function GetInt($field);

    /**
     * get string value presentation of current element in list
     * @param mixed $field key/field of element
     * @return string string value presentation of current element in list
     */
    public function GetString($field);

    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     */
    public function GetFloat($field);
    /**
     * get float value presentation of current element in list
     * @param mixed $field key/field of element
     * @return float float value presentation of current element in list
     * @see GetFloat()
     */
    public function GetDouble($field);

    /**
     * get boolean value presentation of current element in list
     * @param mixed $field key/field of element
     * @return boolean boolean value presentation of current element in list
     */
    public function GetBoolean($field);
}
?>
