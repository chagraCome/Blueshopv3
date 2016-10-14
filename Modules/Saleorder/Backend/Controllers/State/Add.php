<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_State_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderStateForm $saleOrderStateForm */
    protected $saleOrderStateForm;

    /** @var SaleOrderStateModel $saleOrderStateModel */
    protected $saleOrderStateModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderStateForm = new Saleorder_State_Form('saleOrderStateForm_form', 'POST');
        $this->saleOrderStateModel = new Saleorder_State_Model();
        $this->getView()->setMessage(_t('Create new Sales Order State'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->saleOrderStateForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->saleOrderStateForm->isSend()) {
            if ($this->saleOrderStateForm->isValid()) {
                $this->saleOrderStateForm->DataBinding = $this->saleOrderStateModel;
                $saleOrderStateModelAdapter = new Saleorder_State_Model_Adapter();
                $this->saleOrderStateModel = $this->saleOrderStateForm->getDataBindItem();
                $saleOrderStateModelAdapter->save($this->saleOrderStateModel);
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
        $this->getRedirector()->go('admin.php?module=saleorder&page=setting&ret=true');
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->saleOrderStateForm);
        $this->show();
    }

}

?>
