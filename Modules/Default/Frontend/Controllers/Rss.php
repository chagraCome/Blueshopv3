<?php

header("Content-type: application/xml");
/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Rss.php 392 2016-02-10 17:05:13Z montassar.amhsoft $
 * $Rev: 392 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-10 18:05:13 +0100 (mer., 10 févr. 2016) $
 * $LastChangedDate: 2016-02-10 18:05:13 +0100 (mer., 10 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Default_Frontend_Rss_Controller extends Amhsoft_System_Web_Controller {

    public $configTableAdapter;

    /**
     * Initialize controller
     */
    public function __initialize() {
        
    }

    /**
     * Default event
     */
    public function __default() {
        $this->configTableAdapter = new Amhsoft_Config_Table_Adapter('config');
        $shopLink = Amhsoft_System_Config::getProperty('appurl');
        $shopName = Amhsoft_System_Config::getProperty('name');
        $shopDescription = Amhsoft_System_Config::getProperty('description');
        $rss2 = new Amhsoft_Xml_Rss2('Blueshop', $shopLink, $shopName);
        $rss2->setTitle(Amhsoft_System_Config::getProperty('name'));
        $rss2->setDescription($shopDescription);
        $rss2->setLanguage('ar-sa');
        $rss2->setPubDate(Amhsoft_Locale::UCTDateTime());
        $rss2->setImageUrl($this->configTableAdapter->getValue("shop_logo"));
        $rss2->setImageTitle(Amhsoft_System_Config::getProperty('name'));
        $rss2->setImageLink($this->configTableAdapter->getValue("shop_logo"));
        $productViewModelAdapter = new Product_Product_Model_Adapter();
        $productViewModelAdapter->orderBy('updateat DESC');
        $productViewModelAdapter->limit(50);
        $result = $productViewModelAdapter->fetch();
        $publisher = Amhsoft_System_Config::getProperty('name');
        while ($product = $result->fetch()) {
            $rss2->addRow(new Amhsoft_Xml_Rss2_Row($product->getTitle(), $product->getUrl(), $product->getId(), $publisher, Amhsoft_Locale::UCTDateTime($product->getUpdateat()), $product->getDescription()));
        }
        echo (string) $rss2;
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        
    }

}

?>