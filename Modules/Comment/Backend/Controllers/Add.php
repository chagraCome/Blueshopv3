<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Comment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Comment_Backend_Add_Controller extends Amhsoft_System_Web_Controller {

  /** @var Comment_Form commentForm */
  protected $commentForm;

  /** @var Comment_Model commentModel */
  protected $commentModel;
  protected $entity;
  protected $entityid;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->entity = $this->getRequest()->get('entity');
    $this->entityid = $this->getRequest()->getInt('entityid');
    if ($this->entityid < 0 || !$this->entity) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->commentForm = new Comment_Form('commentForm_form', 'POST');
    $this->commentModel = new Comment_Model();
    $this->getView()->setMessage(_t('Add new Comment'), View_Message_Type::INFO);
  }

  /**
   * Default Event
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
	$this->commentModel->setAuthor_name(Amhsoft_Authentication::getInstance()->getObject()->username);
	$this->commentModel->setPublic_seen(0);
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
    if ($this->commentModel->entity == 'Quotation_Model' && $this->commentModel->public) {
      $quotationModelAdapter = new Quotation_Model_Adapter();
      $quotationModel = $quotationModelAdapter->fetchById($this->commentModel->entity_id);
      if ($quotationModel instanceof Quotation_Model) {
	Quotation_Notification_Model::notifiyCustomerQuotationCommentSubmitted($quotationModel);
      }
    }
    if ($this->commentModel->entity == 'Saleorder_Model' && $this->commentModel->public) {
      $saleorderModelAdapter = new Saleorder_Model_Adapter();
      $saleorderModel = $saleorderModelAdapter->fetchById($this->commentModel->entity_id);
      if ($saleorderModel instanceof Saleorder_Model) {
	Saleorder_Notification_Model::notifyCustomerCommentSubmitted($saleorderModel);
      }
    }
    Amhsoft_Navigator::go(Amhsoft_History::back(1) . '&ret=true');
  }

  /**
   * Finalize Controller
   */
  public function __finalize() {
    $this->getView()->assign('widget', $this->commentForm);
    $this->show();
  }

}

?>