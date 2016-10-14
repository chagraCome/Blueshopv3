<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Register.php 279 2016-02-03 09:05:07Z amira.amhsoft $
 * $Rev: 279 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-03 10:05:07 +0100 (mer., 03 févr. 2016) $
 * $LastChangedDate: 2016-02-03 10:05:07 +0100 (mer., 03 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of account
 *
 * @author cherif
 */
class Crm_Frontend_Intern_Shop_Register_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Form $accountForm */
    protected $accountForm;

    /** @var Crm_Account_Model $accountModel */
    protected $accountModel;
    protected $accountConfiguration;
    protected $notificationModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-register', 'label' => _t('Open a new account')));
        $this->accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        $this->accountModel = new Crm_Account_Model();

        $this->accountForm = new Crm_Customer_Form('quick_reg_form', $this->getSet(11), 'post');
        $this->accountForm->email1Input->addValidator('Unique|account|email1');
    }

    /**
     * Gets Account set model.
     * @return Eav_Set_Model
     */
    protected function getSet($setid) {
        if ($setid <= 0) {
            return null;
        }

        $accountSetModelAdapter = new Eav_Set_Model_Adapter();
        $accounSetModel = $accountSetModelAdapter->fetchById($setid);
        if ($accounSetModel instanceof Eav_Set_Model) {
            $this->accountModel->entity_set_id = $setid;
        }
        return $accounSetModel;
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->accountForm->isSend()) {
            $this->accountForm->DataSource = Amhsoft_Data_Source::Post();
            $this->accountForm->Bind();
            if ($this->accountForm->isValid()) {
                $this->accountForm->DataBinding = $this->accountModel;
                $this->accountForm->Bind();
                $this->accountModel = $this->accountForm->getDataBindItem();
                $this->accountModel->setPassword(sha1($this->getRequest()->post('password')));
                $this->accountModel->register_date_time = Amhsoft_Locale::UCTDateTime();
                $this->accountModel->setGroup(Crm_Group_Model::getDefaultGroup());
                $this->accountModel->number = $this->accountModel->getNextAccountNumber();
                $this->accountModel->setState(1);
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $accountModelAdapter->save($this->accountModel);
                $this->notificationModel = new Crm_Notification_Account_Model($this->accountModel);
                if ($this->accountModel->getId() > 0) {
                    $this->notificationModel->notifyAccountRegistred();
                    $this->notificationModel->notifyAdminAccountRegistred();
                    $auth = Amhsoft_Authentication::getInstance();
                    $auth->authenticate($this->accountModel->getEmail1(), $this->getRequest()->post('password'));
                    if ($auth->isAuthenticated()) {

                        Amhsoft_Event_Handler::trigger('after.crm.account.login', $this, $this->accountModel);

                        $after_login = Amhsoft_Registry::get('after_login');
                        if ($after_login) {
                            $this->getRedirector()->go($after_login);
                        } else {
                            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
                        }
                    } else {
                        Amhsoft_Log::error('cannot log with post password and email ', array($this->accountModel, $this->getRequest()->post('password')));
                        $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
                    }
                } else {
                    $this->getView()->assign('registration_message', _t('Cannot Register account please try again'));
                    Amhsoft_Log::error("Id is null , account not regisred", $this->accountModel);
                }
            }
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $panel = new Amhsoft_Widget_Panel(" ");
        $panel->addComponent($this->accountForm);
        $this->getView()->assign('quickregform', $panel);
        $this->show();
    }

}

?>
