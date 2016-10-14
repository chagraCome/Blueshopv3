<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Adapter.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Shipping
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Shipping_Country_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  /**
   * Model Adapter Construct
   */
  public function __construct() {
    $this->table = 'country';
    $this->className = 'Shipping_Country_Model';
    $this->map = array(
	'id' => 'id',
	'code' => 'code',
	'iso_code_2' => 'iso_code_2',
	'iso_code_3' => 'iso_code_3',
	'iso_country' => 'iso_country',
	'country' => 'country',
	'lat' => 'lat',
	'lon' => 'lon'
    );
    parent::__construct();
  }

}

?>
