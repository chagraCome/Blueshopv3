<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Controller.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_System_Controller_Loader extends Amhsoft_System_Boot_Loader_Abstract {

  protected $className;

  public function __construct($className) {
    $this->className = $className;
  }

  public function getPath() {
    //User_Backend_Customer_Add_Controller
    $args = explode('_', $this->className);
    $module = array_shift($args);
    $level = array_shift($args);
    array_pop($args);
    if (file_exists('Modules/' . $module . '/' . $level . '/Controllers/Override/' . implode('/', $args) . '.php')) {
      return 'Modules/' . $module . '/' . $level . '/Controllers/Override/' . implode('/', $args) . '.php';
      
    } else if (file_exists('Design/'.Amhsoft_System::getLevel().'/'.Amhsoft_System::getLayout() .'/Modules/'. $module . '/' .$level. '/Controllers/' . implode('/', $args) . '.php')) {
      return 'Design/'.Amhsoft_System::getLevel().'/'.Amhsoft_System::getLayout() .'/Modules/'. $module . '/' .$level. '/Controllers/' . implode('/', $args) . '.php';
    } else {
      return 'Modules/' . $module . '/' . $level . '/Controllers/' . implode('/', $args) . '.php';
    }
  }

  public function boot() {
    $path = $this->getPath();
    if (file_exists($path)) {
      require_once $path;
    } else {
      Amhsoft_Navigator::error_404();
    }
  }

}

?>
