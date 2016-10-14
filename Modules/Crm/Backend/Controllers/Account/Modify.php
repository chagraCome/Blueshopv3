<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 396 2016-02-11 09:09:46Z amira.amhsoft $
 * $Rev: 396 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-11 10:09:46 +0100 (jeu., 11 févr. 2016) $
 * $LastChangedDate: 2016-02-11 10:09:46 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of add
 *
 * @author cherif
 */
class Crm_Backend_Account_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Form $accountForm */
    protected $accountForm;

    /** @var Crm_Account_Model $accountModel */
    protected $accountModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->accountModel = new Crm_Account_Model();
        $this->accountForm = new Crm_Account_Form('account_form', $this->getSet(11), 'POST');
        $this->getView()->setMessage(_t('Edit Account'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $accountModelAdapter = new Crm_Account_Model_Adapter();
            $this->accountModel = $accountModelAdapter->fetchById($id);
        }
        if (!$this->accountModel instanceof Crm_Account_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->accountForm->dealerLogo->setDeleteUrl('admin.php?module=crm&page=account-modify&id=' . $this->accountModel->getId() . '&event=deletelogo');
        $this->accountForm->DataSource = new Amhsoft_Data_Set($this->accountModel);
        $this->accountForm->Bind();
        $this->accountForm->passwordInput->Value = '******';
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
            if ($this->accountForm->isFormValid()) {
                $this->accountForm->DataBinding = $this->accountModel;
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $oldPassword = $this->accountModel->getPassword();
                $this->accountModel = $this->accountForm->getDataBindItem();
                $decryptedPassword = null;
                if ($this->accountModel->getPassword() != '******') {
                    $decryptedPassword = $this->accountModel->getPassword();
                    $this->accountModel->setPassword(sha1($this->accountModel->getPassword()));
                } else {
                    $this->accountModel->setPassword($oldPassword);
                }
//	if (@$_POST['can_login']) {
//	  $this->accountModel->setState(1);
//	} else {
//	  $this->accountModel->setState(0);
//	}
                $accountModelAdapter->save($this->accountModel);

//	if ($_POST['send_password'] && $decryptedPassword) {
//	  $notificationModel = new Crm_Notification_Account_Model($this->accountModel);
//	  $notificationModel->sendPassword($decryptedPassword);
//	}
                $uploadControl = $this->accountForm->dealerLogo->getUploadControl();
                if ($uploadControl->Value) {
                    $uploadControl->uploadTo('media/dealer/' . $this->accountModel->getId() . '.jpg');
                }
                $this->getRedirector()->go('?module=crm&page=account-list&ret=true');
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), 'error');
            }
        }
    }

    /**
     * Deletelogo event
     */
    public function __deletelogo() {
        @unlink('media/dealer/' . $this->accountModel->getId() . '.jpg');
        $this->getRedirector()->go('admin.php?module=crm&page=account-modify&ret=true&id=' . $this->accountModel->getId());
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