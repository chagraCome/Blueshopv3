<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of add
 *
 * @author cherif
 */
class Saleorder_Backend_Document_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var DocumentForm $documentForm */
    protected $documentForm;

    /** @var DocumentModel $documentModel */
    protected $documentModel;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->documentForm = new Saleorder_Document_Form('project_document_form', 'POST');
        $this->getView()->setMessage(_t('Add a new Document'), View_Message_Type::INFO);

        $this->documentModel = new Saleorder_Document_Model();
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->documentForm->isSend()) {
            if ($this->documentForm->isValid()) {
                $this->documentForm->DataBinding = $this->documentModel;
                $this->documentForm->Bind();
                $this->documentModel->setFolder('media/saleorder/docs');
                $this->documentModel->setExtention($this->documentForm->documentfileInput->getExtention());
                $this->documentModel = $this->documentForm->getDataBindItem();
                $documentModelAdapter = new Saleorder_Document_Model_Adapter();
                $documentModelAdapter->save($this->documentModel);
                $saleorderModelAdapter = new Saleorder_Model_Adapter();
                $saleorderModel = $saleorderModelAdapter->fetchById($this->getRequest()->getInt('sale_order_id'));

                if ($saleorderModel instanceof Saleorder_Model) {
                    $saleorderModel->addDocument($this->documentModel);
                }
                $e = $saleorderModelAdapter->save($saleorderModel);

                if ($e) {
                    try {
                        $this->documentModel->uploadFromTemp($this->documentForm->documentfileInput->Value);
                        $this->close();
                    } catch (Exception $e) {
                        $this->getView()->setMessage($e->getMessage());
                    }
                }
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    public function uploadfile() {
        
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('form', $this->documentForm);
        $this->popup();
    }

}

?>
