<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 133 2016-01-26 19:36:28Z a.cherif $
 * $Rev: 133 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 20:36:28 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 20:36:28 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of add
 *
 * @author cherif
 */
class Crm_Backend_Account_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Form $accountForm */
    public $accountForm;

    /** @var Crm_Account_Model $accountModel */
    public $accountModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->accountModel = new Crm_Account_Model();
        $this->accountForm = new Crm_Account_Form('account_form', $this->getSet(11), 'POST');
        $this->getView()->setMessage(_t('Add Account'), View_Message_Type::INFO);
        $this->accountForm->numberInput->Value = $this->accountModel->getNextAccountNumber();
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
        $this->accountForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->accountForm->isSend()) {
            if ($this->accountForm->isFormValid()) {
                $this->accountForm->DataBinding = $this->accountModel;
                $this->accountForm->Bind();
                $this->accountModel = $this->accountForm->getDataBindItem();
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $this->accountModel->register_date_time = Amhsoft_Locale::UCTDateTime();
                if (!$this->accountModel->password) {
                    $this->accountModel->password = Amhsoft_Common::randomPassword(6);
                }
                $decryptedPassword = $this->accountModel->getPassword();
                $this->accountModel->password = sha1($decryptedPassword);
                if (@$_POST['can_login']) {
                    $this->accountModel->setState(1);
                }
                $accountModelAdapter->save($this->accountModel);
                if ($this->accountModel->getId() > 0) {
                    if (isset($_POST['send_password']) && $_POST['send_password']  == 1) {
                        $notificationModel = new Crm_Notification_Account_Model($this->accountModel);
                        $notificationModel->sendPassword($decryptedPassword);
                    }
                    @unlink('media/dealer/' . $this->accountModel->getId() . '.jpg'); //remove it if exists
                    $this->accountForm->dealerLogo->getUploadControl()->uploadTo('media/dealer/' . $this->accountModel->getId() . '.jpg');
                }
                $this->getView()->setMessage(_t('Account was successully added'), 'success');
                //$this->getRedirector()->go('admin.php?module=crm&page=account-list&ret=true');
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), 'error');
            }
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->accountForm);
        $this->show();
    }

}

?>
