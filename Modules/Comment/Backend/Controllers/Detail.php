<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Detail.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Comment_Backend_Detail_Controller extends Amhsoft_System_Web_Controller {

  /** @var Comment_Model $commentModel * */
  public $commentModel;

  /** @var Comment_Model_Adapter $commentModelAdapter * */
  public $commentModelAdapter;

  /** @var Amhsoft_Widget_Panel $commentPanel * */
  public $commentPanel;

  /** @var Comment_Reply_Form $commentReplyForm  */
  public $commentReplyForm;
  public $id;

  /**
   * Initialize Controller
   * @throws Amhsoft_Item_Not_Found_Exception
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if ($this->id <= 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->commentModelAdapter = new Comment_Model_Adapter();
    $this->commentModel = $this->commentModelAdapter->fetchById($this->id);
    $this->commentModel->setUser_seen(true);
    $this->commentModelAdapter->save($this->commentModel);
    if (!$this->commentModel instanceof Comment_Model) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->commentPanel = new Amhsoft_Widget_Panel();
    $this->getView()->setMessage(_t('Comment Details'), View_Message_Type::INFO);
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->drawPanel();
    $this->drawReplyForm();
    $this->drawReplys();
  }

  /**
   * Draw Panel
   */
  protected function drawPanel() {
    $panel = new Comment_Panel(_t('Comment Details'));
    $panel->setLayout(new Amhsoft_Grid_Layout(1));
    $panel->DataSource = new Amhsoft_Data_Set($this->commentModel);
    $panel->Bind();
    if ($this->commentModel->entity == "Saleorder_Model" && Amhsoft_System_Module_Manager::isModuleInstalled("Saleorder")) {
      if (file_exists("media/payment/confirm/" . $this->commentModel->getId() . ".jpg")) {
	$imageLabel = new Amhsoft_ImageControl_Control("image", "media/payment/confirm/" . $this->commentModel->getId() . ".jpg");
	$panel->addComponent($imageLabel);
      }
    }
    $this->commentPanel->addComponent($panel);
  }

  /**
   * Draw Replay Form
   */
  protected function drawReplyForm() {
    $replyPanel = new Amhsoft_Widget_Panel(_t('Reply'));
    $this->commentReplyForm = new Comment_Reply_Form('comment', 'POST');
    $replyPanel->addComponent($this->commentReplyForm);
    $replyModel = new Comment_Reply_Model();
    $this->commentPanel->addComponent($replyPanel);
    if ($this->getRequest()->isPost('submit')) {
      if ($this->commentReplyForm->isFormValid()) {
	$this->commentReplyForm->DataBinding = $replyModel;
	$replyModel = $this->commentReplyForm->getDataBindItem();
	$replyModel->comment_item_id = $this->id;
	$replyModel->author_name = Amhsoft_Authentication::getInstance()->getObject()->username;
	$replyModel->setInsertat(Amhsoft_Locale::UCTDateTime());
	$replyModelAdapter = new Comment_Reply_Model_Adapter();
	$replyModelAdapter->save($replyModel);
	if ($this->commentModel->getEntity() == 'Saleorder_Model' && $this->commentModel->public) {
	  $saleorderModelAdapter = new Saleorder_Model_Adapter();
	  $saleorderModel = $saleorderModelAdapter->fetchById($this->commentModel->entity_id);
	  if ($saleorderModel instanceof Saleorder_Model) {
	    Saleorder_Notification_Model::notifyCustomerReplayCommentSubmitted($saleorderModel);
	  }
	}

	$this->getView()->setMessage(_t('Reply was successfully added'));
	$this->commentReplyForm->comment->Value = null;
	unset($_POST);
      }
    }
  }

  /**
   * Draw Reply
   */
  protected function drawReplys() {
    $replys = $this->commentModel->getReplys();
    foreach ($replys as $reply) {
      $panel = new Amhsoft_Widget_Panel(_t('Reply From') . ":" . $reply->author_name);
      $panel->setLayout(new Amhsoft_Grid_Layout(1));
      $commentLabel = new Amhsoft_Label_Control(_t('Comment '), new Amhsoft_Data_Binding('comment'));
      $panel->addComponent($commentLabel);
      $panel->addComponent(new Amhsoft_Date_Time_Label_Control(_t('Post Date'), new Amhsoft_Data_Binding('insertat')));
      $panel->addComponent(new Amhsoft_Label_Control(_t('Author'), new Amhsoft_Data_Binding('author_name')));
      $panel->DataSource = new Amhsoft_Data_Set($reply);
      $panel->Bind();
      $this->commentPanel->addComponent($panel);
    }
  }

  /**
   * Finalize Controller
   */
  public function __finalize() {
    $this->getView()->assign("widget", $this->commentPanel);
    $this->show();
  }

}

?>
