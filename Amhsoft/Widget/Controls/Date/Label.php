<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Label.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Date_Label_Control extends Amhsoft_Label_Control implements Amhsoft_Widget_Interface {

    protected $dateTimeFormat = 'Y-m-d';

    /**
     * Sets date time format
     * @param string $format
     */
    public function setDateTimeFormat($format) {
        $this->dateTimeFormat = $format;
    }

    public function __construct($label, Amhsoft_Data_Binding $dataBinding = null) {
        parent::__construct($label, $dataBinding);
        $this->DataBinding = $dataBinding;
    }

    /**
     * Get output HTML / string represantation of Control.
     * @return string Output HTML / string represantation of Control.
     */
    public function Draw() {

        return '<label>' . Amhsoft_Locale::DateTime($this->Value, $this->dateTimeFormat) . '</label>';
    }

}

?>
