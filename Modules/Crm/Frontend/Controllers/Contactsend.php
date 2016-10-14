<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Contactsend.php 348 2016-02-05 16:23:48Z imen.amhsoft $
 * $Rev: 348 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:23:48 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Contactsend_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=contactsend', 'label' => _t('Contact Form submitted')));
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
