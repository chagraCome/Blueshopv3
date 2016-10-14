<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: System.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangeDate: 2012-11-07 15:15:21 +0100 (Mi, 07 Nov 2012) $
 * $Author: a.cherif $
 */
require_once 'System/Boot/Loader.php';
require_once 'Libraries/Common.php';


/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_System {

  /** @var Amhsoft_System_Rooting_Abstract $rooter */
  private $rooter;
  private static $level = 'Frontend';
  private static $layout;
  private static $skin = 'Default';
  private static $default_lang = 'ar';
  private static $available_lang = array('English' => 'en', 'عربي' => 'ar');
  private static $virtualization = false;

  /** @var Amhsoft_View_Layout_Page $layougtManager */
  private $layoutManager;

  /** @var Amhsoft_Widget_Menu_Container $menuContainer */
  private $menuContainer;
  private $toolbarContainer = array();
  private static $translation = array();
  private $modules = array();
  private $rbac_collection;
  private static $registerdModels = array();
  private static $importableModels = array();
  private static $current_lang = NULL;
  private $controller;

  public function __construct() {
    $bootLoader = new Amhsoft_System_Boot_Loader();
    $bootLoader->initLoader();
    Amhsoft_Session::setAdapter(new Amhsoft_Session_DB_Adapter());
    $this->menuContainer = new Amhsoft_Widget_Menu_Container();
    $this->rooter = new Amhsoft_System_Rooting_Web_Rooter();
    $this->initSystemTranslation();
    //$this->bootView();
  }

  public function initSystemTranslation() {
    $frameWorkLang = 'Amhsoft/I18N/' . strtolower($this->getCurrentLang()) . '.ini';
    if (@file_exists($frameWorkLang)) {
      $systemLang = new Amhsoft_Config_Ini_Adapter($frameWorkLang);
      $this->appendToTranslation($systemLang->getConfiguration());
    }
    $frameWorkPoLang = 'Amhsoft/I18N/' . strtolower($this->getCurrentLang()) . '.po';
    if (@file_exists($frameWorkPoLang)) {
      $systemLang = new Amhsoft_Config_Po_Adapter($frameWorkPoLang);
      $this->appendToTranslation($systemLang->getConfiguration());
    }

    $globalLang = 'I18N/' . strtolower($this->getCurrentLang()) . '.ini';
    if (@file_exists($globalLang)) {
      $globalLang = new Amhsoft_Config_Ini_Adapter($globalLang);
      $this->appendToTranslation($globalLang->getConfiguration());
    }

    $globalLang = 'I18N/' . strtolower($this->getCurrentLang()) . '.po';
    if (@file_exists($globalLang)) {
      $globalLang = new Amhsoft_Config_Po_Adapter($globalLang);
      $this->appendToTranslation($globalLang->getConfiguration());
    }
  }

  public static function setAvailableLang(array $array) {
    self::$available_lang = $array;
  }

  public function registerRBACRule(Amhsoft_RBAC_Rule $rule) {
    Amhsoft_RBAC_Rule_Manager::addRule($rule);
  }

  public static function getAvailableLang() {
    return self::$available_lang;
  }

  public function addLang($symbol, $lang) {
    self::$available_lang[$lang] = $symbol;
  }

  public function removeLang($lang) {
    $index = array_search($lang, self::$available_lang);
    if ($index) {
      unset(self::$available_lang[$index]);
    }
  }

  public static function publishModel($modelClass, $alias, $attributes = array()) {
    if (empty($attributes)) {
      $class_attrs = array_keys(get_class_vars($modelClass));
      $attributes = array();
      foreach ($class_attrs as $attr) {
        $attributes[$modelClass . '::' . $attr] = $alias . '::' . $attr;
      }
    }
    self::$registerdModels[$modelClass] = array($alias => $attributes);
  }

  public static function publishForImport($modelClass, $alias) {
    if (class_implements($modelClass, 'Amhsoft_Data_Db_Model_Importable_Interface')) {
      self::$importableModels[$modelClass] = $alias;
    } else {
      throw new Exception('model does not implements Amhsoft_Data_Db_Model_Importable_Interface');
    }
  }

  public static function getImportableModels() {
    return self::$importableModels;
  }

  public static function getPublishedModels() {
    return self::$registerdModels;
  }

  public static function setCurrentLang($lang) {
    self::$default_lang = $lang;
  }

  public static function getCurrentLang() {

    if (NULL !== self::$current_lang) {
      return self::$current_lang;
    }

    $lang = Amhsoft_Common::GetCookie('current_lang', 'en');
    if (!$lang) {
      return self::$current_lang = self::$default_lang;
    }
    if (in_array($lang, array_values(self::$available_lang))) {
      return self::$current_lang = $lang;
    } else {
      return self::$current_lang = self::$default_lang;
    }
  }

  public static function setVirtualization($bool) {
    self::$virtualization = $bool;
  }

  public static function getVirtualization() {
    return self::$virtualization;
  }

  public function getLoadedModules() {
    return $this->modules;
  }

  /**
   * Gets Menu Container
   * @return Amhsoft_Widget_Menu_Container
   */
  public function getMenuContainer() {
    return $this->menuContainer;
  }

  public function getToolBarContainer() {
    return $this->toolbarContainer;
  }

  public function getRooter() {
    return $this->rooter;
  }

  public static function setLevel($level) {
    self::$level = $level;
  }

  public function getRedirector() {
    return new Amhsoft_Navigator();
  }

  public static function setLayout($layout) {
    self::$layout = $layout;
  }

  public static function setSkin($skin) {
    self::$skin = $skin;
  }

  public static function getLevel() {
    return self::$level;
  }

  public static function getLayout() {
    return self::$layout;
  }

  public static function getSkin() {
    return self::$skin;
  }

  public function getView() {
    return Amhsoft_View::getInstance();
  }

  public function getControllerName() {
    return $this->rooter->getRoot();
  }

  public static function isTranslationCachingEnabled(){
    return Amhsoft_System_Config::getProperty('translation_caching', 0);
  }
  
  public static function getTranslator() {
    if (self::isTranslationCached() && self::isTranslationCachingEnabled()) {
      $string_data = file_get_contents('cache/tr.' . self::getCurrentLang());
      self::$translation = unserialize($string_data);
    }
    return self::$translation;
  }

  public static function runCache() {
    
    if(!self::isTranslationCachingEnabled()){
      @unlink('cache/tr.' . self::getCurrentLang());
      return;
    }
    
    if (!Amhsoft_System::isTranslationCached()) {
      file_put_contents('cache/tr.' . self::getCurrentLang(), serialize(array_unique(self::$translation)));
    }
  }

  public function appendToTranslation($array) {
    self::$translation = array_merge((array) $array, self::$translation);
    //self::$translation += (array)$array;
  }

  public function getSystemConfiguration() {
    return Amhsoft_System_Config::getInstance();
  }

  public function bootView() {
    if (self::getLevel() == "Frontend" || self::getLevel() == "DealerLevel") {
      $this->layoutManager = new Amhsoft_View_Layout_Page();
    }
    $view = Amhsoft_View::getInstance();
    $view->setAdapter(new Amhsoft_View_Smarty_Adapter());
    $view->setViewDir('.');
    $view->setLayout(self::$layout);
    $view->setSkin(self::$skin);
    $view->compile_dir = 'cache/' . self::getLevel();
   
    $view->compile_check = Amhsoft_System_Config::getProperty('smarty_compile_check', 1);
    $view->force_compile = Amhsoft_System_Config::getProperty('smarty_compile_check', 1);
  }

  public function getChannel() {
    $root = $this->getRooter()->getRoot();
    $root = strtolower($root);
    $channel = str_replace("_", '.', $root);
    $event = Amhsoft_Web_Request::isGet('event') ? Amhsoft_Web_Request::get('event') : 'default';
    if (preg_match("/^[a-zA-Z0-9_]*$/i", $event)) {
      $channel = str_replace('.controller', '.' . $event, $channel);
    }
    return $channel;
  }

  /** @var Amhsoft_View_Layout_Page layoutmanager */
  public function getLayoutManager() {
    return $this->layoutManager;
  }

  public function moduleExists($moduleName) {
    return in_array($moduleName, $this->modules);
  }

  public static function isCached() {
    return Amhsoft_View::getInstance()->isCached('index.tpl.html');
  }

  private function bootController() {

   
    $className = $this->rooter->getRoot();

    $allowOnlyFormAdmin = $this->getSystemConfiguration()->getProperty('allow_only_for_admin', array());
    if (!empty($allowOnlyFormAdmin)) {
      if (in_array($className, $allowOnlyFormAdmin) || in_array($this->getChannel(), $allowOnlyFormAdmin)) {
        if (!Amhsoft_Authentication::getInstance()->getObject()->admin) {
          throw new Amhsoft_Permission_Denied_Exception();
        }
      }
    }


    if ($this->moduleExists('Workflow')) {
      Amhsoft_WorkFlow::observe();
    }


    if (!class_exists($className)) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }


    $this->controller = new $className();
    $this->controller->setChannel($this->getChannel());


    Amhsoft_System_Boot_Event_Handler::trigger('before.boot.controller', $this);

    $webResponce = new Amhsoft_Web_Responce();

    $event = $webResponce->get('event') ? '__' . $webResponce->get('event') : '__default';
    $this->controller->__initialize($this, $webResponce);

    if (method_exists($this->controller, $event)) {
      $this->controller->{$event}($this, $webResponce);
    } else {
      throw new Amhsoft_Item_Not_Found_Exception();
    }

    $this->controller->__finalize($this);


    return $this->controller;
  }

  public function getController() {
    return $this->controller;
  }

  protected function bootModules() {


    $directoryIterator = new DirectoryIterator('Modules');

    foreach ($directoryIterator as $dir) {
      if ($dir->isDir() && !$dir->isDot()) {
        if (file_exists('Modules/' . $dir->getBasename() . '/' . self::getLevel() . '/Boot.php')) {
          if ($dir->getBasename() == 'Default' || $dir->getBasename() == 'Installer' || $dir->getBasename() == 'Cg' || Amhsoft_System_Module_Manager::isModuleInstalled($dir->getBasename())) {
            $this->modules[] = $dir->getBasename();
          }
        }
      }
    }


    if (file_exists('Modules/Cart/' . self::getLevel() . '/Boot.php')) {
      $this->modules[] = 'Cart';
    }

    foreach ($this->modules as $module) {
      $class = 'Modules_' . $module . '_' . self::getLevel() . '_Boot';
      $object = new $class;
      $object->initTranslation($this, $module);
      $object->initRBAC($this);
      $object->onBoot($this);
      if (self::getLevel() != 'Frontend') {
        $object->onInitMenuContainer($this);
        $object->onInitToolBarContainer($this);
      }
    }
  }

  protected function bootPlugins() {
    $plugindirs = $this->getSystemConfiguration()->getProperty('plugindir', array());
    foreach ($plugindirs as $plugindir) {
      $plugindir = rtrim($plugindir, "/\\") . "/" . $this->getLevel();

      if (is_dir($plugindir)) {

        $directoryIterator = new DirectoryIterator($plugindir);
        foreach ($directoryIterator as $dir) {
          if ($dir->isFile()) {
            require_once $dir->getPathname();
            $plugin = $dir->getBasename('.plugin.php');
            new $plugin;
          }
        }
      }
    }
  }

  public function getGrouppedMenus($file) {
    if (!file_exists($file)) {
      return array();
    }
    $grouppedMenu = array();
    $container = clone $this->getMenuContainer();
    $conf = new Amhsoft_Config_Xml_Adapter($file);
    foreach ($conf->getConfiguration()->adminmenu->group as $grp) {
      foreach ($grp->modules->module as $module) {
        $menuBar = $container->removeMenuByName((string) $module);
        if ($menuBar) {
          $grouppedMenu[(string) $grp->name][$menuBar->getLabel()] = $menuBar;
        }
      }
    }
    if (count($container->getMenus()) > 0) {
      $grouppedMenu[_t('Miscellaneous')] = $container->getMenus();
    }
    $this->getView()->assign('multimenu', $grouppedMenu);
    return $grouppedMenu;
  }

  public function boot() {

    $this->bootView();
    $this->bootPlugins();
 
    Amhsoft_System_Boot_Event_Handler::trigger('before.boot', $this);
    $this->bootModules();
    Amhsoft_System_Boot_Event_Handler::trigger('boot', $this);
    $this->getView()->assign('current_lang', Amhsoft_System::getCurrentLang());
    $this->getView()->assign('available_lang', Amhsoft_System::getAvailableLang());
    
    if (self::getLevel() != 'Frontend') {
      $this->menuContainer->applyMenuCssStyle('menu_left');
      $this->menuContainer->applyLabelCssStyle('toggler');
      $this->getView()->assign('menucontainer', $this->menuContainer->getMenus());
      $this->getGrouppedMenus('Design/'.self::getLevel().'/' . self::getLayout() . '/adminmenu.xml');
    }
     
    Amhsoft_System::runCache();
    return $this->bootController();
  }

  public static function isTranslationCached() {
    return file_exists('cache/tr.' . self::getCurrentLang());
  }

}

