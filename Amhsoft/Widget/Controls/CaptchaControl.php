<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: CaptchaControl.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_CaptchaControl_Control
 *
 * @author cherif
 */
class Amhsoft_CaptchaControl_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    protected $sessionAdapter;
    
    protected $inputCode;

    public function __construct($name, $label) {
        $this->Name = $name;
        $this->Label = $label;
        $this->inputCode = new Amhsoft_Input_Control('captch_verification', _t('Code'));
        $this->inputCode->setWidth(100);
        
    }

    public function createImage() {
        $NewImage = imagecreatefromjpeg("Amhsoft/Ressources/Icons/img_captcha_bg.jpg"); //image create by existing image and as back ground
        $LineColor = imagecolorallocate($NewImage, 233, 239, 239); //line color
        $TextColor = imagecolorallocate($NewImage, 0, 0, 0); //text color-white
        imageline($NewImage, 1, 1, 40, 40, $LineColor); //create line 1 on image
        imageline($NewImage, 1, 100, 60, 0, $LineColor); //create line 2 on image
        imagestring($NewImage, 10, 20, 1, $this->Value, $TextColor); // Draw a random string horizontally
        
        ob_start();
        imagejpeg($NewImage); //Output image to browser
        $image_data = ob_get_contents();

        ob_end_clean();

        $image_data_base64 = base64_encode($image_data);

        return $image_data_base64;

    }

    public function Validate() {
       $validation_msg = _t('is required');
        $e = Amhsoft_Web_Request::post('captch_verification')== Amhsoft_Registry::get('code_cap');
        if(!$e){
            $this->inputCode->setClass('inp invalid error required');
			$this->inputCode->setErrorMessage($validation_msg);
            return false;
        }
        return true;
    }
    
    public function Draw() {
        $RandomStr = md5(microtime()); // md5 to generate the random string
        $ResultStr = substr($RandomStr, 0, 5); //trim 5 digit
        $this->Value = $ResultStr;
        Amhsoft_Registry::register('code_cap', $this->Value);
        $_SESSION['code_cap'] = $this->Value;
	    return '<table><tr><td>'.$this->inputCode->Render() . '&nbsp;</td><td><img src="data:image/jpeg;base64,' . $this->createImage() . '" /></td><td><span>'.$this->inputCode->getErrorMessage().'</span></td></tr></table>';

    }

}

?>
