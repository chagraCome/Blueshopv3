<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_System_Panel_Loader  extends Amhsoft_System_Boot_Loader_Abstract {

    protected $className;

    public function __construct($className = null) {
        $this->className = $className;
    }

    public function getPath() {
        $args = explode('_', $this->className);
        $module = array_shift($args);
        return 'Modules/' . $module.'/Panels/'.implode('/', $args).'.php';
    }

    public function boot() {
        require_once $this->getPath();
    }

}
?>
