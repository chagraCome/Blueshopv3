<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Online.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Coupon_Backend_Online_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $couponModelAdapter = new Coupon_Model_Adapter();
            $couponModel = $couponModelAdapter->fetchById($id);
            if ($couponModel instanceof Coupon_Model) {
                $couponModel->setEnabled(1);
                $couponModelAdapter->save($couponModel);
                $this->getRedirector()->go('admin.php?module=coupon&page=list&ret=true');
            }
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