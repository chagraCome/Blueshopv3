<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Generate.php 125 2016-01-26 17:38:39Z montassar.amhsoft $
 * $Rev: 125 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 18:38:39 +0100 (mar., 26 janv. 2016) $
 * $Author: montassar.amhsoft $
 */
class Saleorder_Backend_Document_Generate_Controller extends Amhsoft_System_Web_Controller {

    public $id;

    /** @var SaleOrder_Model $model * */
    public $model;

    /** @var SaleOrder_Document_Model $documentModel * */
    public $documentModel;

    /**
     * Initialize event
     */
    public function __initialize() {

        $this->getView()->setMessage(_t('Generate a pdf document'), View_Message_Type::INFO);

        $this->id = $this->getRequest()->getId();
        if ($this->id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $adapter = new Saleorder_Model_Adapter();
        $this->model = $adapter->fetchById($this->id);

        if (!$this->model instanceof SaleOrder_Model) {
            throw new Amhsoft_File_Not_Found_Exception();
        }

        $this->generate();
    }

    public function generate() {
        $templateID = 1;

        $printTemplateAdapter = new Setting_Template_Print_Model_Adapter();
        $printTemplateModel = $printTemplateAdapter->fetchById($templateID);
        if (!$printTemplateModel instanceof Setting_Template_Print_Model) {
            return;
        }

        $content = $printTemplateModel->getFilledContent(array($this->model));

        $this->documentModel = new SaleOrder_Document_Model();
        $this->documentModel->setName($this->model->getNumber() . '-' . $this->model->getName() . '.pdf');
        $this->documentModel->setPublic($this->getRequest()->postInt('public'));
        $this->documentModel->setExtention("pdf");
        $this->documentModel->setType('Document');
        $this->documentModel->setFolder('media/saleorder/docs');

        $documentAdapter = new SaleOrder_Document_Model_Adapter();
        $documentAdapter->save($this->documentModel);
        if ($this->documentModel->getId() > 0) {
            if (!file_exists('media/saleorder/docs')) {
                mkdir('media/saleorder/docs', 0777, true);
            }
        }

        $filepath = $this->documentModel->getAbsolutePath();



        $http = new Amhsoft_Http();
        $http->setTarget("http://amhsoft.net/pdf-service/service.php");
        $http->setMethod("POST");
        $http->addParam('html_content', $content);
        $http->addParam('token', 'e2071d8d5f0215e1d0b73d3ce8694daee0c3ac84');
        $http->execute();
        $result = $http->getResult();

        @file_put_contents($filepath, $result);

        $saleorderModelAdapter = new SaleOrder_Model_Adapter();

        $this->model->addDocument($this->documentModel);

        $e = $saleorderModelAdapter->save($this->model);

        Amhsoft_Registry::destroy('print_template_id');

        $this->getRedirector()->go('admin.php?module=saleorder&page=saleorder-details&ret=true&id=' . $this->id);
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
        $this->show();
    }

}

?>
