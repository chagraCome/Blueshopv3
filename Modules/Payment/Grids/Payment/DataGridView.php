<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Payment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Payment_Payment_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /**
     * Grid Construct
     * @param type $linkUrl
     */
    public function __construct($linkUrl = 'admin.php') {
        parent::__construct(array('id'=>'c'));
        $this->onRowDraw->registerEvent($this, 'rowDraw_CallBack');
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
        $feeCol = new Amhsoft_Label_Control(_t('Fee'), new Amhsoft_Data_Binding('fee'));
        $onlineCol = new Amhsoft_Link_OnOffline_Control(_t('Status'), '?module=payment&page=payment-online');
        $onlineCol->DataBinding = new Amhsoft_Data_Binding('id', 'online');
        $onlineCol->setWidth(80);
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=payment&page=payment-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth(60);
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=payment&page=payment-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth(60);
        $settingsUrl = new Amhsoft_Link_Control(_t('Settings'), '#');
        $settingsUrl->DataBinding = new Amhsoft_Data_Binding('modulename');

        $this->AddColumn($nameCol);
        $this->AddColumn($feeCol);
        $this->addColum($settingsUrl);
        $this->AddColumn($onlineCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    /**
     * Initialize Search Event
     */
    public function initializeSearch() {
        $this->addSearcField('text');
    }

    /**
     * RowDraw Callback
     * @param type $colIndex
     * @param Amhsoft_Abstract_Control $control
     * @param type $dataSource
     */
    public static function rowDraw_CallBack($colIndex, Amhsoft_Abstract_Control $control, $dataSource) {
        if ($control->DataBinding->Value == 'modulename') {
            if ($dataSource->modulename) {
                $control->Href = 'admin.php?module=' . $dataSource->modulename . '&page=settings';
                $control->Class = 'details';
            } else {
                $control->Label = '';
            }
        }
    }

}

?>
