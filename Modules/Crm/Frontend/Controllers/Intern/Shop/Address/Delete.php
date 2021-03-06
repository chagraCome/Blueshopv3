<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Delete.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Crm_Frontend_Intern_Shop_Address_Delete_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $auth = Amhsoft_Authentication::getInstance();
        if (!$auth->isAuthenticated()) {
            $this->getRedirector()->go('index.php?module=crm&page=intern-shop-login');
        }
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $crmAddressModelAdapter = new Crm_Address_Model_Adapter();
            $crmAddressModelAdapter->where('account_id = ?', $auth->getObject()->id);
            $crmAddressModelAdapter->deleteById($id);
            $this->getRedirector()->go(Amhsoft_History::back() . '&ret=true');
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