<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_MainMenu_Model_Adapter extends Amhsoft_Data_Db_Model_Multilanguage_Adapter {

    /**
     * Model Adapter Construct 
     */
    public function __construct() {
        $this->table = 'cms_main_menu';
        $this->className = 'Cms_MainMenu_Model';
        $this->map = array(
            'id' => 'id',
            'state' => 'state',
            'cms_box_id' => 'cms_box_id'
        );
        parent::__construct();
    }

    public function getJoinColumn() {
        return 'cms_main_menu_id';
    }

    public function getLangMap() {
        return array("name" => "name");
    }

    public function getLanguageTableName() {
        return 'cms_main_menu_lang';
    }

}
