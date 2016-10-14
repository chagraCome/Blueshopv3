<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Detail.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Saleorder_Frontend_Document_Detail_Controller extends Amhsoft_System_Web_Controller {

    protected $account_id;
    protected $saleorder_id;

    /**
     * Initialize event
     */
    public function __initialize() {
        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $this->account_id = $auth->getObject()->id;
        } else {
            Amhsoft_Registry::register('after_login', 'index.php?module=saleorder&page=list');
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }

        $id = $this->getRequest()->getId();
        if ($id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->saleorder_id = $this->getRequest()->getInt('saleorder');
        if ($this->saleorder_id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $saleorderAdapter = new Saleorder_Model_Adapter();
        $saleorderModel = $saleorderAdapter->fetchById($this->saleorder_id);
        if ($saleorderModel->account_id != $this->account_id) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $documentModelAdapter = new Saleorder_Document_Model_Adapter();
        $document = $documentModelAdapter->fetchById($id);
        if ($document instanceof Saleorder_Document_Model && $document->public == 1) {
            Amhsoft_Common::force_download($document->getName() . '.' . $document->getExtention(), file_get_contents($document->getAbsolutePath()));
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
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
        
    }

}

?>
