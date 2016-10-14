<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Setting_Form extends Amhsoft_Widget_Form {

    public $blocks;
    public $caracterPerBlock;
    public $blockSeparator;
    public $caracterOffset;
    public $printImage;
    public $submitButton;
    public $settings;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {

        $this->settings = new Amhsoft_Config_Table_Adapter(Coupon_Code_Model::SETTINGS);
        $this->blocks = new Amhsoft_Input_Control(Coupon_Code_Model::BLOCK_NUMBER, _t('Number of code blocks'));
        $this->blocks->DataBinding = new Amhsoft_Data_Binding(Coupon_Code_Model::BLOCK_NUMBER, null, null, $this->settings->getValue(Coupon_Code_Model::BLOCK_NUMBER));
        $this->blocks->Required = true;
        $this->blocks->DefaultValue = 4;
        $this->caracterPerBlock = new Amhsoft_Input_Control(Coupon_Code_Model::CARACTER_PER_BLOCK, _t('Number of Caracter per block'));
        $this->caracterPerBlock->DataBinding = new Amhsoft_Data_Binding(Coupon_Code_Model::CARACTER_PER_BLOCK, null, null, $this->settings->getValue(Coupon_Code_Model::CARACTER_PER_BLOCK));
        $this->caracterPerBlock->Required = true;
        $this->caracterPerBlock->DefaultValue = 4;
        $this->blockSeparator = new Amhsoft_Input_Control(Coupon_Code_Model::BLOCK_SEPARATOR, _t('Block Separator'));
        $this->blockSeparator->DataBinding = new Amhsoft_Data_Binding(Coupon_Code_Model::BLOCK_SEPARATOR, null, null, $this->settings->getValue(Coupon_Code_Model::BLOCK_SEPARATOR));
        $this->blockSeparator->ToolTip = _t('You can add block Separator like : - , * , + , / , .');
        $this->blockSeparator->Required = true;
        $this->blockSeparator->DefaultValue = '-';
        $this->caracterOffset = new Amhsoft_TextArea_Control(Coupon_Code_Model::CHARACHTER_OFFSET, _t('Generate Code Using this Caracters'));
        $this->caracterOffset->DataBinding = new Amhsoft_Data_Binding(Coupon_Code_Model::CHARACHTER_OFFSET, null, null, $this->settings->getValue(Coupon_Code_Model::CHARACHTER_OFFSET));
        $this->caracterOffset->Required = true;
        $this->caracterOffset->DefaultValue = 'QWERTZUIOPASDFGHJKLYXCVBNMN1234567890';
        $this->printImage = new Amhsoft_ImageControl_Control(Coupon_Code_Model::COUPON_TEMPLATE);
        $fileUpload = new Amhsoft_FileInput_Control('coupon_template_upload', _t('Coupon Template'));
        $this->printImage->setUploadControl($fileUpload);
        $this->printImage->setWidth(200);
        $this->printImage->DataBinding = new Amhsoft_Data_Binding(Coupon_Code_Model::COUPON_TEMPLATE, null, null, $this->settings->getValue(Coupon_Code_Model::COUPON_TEMPLATE));
        $this->sumitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->addComponent($this->blocks);
        $this->addComponent($this->caracterPerBlock);
        $this->addComponent($this->blockSeparator);
        $this->addComponent($this->caracterOffset);
        $this->addComponent($this->printImage);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->sumitButton);
        $this->addComponent($navigationPanel);
    }

    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>