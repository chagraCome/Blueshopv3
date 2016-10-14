<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: General.php 341 2016-02-05 14:17:20Z montassar.amhsoft $
 * $Revision: 341 $
 * $LastChangedDate: 2016-02-05 15:17:20 +0100 (ven., 05 févr. 2016) $
 * $LastChangedBy: montassar.amhsoft $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    03.07.2008 - 15:37:46
 */
class Setting_Backend_General_Controller extends Amhsoft_System_Web_Controller {

    public $configTableAdapter;
    public $logoUploader;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->getView()->setMessage(_t('General Settings'), View_Message_Type::INFO);
        $this->configTableAdapter = new Amhsoft_Config_Table_Adapter('config');
        $this->logoUploader = new Amhsoft_ImageControl_Control('shop_logo');
        $fileUpload = new Amhsoft_FileInput_Control('shop_logo', _t('Shop Logo'));
        $this->logoUploader->setUploadControl($fileUpload);
        $this->logoUploader->setWidth(200);
        $this->logoUploader->DataBinding = new Amhsoft_Data_Binding('shop_logo');
        if (@file_exists($this->configTableAdapter->getValue("shop_logo"))) {
            $this->logoUploader->Value = $this->configTableAdapter->getValue("shop_logo");
        }
        $this->logoUploader->setDeleteUrl("admin.php?module=setting&page=general&event=deleteLogo");
        $this->getView()->assign("logo_uploader", $this->logoUploader);
    }

    /**
     * Default Event
     */
    public function __default() {
        if ($this->getRequest()->post('save')) {
            $this->uploadLogo();
            $this->save();
            $this->getView()->setMessage(_t('Data saved successfully.'), View_Message_Type::SUCCESS);
        }
    }

    private function uploadLogo() {
        if (@strlen($_FILES['trigger_shop_logo']['name']) > 0) {
            @unlink($this->configTableAdapter->getValue("shop_logo"));
            $ext = Amhsoft_Common::get_file_extension($this->logoUploader->uploadControl->Value['name']);
            $logoPath = 'shop_logo.' . $ext;
            $this->logoUploader->getUploadControl()->uploadTo('media/' . $logoPath);
            $this->configTableAdapter->setValue("shop_logo", 'media/' . $logoPath);
        }
    }

    /**
     * Save General Setting
     */
    private function save() {
        $current_lang = Amhsoft_System::getCurrentLang();

        $this->configTableAdapter->setValue('owner', $this->getRequest()->post("shop_owner"));
        $this->configTableAdapter->setValue("name_" . $current_lang, $this->getRequest()->post("shop_name"));
        $this->configTableAdapter->setValue("description_" . $current_lang, $this->getRequest()->post("shop_description"));
        $this->configTableAdapter->setValue("keywords_" . $current_lang, $this->getRequest()->post("shop_keywords"));
        $this->configTableAdapter->setValue("owner", $this->getRequest()->post("shop_owner"));
        $this->configTableAdapter->setValue("adress", $this->getRequest()->post("shop_address"));
        $this->configTableAdapter->setValue("tel", $this->getRequest()->post("shop_tel"));
        $this->configTableAdapter->setValue("fax", $this->getRequest()->post("shop_fax"));
        $this->configTableAdapter->setValue("mobile", $this->getRequest()->post("shop_mobile"));
        $this->configTableAdapter->setValue("email", $this->getRequest()->post("shop_email"));
        $this->configTableAdapter->setValue("url_friendly", $this->getRequest()->postInt("shop_url_friendly"));
        $this->configTableAdapter->setValue("rss", $this->getRequest()->postInt("shop_rss"));
        $this->configTableAdapter->setValue("shop_offline", $this->getRequest()->postInt("shop_offline"));
        $this->configTableAdapter->setValue("offline_ip", $this->getRequest()->post("offline_ip"));
        $this->configTableAdapter->setValue('google_analytic_code', htmlspecialchars($this->getRequest()->post("google_analytic_code")));
        $this->configTableAdapter->setValue('disable_image', $this->getRequest()->post("disable_image"));

        $this->configTableAdapter->setValue('facebookAccount', htmlspecialchars($this->getRequest()->post("facebookAccount")));
        $this->configTableAdapter->setValue('twitterAccount', htmlspecialchars($this->getRequest()->post("twitterAccount")));
        $this->configTableAdapter->setValue('googleplusAccount', htmlspecialchars($this->getRequest()->post("googleplusAccount")));
        $this->configTableAdapter->setValue('instagramAccount', htmlspecialchars($this->getRequest()->post("instagramAccount")));
        $this->configTableAdapter->setValue('youtubeAccount', htmlspecialchars($this->getRequest()->post("youtubeAccount")));

        $this->configTableAdapter->setValue('error_type', htmlspecialchars($this->getRequest()->post("error_type")));
        $this->configTableAdapter->setValue('show_errors', htmlspecialchars($this->getRequest()->post("show_errors")));





        $this->getRedirector()->go('?module=setting&page=general&ret=true');
    }

    public function __deleteLogo() {
        @unlink($this->configTableAdapter->getValue("shop_logo"));
        $this->configTableAdapter->setValue("shop_logo", null);

        $this->getRedirector()->go('?module=setting&page=general&ret=true');
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->getView()->assign('config', $this->configTableAdapter);
        $this->show();
    }

}
