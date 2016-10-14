<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of detail
 *
 * @author cherif
 */
class Saleorder_Backend_Document_Detail_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id <= 0) {
            die('Access denied');
        }

        $documentModelAdapter = new Saleorder_Document_Model_Adapter();
        $document = $documentModelAdapter->fetchById($id);
        if ($document instanceof Saleorder_Document_Model) {
            Amhsoft_Common::force_download($document->getName() . '.' . $document->getExtention(), file_get_contents($document->getAbsolutePath()));
        } else {
            die('Document not found');
        }
        $this->getView()->setMessage(_t('Document Details'), View_Message_Type::INFO);
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
