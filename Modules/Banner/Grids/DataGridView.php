<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: DataGridView.php 368 2016-02-09 16:05:47Z amira.amhsoft $
 * $Rev: 368 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 17:05:47 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 17:05:47 +0100 (mar., 09 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of ImageDataGridView
 *
 * @author cherif
 */
class Banner_DataGridView extends Amhsoft_Widget_DataGridView {

    public function __construct($linkUrl = 'admin.php') {
        parent::__construct();
        $this->linkUrl = $linkUrl;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    public function initializeComponents() {

        $nameCol = new Amhsoft_Label_Control(_t('Banner Name'), new Amhsoft_Data_Binding('name'));

        $imageCol = new Amhsoft_ImageTag_Control(_t('Banner'), 'thumb_image', 0, 0);
        $imageCol->DataBinding = new Amhsoft_Data_Binding('thumb_image');
        $imageCol->setWidth(220);
        $imageCol->setHeight(80);

        $typeCol = new Amhsoft_Label_Control(_t('Type'), new Amhsoft_Data_Binding('type'));

        $extentionCol = new Amhsoft_Label_Control(_t('Extension'), new Amhsoft_Data_Binding('extention'));

        $insertAtCol = new Amhsoft_Label_Control(_t('Insert At'), new Amhsoft_Data_Binding('insertat'));
        $insertAtCol->setWidth(300);


        $onOffLinkCol = new Amhsoft_Link_OnOffline_Control(_t('State'), $this->LinkUrl . '?module=banner&page=offline');
        $onOffLinkCol->DataBinding = new Amhsoft_Data_Binding('id', 'state');
        $onOffLinkCol->setClass('edit');
        $onOffLinkCol->setWidth(60);

        $editCol = new Amhsoft_Link_Control(_t('Edit'), '?module=banner&page=modify');
        $editCol->DataBinding = new Amhsoft_Data_Binding('id');
        $editCol->Class = 'edit';
        $editCol->setWidth(60);


        $delCol = new Amhsoft_Link_Control(_t('Delete'), '?module=banner&page=delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->setWidth(60);
        $delCol->JavaScript = 'onClick="return confirmDelete();"';


        $this->AddColumn($imageCol);
        $this->AddColumn($nameCol);
        //$this->AddColumn($typeCol);
        //$this->AddColumn($extentionCol);
        $this->AddColumn($insertAtCol);
        $this->AddColumn($onOffLinkCol);
        $this->AddColumn($editCol);
        $this->AddColumn($delCol);
    }

    public function initializeSearch() {
        $this->addSearcField(null);
        $this->addSearcField('text');
        $this->addSearcField('date');
    }

}

?>
