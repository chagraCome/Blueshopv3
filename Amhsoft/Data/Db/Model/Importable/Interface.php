<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Interface.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
interface Amhsoft_Data_Db_Model_Importable_Interface {

  public function getMessage(&$message = '');

  public function getAttributes($args = null);

  public function import(Amhsoft_Data_Db_Model_Interface $object, $args = array());

  public function onFinishImportCallBack();
  
  public function getObject();
  
  public function getDataGridView();
  
  public function getCachedData();
  
  public function doImport($models=array());
    
}

?>