<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Model.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Import_Code_Model extends Amhsoft_Data_Import_Model implements Amhsoft_Data_Db_Model_Importable_Interface {

    public $data;

    public function __construct() {
        parent::__construct();
        $this->modelName = 'Coupon_Code_Model';
        $this->adapterName = 'Coupon_Code_Model_Adapter';
    }

    public function getRequired($form) {
        $this->data = parent::getRequired($form);
        return $this->data;
    }

    public function getDataGridView() {
        $dv = new Coupon_code_DataGridView();
        $dv->removeByIdentName('edit');
        $dv->removeByIdentName('delete');
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=importer&page=display&model=' . @$_GET['model'] . '&event=delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('import_index');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';

        $dv->addColum($delCol);

        return $dv;
    }

    public function doImport($models = array()) {
        $adapter = new $this->adapterName();
        foreach ($models as $model) {
            $model->insert_date_time = Amhsoft_Locale::UCTDateTime();
            $adapter->save($model);
        }
    }

}
