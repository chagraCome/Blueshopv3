<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Login.php 312 2014-03-23 03:19:15Z hachem.tlili $
 * $Revision: 312 $
 * $LastChangedDate: 2014-03-23 04:19:15 +0100 (dim., 23 mars 2014) $
 * $LastChangedBy: hachem.tlili $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 18:47:41
 */
class Crm_Frontend_Intern_Shop_Loginpopup_Controller extends Amhsoft_System_Web_Controller {

    public $accountModelAdapter;

    /** @var Password $inputPassword; * */
    protected $inputPassword;

    /** @var Input $inputEmail * */
    protected $inputEmail;

    /** @var Form $loginpopupform * */
    protected $loginpopupform;

    /** @var Button $loginButton * */
    protected $loginButton;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-loginpopup', 'label' => _t('login')));
        $this->accountModelAdapter = new Crm_Account_Model_Adapter();
        $this->loginpopupform = new Amhsoft_Widget_Form('loginpopup_form', 'POST');
        $this->getView()->assign('loginpopupform', $this->getComponents());
        if ($this->getRequest()->get('ret')) {
            $this->getView()->assign('success', _t('You are successufly registred please login to start your work !'));
        }
    }

    /**
     * Default event
     */
    public function __default() {
        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $auth->clear();
        }
        $this->loginpopupform->DataSource = Amhsoft_Data_Source::Post();
        if ($this->getRequest()->isPost('loginpop')) {
            if ($this->loginpopupform->isValid()) {
                $auth->authenticate(@addslashes($this->inputEmail->getValue()), @addslashes($this->inputPassword->getValue()));
                if ($auth->isAuthenticated()) {
                    Amhsoft_Event_Handler::trigger('after.crm.account.login', $this, $auth->getObject());
                    $redirect = Amhsoft_Registry::get('after_login');
                    if ($redirect) {
                        Amhsoft_Registry::destroy('after_login');
                        $this->getRedirector()->go($redirect);
                    }
                    $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
                } else {
                    $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login'. '&ret=false');
                   
                    
                }
            }
        }
    }

    protected function getComponents() {
        $gridLayout = new Amhsoft_Grid_Layout(2);
        $panel = new Amhsoft_Widget_Panel();
        $panel->setLayout($gridLayout);
        $dealerPanel = new Amhsoft_Widget_Panel();
        $dealerPanel->setWidth(400);
        //email
        $this->inputEmail = new Amhsoft_Input_Control('email', _t('Email Adress'));
        $this->inputEmail->setRequired(true);
        $this->inputEmail->setWidth(220);
        $this->inputEmail->addValidator('Email');
        $this->inputEmail->DataBinding = new Amhsoft_Data_Binding('email');
        $this->inputEmail->setErrorMessage(_t('Required'));
        //password
        $this->inputPassword = new Amhsoft_Password_Control('password', _t('Password'));
        $this->inputPassword->DataBinding = new Amhsoft_Data_Binding('password');
        $this->inputPassword->setRequired(true);
        $this->inputPassword->setWidth(220);
        $this->inputPassword->setErrorMessage(_t('Required'));
        //link forgot password
        $linkForgotPassword = new Amhsoft_Link_Control(_t('Forgot Your Password?'), 'index.php?module=crm&page=intern-shop-forgotpassword');
        //loginButton
        $this->loginButton = new Amhsoft_Button_Submit_Control('loginpop', '   ' . _t('Login') . '   ');
        $registrationLink = new Amhsoft_Link_Control(_t('open a new Account'), 'index.php?module=crm&page=intern-shop-register');
        $registrationLink->setClass('Button');
        $this->loginpopupform->addComponent($this->inputEmail);
        $this->loginpopupform->addComponent($this->inputPassword);
        $this->loginpopupform->addComponent($linkForgotPassword);
        $this->loginpopupform->addComponent(new Amhsoft_Html_Control('<div class="spacer"></div> <br />'));
        $this->loginpopupform->addComponent($this->loginButton);
        //$this->loginForm->addComponent($registrationLink);
        $dealerPanel->addComponent($this->loginpopupform);
        return $dealerPanel;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
     
    }

}
