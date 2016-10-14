<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Sitemap.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package  Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Product_Frontend_Sitemap_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize 
     */
    public function __initialize() {
        
    }

    /**
     * Default Event
     */
    public function __default() {
        $siteMap = new Amhsoft_Xml_Sitemap();
        $productModelAdapter = new Product_Product_Model_Adapter();
        $productModelAdapter->where('online = 1');
        $result = $productModelAdapter->fetch();
        while ($product = $result->fetch()) {
            $productLink = $product->getUrl();
            $productLink = str_replace(array('&arm', '&'), array('', ''), $productLink);
            $siteMap->addRow(new Amhsoft_Xml_Sitemap_Row($productLink, Amhsoft_Locale::UCTDateTime($product->getUpdateat())));
        }
        header('Content-Type: application/xml; charset=utf-8');


        echo $siteMap;
        exit;
    }

    /**
     * Final Event
     */
    public function __finalize() {
        
    }

}