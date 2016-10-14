<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Image.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Backend_Image_Image_Controller extends Amhsoft_System_Web_Controller {

  /** @var Amhsoft_Widget_Panel $paymentImage */
  public $paymentImage;

  /** @var Payment_Payment_Model $paymentModel */
  public $paymentModel;

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->getView()->setMessage(_t('Create new Payment Method'), View_Message_Type::INFO);
    $this->paymentImage = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Create new Payment Method'), View_Message_Type::INFO);
    $id = $this->getRequest()->getInt('payment_id');
    if ($id < 0) {
      die('Payment Method not found');
    }
    $paymentModelAdapter = new Payment_Payment_Model_Adapter();
    $this->paymentModel = $paymentModelAdapter->fetchById($id);
    if (!$this->paymentModel instanceof Payment_Payment_Model) {
      die('Payment Method  not found');
    }
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Add Payment Method Image'), View_Message_Type::INFO);
    $this->setUpImagePanel();
  }

  /**
   * Set Image Panel
   */
  protected function setUpImagePanel() {
    $panelImage = new Amhsoft_Widget_Panel(_t('Payment Method Images'));
    $paymentImageDataGridView = new Payment_Image_DataGridView();
    $paymentImageDataGridView->DataSource = new Amhsoft_Data_Set($this->paymentModel->getImages());
    $panelImage->addComponent($paymentImageDataGridView);
    $addLink = new Amhsoft_Link_Control(_t('Add new Image'), 'admin.php?module=payment&page=image-add&payment_id=' . $this->getRequest()->getInt('payment_id'));
    $addLink->setClass('add');
    $panelImage->addComponent($addLink);
    $this->paymentImage->addComponent($panelImage);
  }

  /**
   * Finalize Event
   */
  public function __finalize() {
    $this->getView()->assign('panel', $this->paymentImage);
    $this->getView()->assign('product', $this->paymentModel);
    $this->show();
  }

}

?>
