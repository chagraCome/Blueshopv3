<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Loader.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
require_once 'Amhsoft/Libraries/Log.php';
require_once dirname(__FILE__) . '/Loader/Abstract.php';
require_once dirname(__FILE__) . '/Loader/Utility.php';
require_once dirname(__FILE__) . '/Loader/Module.php';
require_once dirname(__FILE__) . '/Loader/Controller.php';
require_once dirname(__FILE__) . '/Loader/Library.php';
require_once dirname(__FILE__) . '/Loader/Validator.php';
require_once dirname(__FILE__) . '/Loader/Control.php';
require_once dirname(__FILE__) . '/Loader/Model.php';
require_once dirname(__FILE__) . '/Loader/Form.php';
require_once dirname(__FILE__) . '/Loader/Grid.php';
require_once dirname(__FILE__) . '/Loader/Panel.php';
require_once dirname(__FILE__) . '/Loader/Layout.php';
require_once dirname(__FILE__) . '/Loader/ModelAdapter.php';
/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System_Boot_Loader extends Amhsoft_System_Boot_Loader_Abstract {

    public function __construct() {
        spl_autoload_register(array($this, 'loader'));
        Amhsoft_Log::info('system boot initialized');
    }

    public static function getLevel() {
        return self::$level;
    }

    public function loader($className) {
        Amhsoft_Log::info('try to load ' . $className);
        $file = str_replace('_', '/', $className) . '.php';

        if (@include_once $file) {
            return;
        }


        if (preg_match("/^(PHP|Symfony)/i", $className)) {
            return;
        }

        
        $args = explode('_', $className);
        if (isset($args[0]) && ($args[0] == 'Smarty' || $args[0] == 'PHPUnit' || $args[0] == 'Symfony'  || $args[0] == 'PHP' || preg_match("/^Slim/", $args[0]))) {
            return;
        }
        
        $end_args = end($args);

        if ($end_args == 'Model') {
            $laoder = new Amhsoft_System_Model_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Adapter' && $args[count($args) - 2] == 'Model') {
            $laoder = new Amhsoft_System_ModelAdapter_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Validator') {
            $laoder = new Amhsoft_System_Validators_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Control') {
            $laoder = new Amhsoft_System_Control_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Layout') {
            $laoder = new Amhsoft_System_Layout_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Utility') {
            $laoder = new Amhsoft_System_Utilities_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Form') {
            $laoder = new Amhsoft_System_Form_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'DataGridView') {
            $laoder = new Amhsoft_System_Grid_Loader($className);
            $laoder->boot();
        } elseif ($end_args == 'Panel') {
            $laoder = new Amhsoft_System_Panel_Loader($className);
            $laoder->boot();
        }
        elseif ($end_args == 'Controller') {
            $laoder = new Amhsoft_System_Controller_Loader($className);
            $laoder->boot();
        }
        else {
            $laoder = new Amhsoft_System_Libraries_Loader($className);
            $laoder->boot();
        }
    }

    public function initLoader() {
        //        $modules = array(
//            'User Management Module' => 'User',
//            'Cart Management Module' => 'Cart',
//            'Vehicle Management Module' => 'Vehicle',
//        );
//
//        foreach ($modules as $name => $moduleName) {
//            $loader = new Amhosft_Module_Loader($moduleName);
//            $loader->boot();
//        }
    }

    public function boot() {
        
    }

}

?>
