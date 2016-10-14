<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Eav_Backend_Attributeset_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Set_DataGridView $productSetDataGridView */
    protected $productSetDataGridView;

    /** @var Product_Set_Model_Adapter $productSetModelAdapter */
    protected $productSetModelAdapter;
    protected $entity;

    /**
     * Initialize Controller
     * @throws Exception
     */
    public function __initialize() {
        $this->entity_id = $this->getRequest()->getInt('entity');
        if ($this->entity_id <= 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        
        $this->productSetModelAdapter = new Eav_Set_Model_Adapter();
        $this->productSetModelAdapter->where('entity_id = ?', $this->entity_id);
        $this->productSetDataGridView = new Eav_Set_DataGridView();
        $this->productSetDataGridView->Sortable = true;
        $this->productSetDataGridView->Searchable = true;
        $this->productSetDataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
      //  $this->productSetDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');


        $this->productSetDataGridView->setWithPagination(true);
        $this->getView()->setMessage(_t('List Products Sets'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->productSetDataGridView->performSort($this->getRequest(), $this->productSetModelAdapter);
        $this->productSetDataGridView->performSearch($this->getRequest(), $this->productSetModelAdapter);
    }

       public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {

      if ($colName == 'name') {
      $accountName = $req->get('name');
      var_dump($accountName);
      exit;
      $adapter->leftJoin('cms_menu_item_lang', 'id', 'cms_menu_item_id');
      $adapter->where("cms_menu_item_lang.name LIKE '%$accountName%'");
      return true;
      }
      } 

  /*  public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
        if ($colName == 'name') {
            $email = $req->get('name');
            $adapter->leftJoin('cms_menu_item_lang', 'cms_menu_item_id', 'id');
            $adapter->where("cms_menu_item_lang.name LIKE '%$email%'");
            return true;
        }
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'name') {
            $adapter->leftJoin('cms_menu_item_lang', 'cms_menu_item_id', 'id');
            $adapter->orderBy("cms_menu_item_lang.name $sortOrder");
            return true;
        }
    }*/

    /**
     * Finalize event
     */
    public function __finalize() {
        $items = $this->productSetModelAdapter->fetch();
        $this->productSetDataGridView->DataSource = new Amhsoft_Data_Set($items);
        $this->getView()->assign('grid', $this->productSetDataGridView);
        $this->show();
    }

}

?>
