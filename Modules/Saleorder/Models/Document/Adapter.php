<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Saleorder
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */
class Saleorder_Document_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter{

public function __construct() {
    $this->table = 'document';
    $this->className = 'Saleorder_Document_Model';
    $this->map = array(
        'id' => 'id',
        'name' => 'name',
        'folder' => 'folder',
        'type' => 'type',
        'extention' => 'extention',
        'hash' => 'hash',
        'public' => 'public'
        );
    parent::__construct();
  }
  
  public function deleteById($id) {
      $model = $this->fetchById($id);
      $model->delete();
      parent::deleteById($id);
  }
}
?>
