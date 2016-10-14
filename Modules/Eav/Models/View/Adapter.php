<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Adapter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Eav_View_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

  public function __construct($table_name) {

    $this->table = $table_name . '_pivot_' . strtolower(Amhsoft_System::getCurrentLang());
    $this->className = 'Eav_View_Model';
    $this->map = array(
        'id' => 'id',
        'title' => 'title',
        'description' => 'description');

    //$this->defineMany2Many('documents', 'DocumentModel', 'product_has_document', 'product_id', 'document_id', false, true);
    $this->defineMany2Many('images', 'Product_Image_Model', 'product_has_image', 'product_id', 'image_id', false, false, 'sortid');
    //$this->defineOne2One('set', 'entity_set_id', 'Product_Set_Model');
    $this->defineOne2One('category', 'category_id', 'Product_Category_Model');
    parent::__construct();
  }

}

?>
