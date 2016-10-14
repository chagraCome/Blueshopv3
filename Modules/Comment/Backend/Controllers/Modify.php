<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Comment_Backend_Modify_Controller extends Amhsoft_System_Web_Controller {

  /** @var Comment_Form commentForm */
  protected $commentForm;

  /** @var Comment_Model commentModel */
  protected $commentModel;

  /**
   * Initialize Controler
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->commentForm = new Comment_Form('commentForm_form', 'POST');
    $this->getView()->setMessage(_t('Modify Comment'), View_Message_Type::INFO);
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      $commentModelAdapter = new Comment_Model_Adapter();
      $this->commentModel = $commentModelAdapter->fetchById($id);
    }
    if (!$this->commentModel instanceof Comment_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->commentForm->DataSource = new Amhsoft_Data_Set($this->commentModel);
    $this->commentForm->Bind();
  }

  /**
   * Default Event
   */
  public function __default() {
    if ($this->commentForm->isSend()) {
      $this->commentForm->DataSource = Amhsoft_Data_Source::Post();
      $this->commentForm->Bind();
      if ($this->commentForm->isValid()) {
	$this->commentForm->DataBinding = $this->commentModel;
	$commentModelAdapter = new Comment_Model_Adapter();
	$this->commentModel = $this->commentForm->getDataBindItem();
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
    $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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