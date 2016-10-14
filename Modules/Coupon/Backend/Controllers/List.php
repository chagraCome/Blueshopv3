<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of delete
 *
 * @author cherif
 */
class Coupon_Backend_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Coupon_DataGridView $couponDataGridView */
    protected $couponDataGridView;

    /** @var Coupon_Mode_Adapter $couponModeAdapter */
    protected $couponModeAdapter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponModeAdapter = new Coupon_Model_Adapter();
        $this->couponDataGridView = new Coupon_DataGridView();
        $this->couponDataGridView->Sortable = true;
        $this->couponDataGridView->Searchable = true;
        $this->couponDataGridView->setWithPagination(true);
        $this->couponDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');
        $this->couponDataGridView->onSearchColumn->registerEvent($this, 'DataGridView_SearchCol_CallBack');
        $this->couponModeAdapter->orderBy("id DESC");
        $this->getView()->setMessage(_t('List All Coupons'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->couponDataGridView->performSort($this->getRequest(), $this->couponModeAdapter);
        $this->couponDataGridView->performSearch($this->getRequest(), $this->couponModeAdapter);
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'type') {
            $adapter->leftJoin('coupon_type_lang', 'type_id', 'coupon_type_id');
            $adapter->orderBy("coupon_type_lang.name $sortOrder");
            return true;
        }
        if ($columName == 'user') {
            $adapter->leftJoin('user', 'user_id', 'id');
            $adapter->orderBy("user.username $sortOrder");
            return true;
        }
    }

    public function DataGridView_SearchCol_CallBack($colName, Amhsoft_Data_Db_Model_Adapter $adapter, $req) {
        if ($colName == 'user') {
            $user_id = $req->getInt($colName);
            if ($user_id > 0) {
                $adapter->where('coupon.user_id = ?', $user_id);
            }
            return true;
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $items = $this->couponModeAdapter->fetch();
        $this->couponDataGridView->DataSource = new Amhsoft_Data_Set($items);
        $this->getView()->assign('widget', $this->couponDataGridView);
        $this->show();
    }

}

?>