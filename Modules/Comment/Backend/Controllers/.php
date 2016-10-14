<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: .php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */
/**
 * Description of delete
 *
 * @author cherif
 */
class Comment_Backend_Delete extends Amhsoft_System_Web_Controller {

    public function __initialize() {
        $id = $this->getRequest()->getId();
        if($id > 0){
            $commentModelAdapter = new Comment_Model_Adapter();
            $commentModelAdapter->deleteById($id);
            $this->getRedirector()->go(Amhsoft_History::back().'&ret=true');
        }else{
            throw new Amhsoft_Item_Not_Found_Exception();
        }
    }

    public function __default() {
        
    }

    public function __finalize() {
        
    }

}

?>
