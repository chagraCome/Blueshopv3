<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Setting
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Setting_Template_Print_DataGridView extends Amhsoft_Widget_DataGridView {

    public $name;
    protected $adapter;

    /**
     * Grid Construct
     * @param type $link
     */
    public function __construct($link = "admin.php") {
        parent::__construct();
        $this->LinkUrl = $link;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $nameCol = new Amhsoft_Label_Control(_t('Name'), new Amhsoft_Data_Binding('name'));
        $editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=setting&page=template-print-modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth('80');


        $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=setting&page=template-print-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth('80');

        $this->AddColumn($nameCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol, 'delCol');
    }

    /**
     * Initialize Search Fields
     */
    public function initializeSearch() {
        $this->addSearcField('text');
    }

}

?>
