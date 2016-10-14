<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Module.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhosft_System_Module_Loader extends Amhsoft_System_Boot_Loader_Abstract {

    protected $moduleName;

    public function __construct($moduleName = null) {
        $this->moduleName = $moduleName;
    }

    private function getPath() {
        return 'Modules/' . $this->moduleName . '/' . Amhsoft_Boot_Loader::getLevel() . '/Boot.php';
    }

    public function boot() {
        require_once $this->getPath();
        $className = $this->moduleName . '_' . Amhsoft_Boot_Loader::getLevel() . '_Module';
        call_user_func('onInit', $className);
    }

}
?>
