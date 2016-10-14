<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Account.php 465 2016-03-02 16:44:11Z imen.amhsoft $
 * $Rev: 465 $
 * @package    Cart
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-03-02 17:44:11 +0100 (mer., 02 mars 2016) $
 * $LastChangedDate: 2016-03-02 17:44:11 +0100 (mer., 02 mars 2016) $
 * $Author: imen.amhsoft $
 */

class Cart_Frontend_Checkout_Account_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Customer_Form $accountForm */
    public $accountForm;

    /** @var AccountModel $accountModel */
    protected $accountModel;

    /**
     * Initialize Controller
     * @throws Amhsoft_Item_Not_Found_Exception
     */
    public function __initialize() {
        $this->accountForm = new Crm_Customer_Form('quick_reg_form', 'POST');
        $this->accountForm->removeByName('cap');
        $this->accountForm->removeByName('repassword');
        $this->accountForm->removeByName('password');
        $this->accountForm->email1Input->addValidator('Unique|account|email1');
        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->accountModel = new Crm_Account_Model();
            $this->accountModel->register_date_time = Amhsoft_Locale::UCTDateTime();
            $this->accountModel->setGroup(Crm_Group_Model::getDefaultGroup());
            $this->accountModel->number = $this->accountModel->getNextAccountNumber();
        } else {
            $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
            $this->accountModel = $crmAccountModelAdapter->fetchById($auth->getObject()->id);
            $this->accountForm->DataSource = new Amhsoft_Data_Set($this->accountModel);
            $this->accountForm->Bind();
            $this->accountForm->email1Input->addValidator('Unique|account|email1|' . $this->accountModel->getEmail1());
			$this->getRedirector()->go('index.php?module=cart&page=checkout-address');
        }
    }

    /**
     * Default Event
     */
    public function __default() {
        if ($this->accountForm->isSend()) {
            if ($this->accountForm->isFormValid()) {
                $this->accountForm->DataBinding = $this->accountModel;
                $this->accountForm->Bind();
                $this->accountModel = $this->accountForm->getDataBindItem();
                $this->accountForm->register_date_time = Amhsoft_Locale::UCTDateTime();
                $accountModelAdapter = new Crm_Account_Model_Adapter();
                $accountModelAdapter->save($this->accountModel);
                $cart = Cart_Shoppingcart_Model::getInstance();
                $cart->setAccount($this->accountModel)->Persist();
                $this->getRedirector()->go('index.php?module=cart&page=checkout-address');
            }
        }
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->getView()->assign('quickregform', $this->accountForm);
        $this->show();
    }

}

?>
