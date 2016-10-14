<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 401 2016-02-11 12:19:40Z amira.amhsoft $
 * $Rev: 401 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-11 13:19:40 +0100 (jeu., 11 févr. 2016) $
 * $LastChangedDate: 2016-02-11 13:19:40 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

class Crm_Frontend_Intern_Shop_Address_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var Crm_Address_Form crmAddressForm */
    protected $crmAddressForm;

    /** @var Crm_Address_Model crmAddressModel */
    protected $crmAddressModel;

    /**
     * Initialize event
     */
    public function __initialize() {

        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $this->crmAddressForm = new Crm_Address_Form('crmAddressForm_form', 'POST');
        //$this->getView()->setMessage(_t('Modify Address'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-address-list', 'label' => _t('Manage Addresses')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-address-modify&id='.$id, 'label' => _t('Modify Address')));

        if ($id > 0) {
            $crmAddressModelAdapter = new Crm_Address_Model_Adapter();
            $this->crmAddressModel = $crmAddressModelAdapter->fetchById($id);
        }
        if (!$this->crmAddressModel instanceof Crm_Address_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        if (!$this->crmAddressModel->account_id == $auth->getObject()->id) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->crmAddressForm->DataSource = new Amhsoft_Data_Set($this->crmAddressModel);
        $this->crmAddressForm->Bind();
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->crmAddressForm->isSend()) {
            $this->crmAddressForm->DataSource = Amhsoft_Data_Source::Post();
            $this->crmAddressForm->Bind();
            if ($this->crmAddressForm->isValid()) {
                $this->crmAddressForm->DataBinding = $this->crmAddressModel;
                $crmAddressModelAdapter = new Crm_Address_Model_Adapter();
                $this->crmAddressModel = $this->crmAddressForm->getDataBindItem();

                $crmAddressModelAdapter->save($this->crmAddressModel);
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
        Amhsoft_Navigator::go('index.php?module=crm&page=intern-shop-address-list&ret=true');
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('widget', $this->crmAddressForm);
        $this->show();
    }

}
?>

