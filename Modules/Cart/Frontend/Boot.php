<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 383 2016-02-10 14:43:34Z montassar.amhsoft $
 * $Revision: 383 $
 * $LastChangedDate: 2016-02-10 15:43:34 +0100 (mer., 10 févr. 2016) $
 * $LastChangedBy: montassar.amhsoft $
 * @package    Cart
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    05.12.2012 - 12:58:41
 * @encoding   UTF-8
 */
class Modules_Cart_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $system->getView()->assign('basket_text', _t('Your cart contains') . ' ' . Cart_Shoppingcart_Model::getInstance()->getProductsCount() . ' ' . _t('Item'), true);
        $system->getView()->assign('basket_count', Cart_Shoppingcart_Model::getInstance()->getProductsCount(), true);
        $system->getView()->assign('price_count', Cart_Shoppingcart_Model::getInstance()->getSubTotal(), true);
        $system->getView()->assign('products', Cart_Shoppingcart_Model::getInstance()->getProducts());
        $system->getView()->assign('cart_url', Cart_Shoppingcart_Model::getInstance()->getCheckoutUrl());
        
        $configurationTable = new Amhsoft_Config_Table_Adapter(Cart_Shoppingcart_Model::CONFIG_TABLE);
        $system->getView()->assign('checkout_without_registration',$configurationTable->getValue('allow_checkout_without_registration'));
    }

    /**
     * On Install Module
     * @param Amhsoft_System $system
     * @return boolean
     */
    public function onInstall(Amhsoft_System $system) {
        $sql_file = dirname(dirname(__FILE__)) . '/../Install/mysql.sql';
        try {
            $this->executeSQLFile($sql_file);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Table to Backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'shoppingcart',
            'shoppingcart_has_product',
        );
    }

}
