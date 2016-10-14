<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Modules_Payment_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    public function onBoot(Amhsoft_System $system) {
        $paymentModelAdapter = new Payment_Payment_Model_Adapter();
        $paymentModelAdapter->where('online = 1');
        $paymentModelAdapter->orderBy('sortid ASC');

        $payments = $paymentModelAdapter->fetch()->fetchAll();
        $system->getView()->assign('payment_methods',$payments);
    }

}

?>
