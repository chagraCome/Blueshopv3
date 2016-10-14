<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Eav
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $

 * Description of Product_Attribute_DataGridView
 *
 * @author Montasser
 */
class Eav_Attribute_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /**
     * Grid Construct
     * @param type $linkUrl
     */
    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /*
     * Initialize Grid Components
     */

    public function initializeComponents() {
        $labelCol = new Amhsoft_Label_Control(_t('Label'), new Amhsoft_Data_Binding('label'));
        $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
        $requiredCol = new Amhsoft_YesNo_Image_Control(_t('Required'), new Amhsoft_Data_Binding('required'));
        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=eav&page=attributes-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth(60);
        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=eav&page=attributes-delete&entity=' . @$_GET['entity']);
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth(60);
        $manageSource = new Amhsoft_Link_Control(_t('Manage Options'), '?module=eav&page=attributesource-modify&entity=' . @$_GET['entity']);
        $manageSource->Alias = 'attribute_id';
        $manageSource->DataBinding = new Amhsoft_Data_Binding('id');
        $manageSource->setWidth(120);
        $manageSource->Class = 'details';
        $this->onRowDraw->registerEvent($this, 'dataGridView_RowDraw_CallBack');
        $this->AddColumn($labelCol);
        $this->AddColumn($nameCol);
        $this->AddColumn($requiredCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
        $this->AddColumn($manageSource);
    }

    /**
     * Initialize Search Fields
     */
    public function initializeSearch() {
        $this->addSearcField('text');
        $this->addSearcField('text');
    }

    /**
     * RowDraw Callback
     * @param type $colIndex
     * @param Amhsoft_Abstract_Control $sender
     * @param type $dataSource
     */
    public static function dataGridView_RowDraw_CallBack($colIndex, Amhsoft_Abstract_Control $sender, $dataSource) {
        //listbox multipl
        if ($colIndex == 5 && $dataSource->entity_attribute_type_backend_id != 2 && $dataSource->entity_attribute_type_backend_id != 23) { //listbox
            $sender->setLabel('');
            $sender->Href = '#';
            $sender->Class = '';
        }
    }

}

?>
