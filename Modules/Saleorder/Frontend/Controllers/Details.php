<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Details.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Saleorder_Frontend_Details_Controller extends Amhsoft_System_Web_Controller {

    protected $saleOrderModelAdapter;
    protected $saledOrderModel;
    protected $account_id;
    protected $id;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->id = $this->getRequest()->getInt('id');
        $this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=list', 'label' => _t('Orders List')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=index.php?module=saleorder&page=details&id=' . $this->id, 'label' => _t('Order Information')));

        if (intval($this->id) > 0) {
            $auth = Amhsoft_Authentication::getInstance();
            if ($auth->isAuthenticated()) {
                $this->account_id = $auth->getObject()->id;
            } else {
                Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=details&id=' . $this->id);
                $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
            }
            $this->saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $this->saleOrderModelAdapter->where('account_id = ' . $this->account_id);
            $this->saledOrderModel = $this->saleOrderModelAdapter->fetchById($this->id);
            if (!$this->saledOrderModel->getItems()) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
            if (!$this->saledOrderModel instanceof Saleorder_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
    }

    /**
     * Event/action print
     */
    public function __print() {
        $printTemplateModelAdapter = new Setting_Template_Print_Model_Adapter();
        $printTemplateModelAdapter->where('name = ?', 'saleorder.frontend', PDO::PARAM_STR);
        $printTemplateModel = $printTemplateModelAdapter->fetch()->fetch();
        if ($printTemplateModel instanceof Setting_Template_Print_Model) {
            $this->getView()->assign('saleorder_template', $printTemplateModel->getFilledContent(array($this->saledOrderModel)));
        }
        $this->getView()->assign('saleorder', $this->saledOrderModel);
        echo '<script type="text/javascript">window.print();</script>';
        $this->popup("Modules/Saleorder/Frontend/Views/print.popup.html");
        exit;
    }

    /**
     * Default event
     */
    public function __default() {
        
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('saleorder', $this->saledOrderModel);
        $this->getView()->assign('documents', $this->saledOrderModel->getOnlineDocuments());

        if (Amhsoft_System_Module_Manager::isModuleInstalled('Comment')) {
            $commentModelAdapter = new Comment_Model_Adapter();
            $commentModelAdapter->where('entity = ?', 'Saleorder_Model', PDO::PARAM_STR);
            $commentModelAdapter->where('entity_id = ?', $this->saledOrderModel->getId());
            $commentModelAdapter->where('public = 1');
            $this->getView()->assign("comments", $commentModelAdapter->fetch());
        }


        //TODO: please set $hide_action_paynow to true if saleorder is paid
        $saleOrderConfiguration = new Amhsoft_Config_Table_Adapter(Saleorder_Model::SETTING);
        if (@$this->saledOrderModel->saleOrderState->id == Saleorder_State_Model::PAID) {
            $this->getView()->assign('hide_action_paynow', TRUE);
        }

        $this->show();
    }

}

?>
