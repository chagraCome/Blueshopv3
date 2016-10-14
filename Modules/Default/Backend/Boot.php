<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Modules_Default_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * onBoot event
   * @param Amhsoft_System $system
   */
  public function onBoot(Amhsoft_System $system) {
    $system->getMenuContainer()->findMenuByName('Setting')
	    ->AddItem(new Amhsoft_Widget_Menu_Item(_t('Dashboard'), "admin.php?module=default&page=portlet-list"));
    $req = new Amhsoft_Web_Request();
    $available_lang = array_values($system->getAvailableLang());
    $available_currencies = Amhsoft_Locale::getCurrencyIsoAsArray();
    $system->getView()->assign('available_currencies', $available_currencies);
    if ($req->isGet('lang') /* && in_array($req->get('lang'), $available_lang) */) {
      $currentLang = Amhsoft_Common::GetCookie('current_lang');
      unset($_COOKIE['current_lang']);
      Amhsoft_Common::SetCookie('current_lang', $req->get('lang'));
      Amhsoft_Navigator::go(Amhsoft_History::getLast());
    }
    if ($req->isGet('currency') && in_array($req->get('currency'), $available_currencies)) {
      $userConfTable = 'default_user_' . Amhsoft_Authentication::getInstance()->getObject()->id;
      $settingsUser = new Amhsoft_Config_Table_Adapter($userConfTable);
      $settingsUser->setValue('current_currency', $req->get('currency'));
      Amhsoft_Common::SetCookie('current_currency', $req->get('currency'));
      Amhsoft_Locale::initLocalFromSession();
      Amhsoft_Navigator::go(Amhsoft_History::getLast());
    }
    $system->getView()->assign('current_currency', Amhsoft_Registry::get('current_currency'));
  }

  /**
   * Translation event
   * @param Amhsoft_System $system
   */
  public function initTranslation(Amhsoft_System $system) {
    $filename = 'Modules/Default/I18N/' . strtolower($system->getCurrentLang()) . '.po';
    if (file_exists($filename)) {
      $arabic = new Amhsoft_Config_Po_Adapter($filename);
      $system->appendToTranslation($arabic->getConfiguration());
    }
  }

  /**
   * onInstall event
   * @param Amhsoft_System $system
   * @return boolean
   */
  public function onInstall(Amhsoft_System $system) {
    $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
    try {
      $this->executeSQLFile($file);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

}

?>
