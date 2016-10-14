<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Saleorder_Backend_Saleorder_Delete_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $saleOrderModelAdapter = new Saleorder_Model_Adapter();
            $saleModel = $saleOrderModelAdapter->fetchById($id);
            if (!$saleModel instanceof Saleorder_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }

            foreach ($saleModel->getItems() as $item) {
                if (intval($item->item_id) > 0) {
                    try {
                        Product_Product_Model::liveIncrementQuantity(Amhsoft_Database::getInstance(), $item->item_id, $item->quantity);
                    } catch (Exception $e) {
                        Amhsoft_Log::error($e->getMessage());
                    }
                }
            }

            $saleOrderModelAdapter->deleteById($id);

            $this->getRedirector()->go(Amhsoft_History::back(0) . '&ret=true');
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
