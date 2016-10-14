<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Hidden.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Hidden_Control extends Amhsoft_Input_Control {

    public function __construct($name, Amhsoft_Data_Binding $dataBinding = null, $value = null) {
        parent::__construct($name, null, $value, null, $dataBinding);
        $this->Class = null;
        $this->Type = 'hidden';
    }

}
?>
