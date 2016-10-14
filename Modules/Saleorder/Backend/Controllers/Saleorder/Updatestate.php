<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Updatestate.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Backend_Saleorder_Updatestate_Controller extends Amhsoft_System_Web_Controller {

    /** @var Saleorder_Updatestate_Form $updateStateForm* */
    public $updateStateForm;
    public $id;

    /** @var Saleorder_Model $saleOrderModel * */
    public $saleOrderModel;

    /** @var Saleorder_Model_Adapter $saleOrderModelAdapter* */
    public $saleOrderModelAdapter;
    public $oldSaleorderState;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->getView()->setMessage(_t('Update Sales Order state'), View_Message_Type::INFO);
        $this->id = $this->getRequest()->getId();

        if ($this->id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $this->saleOrderModel = $this->saleOrderModelAdapter->fetchById($this->id);
        if (!$this->saleOrderModel instanceof Saleorder_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->oldSaleorderState = $this->saleOrderModel->sale_order_state_id;
        $this->updateStateForm = new Saleorder_Updatestate_Form('saleOrderForm_form', 'POST');
        $this->updateStateForm->DataSource = new Amhsoft_Data_Set($this->saleOrderModel);
        $this->updateStateForm->Bind();

        if ($this->saleOrderModel->saleOrderState == null) {
            $this->saleOrderModel->saleOrderState = new Saleorder_State_Model();
        }
        $states = $this->saleOrderModel->saleOrderState->getNext();

        $this->updateStateForm->saleOrderStateInput->DataSource = new Amhsoft_Data_Set($states);
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->updateStateForm->isSend()) {
            if ($this->updateStateForm->isFormValid()) {
                $data = $this->updateStateForm->getValues();

                $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
                if ($this->saleOrderModel->sale_order_state_id != $data['sale_order_state_id']) {
                    $this->saleOrderModel->sale_order_state_id = $data['sale_order_state_id'];
                }
                $this->saleOrderModel->updateat = Amhsoft_Locale::DateTime();
                $this->saleOrderModelAdapter->save($this->saleOrderModel);

                $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);

                if ($this->saleOrderModel->sale_order_state_id == Saleorder_State_Model::CANCELED && $this->saleOrderModel->sale_order_state_id != $this->oldSaleorderState) {
                    try {
                        $this->saleOrderModel->incrementQuantity();
                    } catch (Exception $e) {
                        Amhsoft_Log::error($e->getMessage());
                    }
                }


                if ($this->getRequest()->postInt('notify') == 1) {
                    Saleorder_Notification_Model::updateStateNotification($this->saleOrderModel, $data['subject'], $data['content']);
                    $this->assignEmailToSaleorder($data);
                }

                $this->getRedirector()->go('?module=saleorder&page=saleorder-details&id=' . $this->saleOrderModel->getId() . '&ret=true');
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    protected function assignEmailToSaleorder($data) {
        if (!Amhsoft_System_Module_Manager::isModuleInstalled('Webmail')) {
            return;
        }
        if (!empty($data)) {
            $webMailModel = new Webmail_Email_Model();
            $webMailModel->setSubject($data['subject']);
            $webMailModel->setContent($data['content']);

            if ($this->saleOrderModel->account instanceof Crm_Account_Model) {
                $webMailModel->setTo_emails($this->saleOrderModel->account->getEmail());
            }
            $webMailModel->setState(Webmail_Email_Model::SEND);
            $webMailModel->setCreateat(Amhsoft_Locale::UCTDateTime());
            $webMailModel->setSendat(Amhsoft_Locale::UCTDateTime());
            $webMailModel->setFrom_name(Amhsoft_Authentication::getInstance()->getObject()->username);
            $webMailModel->setFrom_email(Amhsoft_Authentication::getInstance()->getObject()->email);
            $webmailModelAdapter = new Webmail_Email_Model_Adapter();
            $webmailModelAdapter->save($webMailModel);
            $db = Amhsoft_Database::getInstance();
            if ($webMailModel->getId() > 0) {
                if ($this->saleOrderModel->account instanceof Crm_Account_Model) {
                    $sql1 = "INSERT INTO `account_has_email` VALUES (" . $webMailModel->getId() . "," . $this->saleOrderModel->account->getId() . " )";
                    $db->exec($sql1);
                }

                $sql2 = "INSERT INTO `saleorder_has_email` VALUES (" . $this->saleOrderModel->getId() . "," . $webMailModel->getId() . " )";
                $db->exec($sql2);
            }
        }
        return true;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->updateStateForm);
        $this->show();
    }

}

?>