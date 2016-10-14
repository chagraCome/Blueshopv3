<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Saleorder_Frontend_Comment_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Comment_Form commentForm */
    protected $commentForm;

    /** @var Comment_Model commentModel */
    protected $commentModel;
    protected $entity;
    protected $entityid;

    /**
     * Initialize event
     */
    public function __initialize() {

        $this->entity = $this->getRequest()->get('entity');
        $this->entityid = $this->getRequest()->getInt('entityid');
        $this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=index.php?module=saleorder&page=details&id=' . $this->entityid, 'label' => _t('Order Information')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=comment-add&entity='.$this->entity.'&entityid=' .$this->entityid , 'label' => _t('Add new Comment')));

        if ($this->entityid < 0 || $this->entity != 'Saleorder_Model') {
            throw new Amhsoft_Item_Not_Found_Exception();
        }


        $auth = Amhsoft_Authentication::getInstance();
        $accountID = null;
        if ($auth->isAuthenticated()) {
            $accountID = $auth->getObject()->id;
        } else {
            Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=details&id=' . $this->entityid);
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }

        $saleOrderModelAdapter = new Saleorder_Model_Adapter();
        $saleOrderModelAdapter->where('account_id = ?', $accountID);
        $saleOrderModel = $saleOrderModelAdapter->fetchById($this->entityid);
        if (!$saleOrderModel instanceof Saleorder_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }




        $this->commentForm = new Comment_Form('commentForm_form', 'POST');
        $this->commentModel = new Comment_Model();
        $this->commentForm->removeByName('public');
        $this->getView()->setMessage(_t('Add new Comment'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->commentForm->isSend()) {
            if ($this->commentForm->isFormValid()) {

                $this->commentForm->DataBinding = $this->commentModel;
                $commentModelAdapter = new Comment_Model_Adapter();
                $this->commentModel = $this->commentForm->getDataBindItem();
                $this->commentModel->insertat = Amhsoft_Locale::UCTDateTime();
                $this->commentModel->setEntity($this->entity);
                $this->commentModel->setEntityId($this->entityid);
                $this->commentModel->setAuthor_name(Amhsoft_Authentication::getInstance()->getObject()->name);
                $this->commentModel->setPublic_seen(0);
                $this->commentModel->setPublic(1);
                $this->commentModel->setUser_seen(0);

                $commentModelAdapter->save($this->commentModel);
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
        if ($this->entity == 'Saleorder_Model') {
            $saleorderModelAdapter = new Saleorder_Model_Adapter();
            $saleorderModel = $saleorderModelAdapter->fetchById($this->entityid);
            if ($saleorderModel instanceof Saleorder_Model) {
                Saleorder_Notification_Model::notifyAdminCommentSubmitted($saleorderModel);
            }
        }

        Amhsoft_Navigator::go(Amhsoft_History::back(1));
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->commentForm);
        $this->show();
    }

}

?>