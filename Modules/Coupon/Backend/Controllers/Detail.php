<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Detail.php 362 2016-02-09 14:51:35Z imen.amhsoft $
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
class Coupon_Backend_Detail_Controller extends Amhsoft_System_Web_Controller {

    public $couponModel;
    public $couponPanel;
    public $dataGridView;
    public $adapter;

    /**
     * Initialize event
     */
    public function __initialize() {


        $id = $this->getRequest()->getId();
        $this->couponPanel = new Amhsoft_Widget_Panel();
        if ($id > 0) {
            $couponModelAdapter = new Coupon_Model_Adapter();
            $this->couponModel = $couponModelAdapter->fetchById($id);
            if (!$this->couponModel instanceof Coupon_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }



        $couponPanel = new Coupon_Panel(_t('General Informations'));
        $this->couponPanel->addComponent($couponPanel);
        $this->getView()->setMessage(_t('Coupon Details'), View_Message_Type::INFO);
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getCouponCodes();
    }

    public function getCouponCodes() {
        $panel = new Amhsoft_Widget_Panel(_t('Coupon Codes'));
        $this->adapter = new Coupon_Code_Model_Adapter();
        $this->adapter->where('coupon_id = ?', $this->couponModel->getId());
        $this->dataGridView = new Coupon_Code_DataGridView();
//        $this->dataGridView->onSearchColumn->registerEvent($this, 'onSearch_CallBack');
        $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->adapter);
        $this->dataGridView->Searchable = true;
        $this->dataGridView->Sortable = true;
        $this->dataGridView->performSearch($this->getRequest(), $this->adapter);
        $this->dataGridView->performSort($this->getRequest(), $this->adapter);
        $this->dataGridView->isWithPagination();
        $this->dataGridView->setWithPagination(true);




        $addLink = new Amhsoft_Link_Control(_t('Add New Coupon Code'), '?module=coupon&page=code-add&coupon_id=' . $this->couponModel->getId());
        $addLink->setClass('add');

        $generateLink = new Amhsoft_Link_Control(_t('Generate Coupon Codes'), '?module=coupon&page=code-generate&coupon_id=' . $this->couponModel->getId());
        $generateLink->setClass('add');

        $downloadLink = new Amhsoft_Link_Control(_t('Download As Csv'), '?module=coupon&page=detail&event=downloadcsv&id=' . $this->couponModel->getId());
        $downloadLink->setClass('details');

        $importLink = new Amhsoft_Link_Control(_t('Import From Csv'), '?module=coupon&page=import-csv&id=' . $this->couponModel->getId());
        $importLink->setClass('add');

        $panel->addComponent($this->dataGridView);
        $panelLinks = new Amhsoft_Widget_Panel();
        $panelLinks->setLayout(new Amhsoft_Grid_Layout(4));
        $panelLinks->addComponent($addLink);
        $panelLinks->addComponent($generateLink);
        $panelLinks->addComponent($downloadLink);
        $panelLinks->addComponent($importLink);

        $panel->addComponent($panelLinks);
        $this->couponPanel->addComponent($panel);
    }

    /**
     * Downloadcsv event
     */
    public function __downloadcsv() {
        $adapter = new Coupon_Code_Model_Adapter();
        $adapter->where('coupon_id = ?', $this->couponModel->getId());
        $results = $adapter->fetch();
        $array = array();
        $string = '';
        foreach ($results as $key => $code) {
            $array[$key] = array($code->id, $code->coupon_id, $code->expire_date, $code->code);
        }

        foreach ($array as $line) {

            $string .= implode(';', $line);
        }

        Amhsoft_Common::force_download($this->couponModel->name . '.csv', $string);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
       if (Amhsoft_System_Module_Manager::isModuleInstalled('Crm')) {
     $this->getView()->assign('coupon', TRUE);
    }
     
        $this->couponPanel->DataSource = new Amhsoft_Data_Set($this->couponModel);
        $this->couponPanel->Bind();
        $this->getView()->assign('widget', $this->couponPanel);
        $this->show();
    }

}

?>