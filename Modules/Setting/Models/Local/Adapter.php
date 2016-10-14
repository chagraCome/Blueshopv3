<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Local_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

    /**
     * Model Adapter Construct
     */
    public function __construct() {
        $this->table = 'locale';
        $this->className = 'Setting_Local_Model';
        $this->map = array(
            'id' => 'id',
            'local' => 'local',
            'country_iso3' => 'country_iso3',
            'double_comma' => 'double_comma',
            'thousend_sep' => 'thousend_sep',
            'decimal_sep' => 'decimal_sep',
            'currency' => 'currency',
            'currency_iso3' => 'currency_iso3',
            'minor_unit' => 'minor_unit',
            'tel_code' => 'tel_code',
            'time_zone' => 'time_zone',
            'rate' => 'rate',
            'base' => 'base',
        );
        parent::__construct();
    }

    /**
     * Get Language Table Name
     * @return string
     */
    public function getLanguageTableName() {
        return 'locale_lang';
    }

    /**
     * Get Joint Column
     * @return string
     */
    public function getJoinColumn() {
        return 'locale_id';
    }

    /**
     * Get TLanguage Map
     * @return type
     */
    public function getLangMap() {
        return array(
            'country' => 'country',
            'language' => 'language',
            'currency_symbol' => 'currency_symbol',
            'currency_cent' => 'currency_cent',
        );
    }

    /**
     * Fetch Currency
     * @param type $currency
     * @return type
     */
    public function fetchCurrencyIso3($currency) {
        $adapter = new Setting_Local_Model_Adapter();
        $adapter->where('currency_iso3 = ?', $currency, PDO::PARAM_STR);
        return $adapter->fetch()->fetch();
    }

    /**
     * Get Local Id
     * @return type
     */
    public function getLastLocalId() {
        $adapter = new Setting_Local_Model_Adapter();
        $adapter->orderBy('id DESC');
        $adapter->limit(1);
        $model = $adapter->fetch()->fetch();
        if ($model instanceof Setting_Local_Model) {
            return $model->getId();
        }
    }

}

?>
