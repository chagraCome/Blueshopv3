<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_State_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var SaleOrderStateForm $saleOrderStateForm */
    protected $saleOrderStateForm;

    /** @var SaleOrderStateModel $saleOrderStateModel */
    protected $saleOrderStateModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->saleOrderStateForm = new Saleorder_State_Form('project_form', 'POST');
        $this->getView()->setMessage(_t('Edit Sales Order State'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $saleOrderStateModelAdapter = new Saleorder_State_Model_Adapter();
            $this->saleOrderStateModel = $saleOrderStateModelAdapter->fetchById($id);
        }
        if (!$this->saleOrderStateModel instanceof Saleorder_State_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->saleOrderStateForm->DataSource = new Amhsoft_Data_Set($this->saleOrderStateModel);
        $this->saleOrderStateForm->Bind();
    }

    /**
     * Default event
     */
    public function __default() {

        if ($this->saleOrderStateForm->isSend()) {
            $this->saleOrderStateForm->DataSource = Amhsoft_Data_Source::Post();
            $this->saleOrderStateForm->Bind();
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

    protected function handleSuccess() {
        $this->getRedirector()->go(Amhsoft_History::back(0));
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
