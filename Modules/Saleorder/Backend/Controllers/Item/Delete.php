<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 398 2016-02-11 10:29:41Z amira.amhsoft $
 * $Rev: 398 $
 * @package    Saleorder
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-11 11:29:41 +0100 (jeu., 11 févr. 2016) $
 * $LastChangedDate: 2016-02-11 11:29:41 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

class Saleorder_Backend_Item_Delete_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $saleOrderItemModelAdapter = new Saleorder_Item_Model_Adapter();
            $model = $saleOrderItemModelAdapter->fetchById($id);
            if (!$model instanceof Saleorder_Item_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }

            $saleOrderItemModelAdapter->deleteById($id);

            Saleorder_Model::reCalculateAnsSavePricesId($model->sale_order_id);

            try {
                Product_Product_Model::liveIncrementQuantity(Amhsoft_Database::getInstance(), $model->item_id, $model->getQuantity());
                //$this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
            } catch (Exception $e) {
                Amhsoft_Log::error($e->getMessage());
            }
            $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
        } else {
            $this->getRedirector()->go(Amhsoft_History::back() . '&ret=false');
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
