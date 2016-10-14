<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 332 2016-02-04 16:18:02Z montassar.amhsoft $
 * $Rev: 332 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-04 17:18:02 +0100 (jeu., 04 févr. 2016) $
 * $LastChangedDate: 2016-02-04 17:18:02 +0100 (jeu., 04 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Modules_Default_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * onBoot event
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $this->shopOffline();
        if (Amhsoft_Debugger::isActive() == true) {
            $debugbarRenderer = Amhsoft_Debugger::getInstance()->getJavascriptRenderer()->setBaseUrl('3rdParty/src/DebugBar/Resources');
            $system->getView()->assign('debugbarRenderer', $debugbarRenderer);
        }

        $req = new Amhsoft_Web_Request();
        $available_lang = array_values($system->getAvailableLang());
        if ($req->isGet('lang') && in_array($req->get('lang'), $available_lang)) {
            Amhsoft_Common::SetCookie('current_lang', $req->get('lang'));
            if (Amhsoft_History::getLast()) {
                Amhsoft_Navigator::go(Amhsoft_History::getLast());
            } else {
                Amhsoft_Navigator::go('index.php');
            }
        }
        if ($req->isGet('locale') && in_array($req->get('locale'), Amhsoft_Locale::getAvailableLocal())) {
            Amhsoft_Common::SetCookie('current_local', $req->get('locale'));
            Amhsoft_Locale::setLocale($req->get('locale'));
            $localeInfo = Amhsoft_Locale::getLocalInfo();
            Amhsoft_Common::SetCookie('current_currency', $localeInfo['currency_iso3']);
            Amhsoft_Navigator::go(Amhsoft_History::getLast());
        }
        $system->getView()->assign('current_currency', Amhsoft_Locale::getCurrencySymbol());
        $system->getView()->assign('time_zone', Amhsoft_Locale::getTimeZone());
        $system->getView()->assign('current_currency_flag', 'Amhsoft/Ressources/Icons/flags/' . strtolower(Amhsoft_Locale::getCountryIso2()) . '.png');
        $system->getView()->assign('locales', $this->getEnabledCurrencies());
    }

    /**
     * shopOffline: check if shop is offline
     */
    protected function shopOffline() {
        $config = (boolean) Amhsoft_System_Config::getProperty('shop_offline');
        $offlineIp = Amhsoft_System_Config::getProperty('offline_ip');
        if ($config && Amhsoft_Common::GetClientIp() != $offlineIp) {
            $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
            $cmsPageModel = $cmsPageModelAdapter->fetchByAlias('frontend.default.shop.offline.page');
            if ($cmsPageModel instanceof Cms_Page_Model) {
                header('Content-Type: text/html; charset=utf-8');
                echo $cmsPageModel->getContent();
                exit;
            } else {
                header('Content-Type: text/html; charset=utf-8');
                echo _t('Shop is offline now please back later');
                exit;
            }
        }
    }

    /**
     * 
     * @return enabled Currencies
     */
    public function getEnabledCurrencies() {
        $allLocale = Amhsoft_Locale::getAll();
        $array = array();
        $enabled = Amhsoft_System_Config::getProperty('currency');
        foreach ($allLocale as $key => $local) {
            if ($enabled) {
                if (in_array($local['currency_iso3'], $enabled)) {
                    $array[] = array('locale' => $key, 'iso3' => $local['currency_iso3'], 'flag' => 'Amhsoft/Ressources/Icons/flags/' . strtolower($local['country_iso2']) . '.png', 'symbol' => $local['currency_symbol'], 'time_zone' => $local['time_zone']);
                }
            } else {
                $array[] = array('locale' => $key, 'iso3' => $local['currency_iso3'], 'flag' => 'Amhsoft/Ressources/Icons/flags/' . strtolower($local['country_iso2']) . '.png', 'symbol' => $local['currency_symbol'], 'time_zone' => $local['time_zone']);
            }
        }
        return $array;
    }

}

?>