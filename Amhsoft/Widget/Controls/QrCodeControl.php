<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: QrCodeControl.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Amhsoft_QrCodeControl_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    protected $sessionAdapter;
    protected $qrCode;

    public function __construct($name, $value) {
        $this->Name = $name;
        $this->Label = $value;
        $this->Value = $value;
        $this->qrCode = new Amhsoft_Code_Qr();
        
    }

    public function createImage() {
        ob_start();
        $this->qrCode->png($this->Value);
        $image_data = ob_get_contents();
        ob_end_clean();
        $image_data_base64 = base64_encode($image_data);
        return $image_data_base64;
    }

    public function Validate() {
        return true;
    }

    public function Draw() {
        return '<img src="data:image/png;base64,' . $this->createImage() . '" />';
    }

}

?>
