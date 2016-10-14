<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Login.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Revision: 489 $
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 18:47:41
 */
class Crm_Frontend_Intern_Shop_Login_Controller extends Amhsoft_System_Web_Controller {

    public $accountModelAdapter;

    /** @var Password $inputPassword; * */
    protected $inputPassword;

    /** @var Input $inputEmail * */
    protected $inputEmail;

    /** @var Form $loginForm * */
    protected $loginForm;

    /** @var Button $loginButton * */
    protected $loginButton;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-login', 'label' => _t('Login')));
        $this->accountModelAdapter = new Crm_Account_Model_Adapter();
        $this->loginForm = new Amhsoft_Widget_Form('login_form', 'POST');
        $this->getView()->assign('loginform', $this->getComponents());
        if ($this->getRequest()->get('ret') == 'false') {
            $this->getView()->assign("message", "Login or password incorrect!");
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
        if ($this->getRequest()->isPost('login')) {
            if ($this->loginForm->isFormValid()) {
                $auth->authenticate(@addslashes($this->inputEmail->getValue()), @addslashes($this->inputPassword->getValue()));
                if ($auth->isAuthenticated()) {
                    Amhsoft_Event_Handler::trigger('after.crm.account.login', $this, $auth->getObject());
                    $redirect = Amhsoft_Registry::get('after_login');
                    if ($redirect) {
                        Amhsoft_Registry::destroy('after_login');
                        $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
                        //$this->getRedirector()->go($redirect);
                    }
                    $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
                } else {
                    $this->getView()->assign("message", _t('Login or password incorrect!'));
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
        $this->loginButton = new Amhsoft_Button_Submit_Control('login', _t('Login'));
        $this->loginForm->addComponent($this->inputEmail);
        $this->loginForm->addComponent($this->inputPassword);
        $this->loginForm->addComponent($linkForgotPassword);
        $this->loginForm->addComponent(new Amhsoft_Html_Control('<div class="spacer"></div> <br />'));
        $this->loginForm->addComponent($this->loginButton);
        $this->loginButton->setClass('button');
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        if ($accountConfiguration->getValue('facebook_login_state')) {
            $loginLink = new Amhsoft_Html_Control('<a href="index.php?module=crm&page=intern-shop-login&event=facebookLogin" style="line-height: 39px;" class="button fb-button"><i class="fa fa-facebook">&nbsp;</i>&nbsp' . _t('Login with facebook') . '</a>');
            $this->loginForm->addComponent($loginLink);
        }

        $dealerPanel->addComponent($this->loginForm);
        return $dealerPanel;
    }

    public function __facebookLogin() {
        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        if ($accountConfiguration->getValue('facebook_login_state') == 1) {
            Facebook\FacebookSession::setDefaultApplication($accountConfiguration->getValue('facebook_app_id'), $accountConfiguration->getValue('facebook_secret_key'));
            $helper = new Facebook\FacebookRedirectLoginHelper(Amhsoft_System_Config::getProperty("appurl") . '/index.php?module=crm&page=intern-shop-login&event=facebookLogin');
            try {
                $session = $helper->getSessionFromRedirect();
            } catch (Facebook\FacebookRequestException $ex) {
                Amhsoft_Debugger::addMessage($ex->getMessage(), 'error');
            } catch (Exception $ex) {
                Amhsoft_Debugger::addMessage($ex->getMessage(), 'error');
            }
            if (isset($session)) {
                $request = new Facebook\FacebookRequest($session, 'GET', '/me');
                $response = $request->execute();
                $graphObject = $response->getGraphObject();
                $fbid = $graphObject->getProperty('id');
                $fbfullname = $graphObject->getProperty('name');
                $femail = $graphObject->getProperty('email');

                $auth = Amhsoft_Authentication::getInstance();
                $facebookAdapter = new Amhsoft_Authentication_Facebook_Adapter('Crm_Account_Model_Adapter', 'email1');
                $auth->setAdapter($facebookAdapter);
                $auth->authenticate($femail);

                if ($auth->isAuthenticated()) {
                    $redirect = Amhsoft_Registry::get('after_login');
                    if ($redirect) {
                        Amhsoft_Registry::destroy('after_login');
                        $this->getRedirector()->go($redirect);
                    }
                    $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
                } else {
                    $this->register($graphObject);
                }
            } else {
                $perms = array('scope' => 'email');
                $loginUrl = $helper->getLoginUrl($perms);
                $this->getRedirector()->go($loginUrl);
            }
        }
    }

    public function register($graphObject) {
        $fbfullname = $graphObject->getProperty('name');
        $femail = $graphObject->getProperty('email');
        $crmAccountModel = new Crm_Account_Model();
        $crmAccountModel->name = $fbfullname;
        $crmAccountModel->email1 = $femail;
        $crmAccountModel->register_date_time = Amhsoft_Locale::UCTDateTime();
        $crmAccountModel->setGroup(Crm_Group_Model::getDefaultGroup());
        $crmAccountModel->number = $crmAccountModel->getNextAccountNumber();
        $crmAccountModel->setState(1);

        $crmAccountModelAdapter = new Crm_Account_Model_Adapter();
        $crmAccountModelAdapter->save($crmAccountModel);

        $auth = Amhsoft_Authentication::getInstance();
        $facebookAdapter = new Amhsoft_Authentication_Facebook_Adapter('Crm_Account_Model_Adapter', 'email1');
        $auth->setAdapter($facebookAdapter);
        $auth->authenticate($femail);

        if ($auth->isAuthenticated()) {
            $redirect = Amhsoft_Registry::get('after_login');
            if ($redirect) {
                Amhsoft_Registry::destroy('after_login');
                $this->getRedirector()->go($redirect);
            }
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-home');
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->show();
    }

}