function _t($x, $args = array()) {

  $translation = Amhsoft_System::getTranslator();
  if (is_array($x)) {
    $array = array();
    foreach ($x as $word) {
      if (isset($translation[$word])) {
        if (!empty($args)) {
          return vsprintf($translation[$word], $args);
        } else {
          $array[] = $translation[$word];
        }
      } elseif (!empty($args)) {
        return vsprintf($translation[$word], $args);
      } else {
        $array[] = $word;
      }
    }
    return $array;
  }
  if (isset($translation[$x])) {
    if (!empty($args)) {
      return vsprintf($translation[$x], $args);
    } else {
      return $translation[$x];
    }
  }

  if (!empty($args)) {
    return @vsprintf($x, (array) $args);
  } else {
    return $x;
  }
}

class Amhsoft_Exception extends Exception {
  
}

class Amhsoft_Item_Not_Found_Exception extends Amhsoft_Exception {

  public function __construct($message = null, $code = 0, Exception $previous = null) {
    Amhsoft_Navigator::error_404();
    parent::__construct($message, $code, $previous);
  }

}

class Amhsoft_NoEnougthQuantity_Exception extends Amhsoft_Exception {
  
}

class Amhsoft_Permission_Denied_Exception extends Amhsoft_Exception {

  public function __construct($message = null, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
    Amhsoft_Navigator::go('?module=default&page=nopermission');
  }

}

