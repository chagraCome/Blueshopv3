<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Sendtofriend.php 323 2016-02-04 13:59:02Z amira.amhsoft $
 * $Revision: 323 $
 * $LastChangedDate: 2016-02-04 14:59:02 +0100 (jeu., 04 févr. 2016) $
 * $LastChangedBy: amira.amhsoft $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    22.11.2010 - 16:40:59
 */
class Product_Frontend_Sendtofriend_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Product_Model VehicleModel */
    protected $productModel;

    /** @var Product_Product_Model_Adapter $productModelAdapter */
    protected $productModelAdapter;

    /** @var object form values */
    protected $formValues = array();

    /** @var integer id */
    protected $id;

    /** @var Product_Sendtofreind_Form $sendForm */
    public $sendForm;

    /**
     * Initialize Components.
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=product&page=sendtofriend&id='.$this->id, 'label' => _t('Send to friend')));
        $this->id = $this->getRequest()->getId();
        $this->sendForm = new Product_Sendtofreind_Form('sendtofreind', 'POST');
        if ($this->id == null) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->productModelAdapter = new Product_Product_Model_Adapter();
        if ($this->id > 0) {
            $this->productModel = $this->productModelAdapter->fetchById($this->id);
        }
        if ($this->productModel == null) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        if ($this->sendForm->messageTextArea->Value == '') {
            $this->sendForm->messageTextArea->Value = $this->productModel->getTitle() . "\n" . $this->productModel->getUrl(true);
        }
    }

    /**
     * Default Event.
     */
    public function __default() {
        if ($this->sendForm->isSend()) {
            if ($this->sendForm->isFormValid()) {
                $this->formValues = $this->sendForm->getValues();
                $this->sendButtonSendtofriend_Click();
            }
        }
    }

    /**
     * Handle Send to friend 
     */
    protected function sendButtonSendtofriend_Click() {
        $email = new Amhsoft_Mail_Client();
        $email->AddAddress($this->formValues['recipientemail'], $this->formValues['recipientemail']);
        $email->SetFrom($this->formValues['senderemail'], $this->formValues['senderemail']);
        $email->setSubject($this->formValues['subject']);
        $link = $this->productModel->getUrl(true);
        $link = '<a href="' . $link . '">' . $link . '</a>';
        $email->SetHtmlBody($this->formValues['message'] . '<br /><br />URL: ' . $link . '<br /><br />
        ' . _t('Best Regards') . ',<br />
        ' . $this->formValues['name']);
        $email->Send();
        if ($email->IsError()) {
            
        } else {
            Amhsoft_Navigator::go('index.php?module=product&page=detail&ret=true&id=' . $this->id);
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('item', $this->productModel);
        $this->getView()->assign('form', $this->sendForm);
        $this->show();
    }

}
