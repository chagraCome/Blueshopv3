<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Coupon_Import_Form extends Amhsoft_Widget_Form {

    /** @var Amhsoft_FileInput_Control $fileInput * */
    public $fileInput;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        parent::setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $label = new Amhsoft_Html_Control("<p>" . _t('Notice :Csv Must be Like :  ') . _t('Code') . " | " . _t('Expiration Date') . " </p>");
        $this->fileInput = new Amhsoft_FileInput_Control('coupon_file', _t('File to upload'), _t('Upload Csv'));
        $this->fileInput->Required = true;
        $docValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::COMMA_SEPARATED . ';' . Amhsoft_Mimetype::APPLICATION_CSV . ';' . Amhsoft_Mimetype::TEXT_CSV);
        $this->fileInput->addValidator($docValidator);
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Upload'));
        $submitButton->setClass('Save Button');
        $this->addComponent($label);
        $this->addComponent($this->fileInput);
        $this->addComponent($submitButton);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}
