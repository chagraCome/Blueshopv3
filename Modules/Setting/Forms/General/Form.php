<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Setting_General_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /**
     * Form COnstruct
     * @param type $name
     * @param type $model
     * @param type $method
     */
    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    /**
     * Initialize Form Components
     */
    public function initializeComponents() {
        $this->shopInput = new Amhsoft_Input_Control('shop_name', _t('Website name'));
        $this->shopInput->DataBinding = new Amhsoft_Data_Binding('shop_name');
        $this->shopInput->setWidth(400);
        $this->shopInput->ToolTip = _t('(Very important for search engine)');

        $this->descriptionTextArea = new Amhsoft_TextArea_Control('shop_description', _t('Website description'));
        $this->descriptionTextArea->DataBinding = new Amhsoft_Data_Binding('shop_description');

        $this->shopkeywordsInput = new Amhsoft_Input_Control('shop_keywords', _t('Website keywords'));
        $this->shopkeywordsInput->DataBinding = new Amhsoft_Data_Binding('shop_keywords');
        $this->shopkeywordsInput->setWidth(400);

        $this->googleanalyticInput = new Amhsoft_Input_Control('google_analytic_code', _t('Google Analytics Code'));
        $this->googleanalyticInput->DataBinding = new Amhsoft_Data_Binding('google_analytic_code');
        $this->googleanalyticInput->ToolTip = _t('Example: UA-XXXXX-X');

        $this->shopownerInput = new Amhsoft_Input_Control('shop_owner', _t('Website owner'));
        $this->shopownerInput->DataBinding = new Amhsoft_Data_Binding('shop_owner');

        $this->addressTextArea = new Amhsoft_TextArea_Control('shop_address', _t('Address'));
        $this->addressTextArea->DataBinding = new Amhsoft_Data_Binding('shop_address');

        $this->shoptelInput = new Amhsoft_Input_Control('shop_tel', _t('Telephone'));
        $this->shoptelInput->DataBinding = new Amhsoft_Data_Binding('shop_tel');
        $this->shoptelInput->setWidth(300);

        $this->shopfaxInput = new Amhsoft_Input_Control('shop_fax', _t('Fax'));
        $this->shopfaxInput->DataBinding = new Amhsoft_Data_Binding('shop_fax');
        $this->shopfaxInput->setWidth(300);

        $this->shopmobileInput = new Amhsoft_Input_Control('shop_mobile', _t('Mobile'));
        $this->shopmobileInput->DataBinding = new Amhsoft_Data_Binding('shop_mobile');
        $this->shopmobileInput->setWidth(300);

        $this->urlCheckBox = new Amhsoft_CheckBox_Control('shop_url_friendly', _t('URL friendly'), 1);
        $this->rssCheckBox = new Amhsoft_CheckBox_Control('shop_rss', _t('RSS'), 1);
        $this->shopofflineCheckBox = new Amhsoft_CheckBox_Control('shop_offline', _t('Shop Offline'), 1);
        $this->shopofflineCheckBox->ToolTip = _t('<a href="admin.php?module=cms&page=page-modify&id=15">'.'&nbsp;&nbsp;Modify Offline Page'.' </a>');

        $this->offlineipInput = new Amhsoft_Input_Control('offline_ip', _t('Open Shop Only for ip'));
        $this->offlineipInput->DataBinding = new Amhsoft_Data_Binding('offline_ip');

        $this->disableimageYesNo = new Amhsoft_YesNo_ListBox_Control('disable_image', _t('Disable Mouse Right click to protect product images'), 'disable_image');

        $this->facebookAccountInput = new Amhsoft_Input_Control('facebookAccount', _t('Facebook'));
        $this->facebookAccountInput->DataBinding = new Amhsoft_Data_Binding('facebookAccount');
        $this->facebookAccountInput->setWidth(300);

        $this->twitterAccountInput = new Amhsoft_Input_Control('twitterAccount', _t('Twitter'));
        $this->twitterAccountInput->DataBinding = new Amhsoft_Data_Binding('twitterAccount');
        $this->twitterAccountInput->setWidth(300);

        $this->googleplusAccountInput = new Amhsoft_Input_Control('googleplusAccount', _t('Google+'));
        $this->googleplusAccountInput->DataBinding = new Amhsoft_Data_Binding('googleplusAccount');
        $this->googleplusAccountInput->setWidth(300);

        $this->instagramAccountInput = new Amhsoft_Input_Control('instagramAccount', _t('Instagram'));
        $this->instagramAccountInput->DataBinding = new Amhsoft_Data_Binding('instagramAccount');
        $this->instagramAccountInput->setWidth(300);

        $this->youtubeAccountInput = new Amhsoft_Input_Control('youtubeAccount', _t('Youtube'));
        $this->youtubeAccountInput->DataBinding = new Amhsoft_Data_Binding('youtubeAccount');
        $this->youtubeAccountInput->setWidth(300);
        
        $this->errorYesNo = new Amhsoft_YesNo_ListBox_Control('show_errors', _t('Show errors'), 'show_errors');
        
        $this->errortypeListBox = new Amhsoft_ListBox_Control('error_type', _t('Error Type'));
        $errortype = array(
            array('id' => 32767, 'name' => _t('E_ALL')),
            array('id' => 32765, 'name' => _t('E_ALL ^ E_WARNING')),
            array('id' => 32757, 'name' => _t('E_ALL ^ E_WARNING ^ E_NOTICE')),
            array('id' => 30709, 'name' => _t('E_ALL ^ E_WARNING ^ E_NOTICE ^ E_STRICT')),
            array('id' => 22517, 'name' => _t('E_ALL ^ E_WARNING ^ E_NOTICE ^ E_STRICT ^ E_DEPRECATED')),
        );
        $this->errortypeListBox->DataSource = new Amhsoft_Data_Set($errortype);
        $this->errortypeListBox->DataBinding = new Amhsoft_Data_Binding('error_type', 'id', 'name');
        $this->errortypeListBox->setWidth(300);

        $this->picture = new Amhsoft_ImageControl_Control('pic');
        $this->picture->DataBinding = new Amhsoft_Data_Binding('pic');
        $fileUpload = new Amhsoft_FileInput_Control('picture', _t('Picture'));
        $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG);
        $fileUpload->addValidator($ImageValidator);
        $this->picture->uploadControl = $fileUpload;
        $this->picture->setWidth(200);


        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';

        $informationPanel = new Amhsoft_Widget_Panel(_t('General information'));
        $informationPanel->addComponent($this->shopInput);
        $informationPanel->addComponent($this->descriptionTextArea);
        $informationPanel->addComponent($this->shopkeywordsInput);
        $informationPanel->addComponent($this->googleanalyticInput);
        $informationPanel->addComponent($this->shopownerInput);
        $informationPanel->addComponent($this->addressTextArea);
        $informationPanel->addComponent($this->shoptelInput);
        $informationPanel->addComponent($this->shopfaxInput);
        $informationPanel->addComponent($this->shopmobileInput);
        $this->addComponent($informationPanel);

        $otherinformationPanel = new Amhsoft_Widget_Panel(_t('Other settings'));
        $otherinformationPanel->addComponent($this->urlCheckBox);
        $otherinformationPanel->addComponent($this->rssCheckBox);
        $otherinformationPanel->addComponent($this->shopofflineCheckBox);
        $otherinformationPanel->addComponent($this->offlineipInput);
        $otherinformationPanel->addComponent($this->disableimageYesNo);
        $this->addComponent($otherinformationPanel);

        $socialInfo = new Amhsoft_Widget_Panel(_t('Social Networks'));
        $socialInfo->addComponent($this->facebookAccountInput);
        $socialInfo->addComponent($this->twitterAccountInput);
        $socialInfo->addComponent($this->googleplusAccountInput);
        $socialInfo->addComponent($this->instagramAccountInput);
        $socialInfo->addComponent($this->youtubeAccountInput);
        $this->addComponent($socialInfo);
        
        $errorInfo = new Amhsoft_Widget_Panel(_t('Error Management'));
        $errorInfo->addComponent($this->errorYesNo);
        $errorInfo->addComponent($this->errortypeListBox);
        $this->addComponent($errorInfo);

        $logoPanel = new Amhsoft_Widget_Panel(_t('Shop Logo'));
        $logoPanel->addComponent($this->picture);

        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($logoPanel);
        $this->addComponent($navigationPanel);
    }

    /**
     * Form send method
     * @return type
     */
    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