class Amhsoft_Illigal_Controller_Exception extends Amhsoft_Exception {
  
}

class Amhsoft_File_Not_Found_Exception extends Amhsoft_Exception {
  
}

class Product_NoEnougthQuantity_Exception extends Amhsoft_Exception {
  
}

class Product_Not_Available_Exception extends Amhsoft_Exception {
  
}

function myErrorHandler($fehlercode, $fehlertext, $fehlerdatei, $fehlerzeile) {
  switch ($fehlercode) {

    case E_USER_ERROR:
      Amhsoft_Log::error($fehlertext, array($fehlercode, 'file' => $fehlerdatei, 'line' => $fehlerzeile));
//die( 'User Error: ' . $fehlertext . ' ' . $fehlerdatei . ' Line: ' . $fehlerzeile);
      break;

    case E_USER_WARNING:
      Amhsoft_Log::error($fehlertext, array('Warning', 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;

    case E_USER_NOTICE:
      Amhsoft_Log::warn($fehlertext, array('Notice', 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;


    case E_ERROR:
    case E_WARNING:
    case E_COMPILE_WARNING:
//echo ( 'E_Error: ' . $fehlertext . ' ' . $fehlerdatei . ' Line: ' . $fehlerzeile);
      Amhsoft_Log::warn($fehlertext, array($fehlercode, 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;

    case E_NOTICE:
      Amhsoft_Log::warn($fehlertext, array($fehlercode, 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;

    case E_STRICT:
      Amhsoft_Log::warn($fehlertext, array($fehlercode, 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;


    default:
      die('Error: ' . $fehlertext . ' ' . $fehlerdatei . ' Line: ' . $fehlerzeile);
      Amhsoft_Log::error($fehlertext, array($fehlercode, 'file' => $fehlerdatei, 'line' => $fehlerzeile));
      break;
  }

  /* Damit die PHP-interne Fehlerbehandlung nicht ausgeführt wird */
  return true;
}

//set_error_handler('myErrorHandler');
?>
