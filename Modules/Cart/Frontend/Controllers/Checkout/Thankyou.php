<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Thankyou.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package Cart
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Cart_Frontend_Checkout_Thankyou_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize 
     */
    public function __initialize() {
        if (Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
            $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
            $cmsPageModelAdapter->fetchByAlias('cart.frontend.checkout.thankyou');
            $cmsPageModel = $cmsPageModelAdapter->fetch()->fetch();
            if ($cmsPageModel instanceof Cms_Page_Model) {
                $this->getView()->assign('page', $cmsPageModel);
            }
        }
    }

    /**
     * Default Event
     */
    public function __default() {
        
    }

    /**
     * Final Event
     */
    public function __finalize() {
        //show the view
        $this->show();
    }

}
