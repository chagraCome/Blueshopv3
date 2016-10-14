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
class Saleorder_Frontend_Comment_Details_Controller extends Amhsoft_System_Web_Controller {

    protected $comment_id;
    protected $commentModelAdapter;
    protected $commentModel;
    protected $accountModel;
    protected $saleorderCommentForm;
    protected $saleorder_id;
    protected $account_id;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->comment_id = $this->getRequest()->getInt('id');
        $this->saleorder_id = $this->getRequest()->getInt('saleorder');
        $this->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=index.php?module=saleorder&page=details&id=' . $this->saleorder_id, 'label' => _t('Order Information')))->setBreadCrumb(array('link' => 'index.php?module=saleorder&page=comment-details&id=' . $this->comment_id . '&saleorder=' . $this->saleorder_id, 'label' => _t('Comment Details')));

        if ($this->saleorder_id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        if (intval($this->comment_id) > 0) {
            $auth = Amhsoft_Authentication::getInstance();
            if ($auth->isAuthenticated()) {
                $this->accountModel = $auth->getObject();
                $this->account_id = $auth->getObject()->id;
            } else {
                Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=list');
                $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
            }
            $saleorderAdapter = new Saleorder_Model_Adapter();
            $saleorderModel = $saleorderAdapter->fetchById($this->saleorder_id);
            if ($saleorderModel->account_id != $this->account_id) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
            $this->commentModelAdapter = new Comment_Model_Adapter();
            $this->commentModel = $this->commentModelAdapter->fetchById($this->comment_id);
            if (!$this->commentModel instanceof Comment_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        if ($this->commentModel->public_seen != 1) {
            $this->commentModel->public_seen = 1;
            $this->commentModelAdapter->update($this->commentModel);
        }
    }

    /**
     * Default event
     */
    public function __default() {
        $commentReplayModel = new Comment_Reply_Model();
        $commentReplayModelAdapter = new Comment_Reply_Model_Adapter();
        $this->saleorderCommentForm = new Comment_Reply_Form('comment', "POST");
        $this->saleorderCommentForm->comment->Label = "";
        $this->saleorderCommentForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->saleorderCommentForm->isSend()) {
            if ($this->saleorderCommentForm->isValid()) {
                $this->saleorderCommentForm->DataBinding = $commentReplayModel;
                $commentReplayModel = $this->saleorderCommentForm->getDataBindItem();
                $commentReplayModel->setAuthor_name($this->accountModel->name);
                $commentReplayModel->setInsertat(Amhsoft_Locale::UCTDateTime());
                $commentReplayModel->comment_item_id = $this->commentModel->getId();
                $commentReplayModelAdapter->save($commentReplayModel);
                $this->getRedirector()->go(Amhsoft_History::back());
            } else {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        }
    }

    protected function getCommentReplays() {
        $commpentReplayAdapter = new Comment_Reply_Model_Adapter();
        $commpentReplayAdapter->where('comment_item_id = ?', $this->commentModel->getId());
        $commpentReplayAdapter->orderBy('id DESC');
        $replays = $commpentReplayAdapter->fetch();

        $this->getView()->assign('replays', $replays);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign("form", $this->saleorderCommentForm);
        $this->getView()->assign("comment", $this->commentModel);
        $this->getCommentReplays();
        $this->show();
    }

}

?>
