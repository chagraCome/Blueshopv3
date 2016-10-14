<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Backend_Menu_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Cms_Menu_DataGridView $cmsMenuDataGridView */
    protected $cmsMenuDataGridView;

    /** @var Cms_Menu_Model_Adapter $cmsMenuModelAdapter */
    protected $cmsMenuModelAdapter;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
        $this->cmsMenuDataGridView = new Cms_Menu_DataGridView();
        $this->cmsMenuDataGridView->onRowDraw->registerEvent($this, 'dataGridView_RowDraw_CallBack');
        $this->cmsMenuDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
        $this->cmsMenuDataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');

        $this->cmsMenuDataGridView->Sortable = true;
        $this->cmsMenuDataGridView->setWithPagination(true);
        $this->cmsMenuDataGridView->Searchable = true;
        $this->cmsMenuDataGridView->Draggable = true;
        $this->cmsMenuDataGridView->DragUrl = 'admin.php?module=cms&page=menu-list&event=sort';

        $this->cmsMenuModelAdapter->orderBy('sortid, id DESC');
        $this->getView()->setMessage(_t('List Menu Items'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->cmsMenuDataGridView->performSort($this->getRequest(), $this->cmsMenuModelAdapter);
        $this->cmsMenuDataGridView->performSearch($this->getRequest(), $this->cmsMenuModelAdapter);
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'product_category') {
            $adapter->leftJoin('product_category_lang', 'product_category_id', 'product_category_id');
            $adapter->orderBy("product_category_lang.name $sortOrder");
            return true;
        }
    }


  public static function onSearch_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, Amhsoft_Web_Request $req) {
    if ($colName == 'mainmenu') {
      $email = $req->get('mainmenu');
            $adapter->where("cms_menu_item_lang.title LIKE '%$accountName%'");
      return true;
    }
    
      if ($colName == 'mainmenu') {
      $email = $req->get('mainmenu');
            $adapter->where("cms_menu_item_lang.title LIKE '%$accountName%'");
      return true;
    }
  }
    /**
     * Finalize event
     */
    public function __finalize() {
        $menuId = $this->getRequest()->getInt('menuid');
        if ($menuId > 0) {
            $this->cmsMenuModelAdapter->where('parent_id= ?', $menuId, PDO::PARAM_INT);
        } else {
            $this->cmsMenuModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
        }
        $projects = $this->cmsMenuModelAdapter->fetch();
        $this->cmsMenuDataGridView->DataSource = new Amhsoft_Data_Set($projects);
        $this->getView()->assign('grid', $this->cmsMenuDataGridView);
        $this->show();
    }

    /**
     * DataGrid Drow Callback
     * @param type $colIndex
     * @param Amhsoft_Abstract_Control $sender
     * @param type $dataSource
     */
    public static function dataGridView_RowDraw_CallBack($colIndex, Amhsoft_Abstract_Control $sender, $dataSource) {
        if ($colIndex == 1 && $dataSource->hasChildrens()) {
            $sender->Value = '<a href="admin.php?module=cms&page=menu-list&menuid=' . $dataSource->id . '">' . $sender->Value . '</a>';
        }
    }

    /**
     * Sort Menu event
     */
    public function __sort() {
        $changes = false;
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE cms_menu_item SET sortid = $sortid WHERE id = $itemid");
                $changes = true;
            }
        }

        exit;
    }

}

?>
