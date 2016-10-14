<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Role_DataGridView extends Amhsoft_Widget_DataGridView {

    protected $adapter;

    /** @var Amhsoft_Label_Control $nameLabel */
    public $nameLabel;

    /** @var Amhsoft_Label_Control $parentLabel */
    public $parentLabel;

    /** @var Amhsoft_Link_Control $editLink */
    public $editLink;

    /** @var Amhsoft_Link_Control $deleteLink */
    public $deleteLink;

    /** @var Amhsoft_Link_Control $manageLink */
    public $manageLink;

    /** @var Amhsoft_Common::AddParamToQueryString $stateLink */
    public $stateLink;

    /**
     * Construct
     * @param type $link
     */
    public function __construct($link = 'admin.php') {
        parent::__construct();
        $this->LinkUrl = $link;
        $this->initializeComponents();
        $this->initializeSearch();
    }

    /**
     * Initialize Grid Components
     */
    public function initializeComponents() {
        $this->nameLabel = new Amhsoft_Label_Control(_t('Name'));
        $this->nameLabel->DataBinding = new Amhsoft_Data_Binding('name');
        $this->parentLabel = new Amhsoft_Label_Control(_t('Parent'));
        $this->parentLabel->DataBinding = new Amhsoft_Data_Binding('parent', 'parent_id');
        $this->editLink = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=user&page=role-modify');
        $this->editLink->DataBinding = new Amhsoft_Data_Binding('id');
        $this->editLink->Class = 'edit';
        $this->editLink->setWidth('60');
        $this->deleteLink = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=user&page=role-delete');
        $this->deleteLink->DataBinding = new Amhsoft_Data_Binding('id');
        $this->deleteLink->JavaScript = 'onClick="return confirmDelete();"';
        $this->deleteLink->Class = 'delete';
        $this->deleteLink->setWidth('60');
        $this->manageLink = new Amhsoft_Link_Control(_t('Manage Privilege'), 'admin.php?module=user&page=privilege-modify');
        $this->manageLink->DataBinding = new Amhsoft_Data_Binding('id');
        $this->manageLink->setWidth('120');
        $this->stateLink = new Amhsoft_Link_OnOffline_Control(_t('State'), 'admin.php?module=user&page=role-online');
        $this->stateLink->DataBinding = new Amhsoft_Data_Binding('id', 'state');
        $this->stateLink->setWidth('60');
        $this->AddColumn($this->nameLabel);
        $this->AddColumn($this->parentLabel);
        $this->AddColumn($this->manageLink);
        $this->AddColumn($this->editLink);
        $this->AddColumn($this->deleteLink);
        $this->AddColumn($this->stateLink);
    }

    /**
     * Initialize search field
     */
    public function initializeSearch() {
        $this->allowSearch();
        $this->addSearcField('text');
        $this->parentListBox = new Amhsoft_ListBox_Control('parent_id', _t('Parent'));
        $this->parentListBox->DataBinding = new Amhsoft_Data_Binding('parent_id', 'rbac_role_id', 'name');
        $this->parentListBox->DataSource = Amhsoft_Data_Source::Table('rbac_role_lang', 'rbac_role_id', 'name', " WHERE lang = '" . Amhsoft_System::getCurrentLang() . "'");
        $this->parentListBox->WithNullOption = true;
        $this->addSearcField($this->parentListBox);
    }

}

?>
