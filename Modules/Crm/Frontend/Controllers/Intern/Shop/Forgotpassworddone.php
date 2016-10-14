<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Forgotpassworddone.php 281 2016-02-03 09:14:06Z amira.amhsoft $
 * $Rev: 281 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-03 10:14:06 +0100 (mer., 03 févr. 2016) $
 * $Author: amira.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Forgotpassworddone_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-forgotpassword', 'label' => _t('Reset Password Success')));
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
