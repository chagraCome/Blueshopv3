<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Account.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Account_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Account_Form $accountForm */
    protected $accountForm;

    /** @var Crm_Account_Model $accountModel */
    protected $accountModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-account', 'label' => _t('Modify Account')));

        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $this->accountForm = new Crm_Customer_Form('account_form', 'POST');
        $this->accountForm->removeByName('submit');
        $this->accountForm->removeByName('cap');
        $this->accountForm->removeByName('repassword');
        $this->accountForm->removeByName('password');
        $this->accountForm->removeByName('email1');
        $this->accountForm->removeByName('account_source_id');
        $this->accountForm->submitButton->Value = _t('Save');
        $this->accountForm->addComponent($this->accountForm->submitButton);
        $this->getView()->setMessage(_t('Edit Account'), View_Message_Type::INFO);
        $id = $auth->getObject()->id;
        if ($id > 0) {
            $accountModelAdapter = new Crm_Account_Model_Adapter();
            $this->accountModel = $accountModelAdapter->fetchById($id);
        }
        if (!$this->accountModel instanceof Crm_Account_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->accountForm->DataSource = new Amhsoft_Data_Set($this->accountModel);
        $this->accountForm->Bind();
        $this->accountForm->email1Input->addValidator('Unique|account|email1|' . $this->accountModel->getEmail1());
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
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $accountModel = $this->accountForm->getDataBindItem();
                $accountModelAdapter->save($accountModel);
                $this->getRedirector()->go(Amhsoft_History::back());
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
