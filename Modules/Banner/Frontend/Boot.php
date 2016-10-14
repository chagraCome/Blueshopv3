<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    Banner
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 18:53:25
 */
class Modules_Banner_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $bannerConfiguration = new Amhsoft_Config_Table_Adapter('banner');
        $bannerState = $bannerConfiguration->getValue('main_banner_frontend_state', 0);
        $bannerSource = $bannerConfiguration->getValue('banner_source', 0);


        if ($bannerState == 0) {
            return;
        }
        if ($bannerSource == 1) {
            $bannerModelAdapter = new Banner_Model_Adapter();
            $bannerModelAdapter->where('state = 1');
            $bannerModelAdapter->orderBy('sortid, id DESC');
            $banners = $bannerModelAdapter->fetch();
            $system->getView()->assign('main_banners', $banners);
            $system->getView()->assign('mainBannerEffect', $bannerConfiguration->getValue('main_banner_frontend_transition_effect', 0));
        } elseif ($bannerSource == 2) {
            $productModelAdapter = new Product_Product_Model_Adapter();
            $productModelAdapter->where('online = 1 ');
            //$productModelAdapter->where('show_in_banner = 1 ');
            $products = $productModelAdapter->fetch();
            $banners = array();
            while ($product = $products->fetch()) {
                $banner = new Banner_Model();
                $banner->absolutepath = $product->getFirstBigAbsolute();
                $banner->setRemoteUrl($product->getUrl());
                $title = $product->getTitle() . "<br/>" . Amhsoft_Currency_Converter::tableConvert($product->getSalePrice(), Amhsoft_Common::GetCookie('current_currency')) . " " . Amhsoft_Common::GetCookie('current_currency');
                $banner->setName($title);
                $banners[] = $banner;
            }
        }
        $system->getView()->assign('main_banners', $banners);
        $bannerWidth = $bannerConfiguration->getValue('banner_width', 0);
        $bannerHeight = $bannerConfiguration->getValue('banner_height', 0);
        $system->getView()->assign('banner_width', $bannerWidth);
        $system->getView()->assign('banner_height', $bannerHeight);

        $system->getView()->assign('mainBannerEffect', $bannerConfiguration->getValue('main_banner_frontend_transition_effect', 0));
    }

}
