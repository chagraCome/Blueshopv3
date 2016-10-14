<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Banner
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Banner_Backend_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Banner_Form $bannerForm */
    protected $bannerForm;

    /** @var ImageModel $bannerModel */
    protected $bannerModel;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->bannerForm = new Banner_Form('bannerForm_form', 'POST');
        $this->bannerModel = new Banner_Model();
        $this->getView()->setMessage(_t('Add new Banner'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->bannerForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->bannerForm->isSend()) {
            if ($this->bannerForm->isValid()) {
                $this->bannerForm->DataBinding = $this->bannerModel;
                $this->bannerForm->Bind();
                $bannerModelAdapter = new Banner_Model_Adapter();
                $this->bannerModel->setFolder('/media/banners');
                $this->bannerModel->setExtention($this->bannerForm->bannerfileInput->getExtention());
                if (!$this->bannerForm->nameInput->Value) {
                    $this->bannerModel->setName($this->bannerForm->bannerfileInput->getTempFileName());
                }
                $this->bannerModel = $this->bannerForm->getDataBindItem();
                $this->bannerModel->insertat = Amhsoft_Locale::UCTDateTime();
                $bannerModelAdapter->save($this->bannerModel);
                $this->handleSuccess();
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    /**
     * Handle success.
     */
    protected function handleSuccess() {
        if ($this->bannerModel->getId()) {
            try {
                if ($this->bannerForm->bannerfileInput->Value['tmp_name']) {
                    $this->bannerModel->uploadFromTemp($this->bannerForm->bannerfileInput->Value);
                }
                $this->getRedirector()->go('?module=banner&page=list&ret=true');
            } catch (Exception $e) {
                $this->getView()->setMessage($e->getMessage(), View_Message_Type::ERROR);
            }
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->bannerForm);
        $this->show();
    }

}

?>
