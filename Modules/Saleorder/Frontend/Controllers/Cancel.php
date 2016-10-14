<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Cancel.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Saleorder_Frontend_Cancel_Controller extends Amhsoft_System_Web_Controller {

    protected $saleOrderModelAdapter;
    protected $saledOrderModel;
    protected $account_id;
    protected $id;

    /** @var Saleorder_Cancel_Form $form */
    protected $form;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->id = $this->getRequest()->get('id');
        if (intval($this->id) > 0) {
            $auth = Amhsoft_Authentication::getInstance();
            if ($auth->isAuthenticated()) {
                $this->account_id = $auth->getObject()->id;
            } else {
                Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=list');
                $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
            }
            $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $this->saleOrderModelAdapter->where('account_id = ' . $this->account_id);

            $this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=list', 'label' => _t('Orders List')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=cancel&id=' . $this->id, 'label' => _t('Cancel Sales Order')));
            $this->saledOrderModel = $this->saleOrderModelAdapter->fetchById($this->id);
            if (!$this->saledOrderModel instanceof Saleorder_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->form = new Saleorder_Cancel_Form('cancel', 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->form->isSend()) {
            if ($this->form->isFormValid()) {
                $data = $this->form->getValues();
                $this->saveComment(@$data['message']);
                $this->saledOrderModel->sale_order_state_id = Saleorder_State_Model::CANCELED;
                $this->saleOrderModelAdapter->save($this->saledOrderModel);
                $this->notifyAdmin();
                //var_dump($this->notifyAdmin()); exit();
                $this->getView()->assign("success", _t('Your saleorder was successfully canceled'));
            } else {
                $this->getView()->assign("error", _t('Please verify input'));
            }
        }
    }

    public function saveComment($message) {
        $commentModel = new Comment_Model();
        $commentModel->insertat = Amhsoft_Locale::UCTDateTime();
        $commentModel->setEntity('Saleorder_Model');
        $commentModel->setEntityId($this->saledOrderModel->getId());
        $commentModel->setComment($message);
        $commentModel->setAuthor_name(Amhsoft_Authentication::getInstance()->getObject()->name);
        $commentModel->setPublic_seen(0);
        $commentModel->setPublic(1);
        $commentModel->setUser_seen(0);
        $commentModelAdapter = new Comment_Model_Adapter();
        $commentModelAdapter->save($commentModel);
    }

    public function notifyAdmin() {
        $templateModel = $this->getTemplate(Saleorder_State_Model::CANCELED_EMAIL_NOTIFICATION);
        if ($templateModel instanceof Setting_Template_Email_Model) {
            $subject = $templateModel->getSubject();
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $saleOrderModel = $this->saleOrderModelAdapter->fetchById($this->id);
            if ($saleOrderModel instanceof Saleorder_Model) {
                $this->saleorderModel = $saleOrderModel;
            }
            $content = @htmlspecialchars_decode($templateModel->getFilledContent(array($this->saleorderModel)));
        } else {
            $subject = _t('Order Canceled');
            $content = _t('Order canceled  in buyzzaat');
        }
        $saleorderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        $settings_id = $saleorderConfiguration->getValue(Saleorder_Model::NOTIFICATION_EMAIL_FROM);
        $data = Webmail_Setting_Model::getMailClientOptionsById($settings_id);
        $to = @$data['From'];

        $this->sendEmail($to, $settings_id, $subject, $content);
    }

    public function sendEmail($to, $from, $subject, $message) {
        try {
            $mailClient = new Amhsoft_Mail_Client(null, $from);
            $data = Webmail_Setting_Model::getMailClientOptionsById($from);
            $mailClient->AddAddress($to);
            $mailClient->setSubject($subject);
            $mailClient->SetFrom(@$data['From']);
            $mailClient->SetHtmlBody($message);
            $mailClient->Send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Send Email .
     * @param type $to
     * @param type $from
     * @param type $subject
     * @param type $message
     */
    public static function _sendEmail($to, $from, $subject, $message) {
        try {
            $mailClient = new Amhsoft_Mail_Client(null, $from);
            $data = Webmail_Setting_Model::getMailClientOptionsById($from);
            $mailClient->AddAddress($to);
            $mailClient->setSubject($subject);
            $mailClient->SetFrom(@$data['From']);
            $mailClient->SetHtmlBody($message);
            $mailClient->Send();
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    public function getTemplate($state) {
        $templateID = $state;
        $emailTemplateModel = null;
        if ($templateID > 0) {
            $emailTemplateModelAdapter = new Setting_Template_Email_Model_Adapter();
            $emailTemplateModel = $emailTemplateModelAdapter->fetchById($templateID);
        }
        return $emailTemplateModel;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->form);
        $this->show();
    }

}

?>
