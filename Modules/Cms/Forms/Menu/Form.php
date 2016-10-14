<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Cms_Menu_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Amhsoft_Input_Control $titleInput * */
    public $titleInput;

    /** @var Amhsoft_Input_Control $aliasInput */
    public $aliasInput;

    /** @var Amhsoft_Input_Control $sortidInput */
    public $sortidInput;

    /** @var Amhsoft_Input_Control $urlInput */
    public $urlInput;

    /** @var Amhsoft_ListBox_Control $cmsPageListBox */
    public $cmsPageListBox;

    /** @var DirectoryInput $pageListbox * */
    public $pageListbox;

    /** @var Amhsoft_ListBox_Control $cmsAreaListBox */
    public $cmsAreaListBox;

    /** @var Amhsoft_YesNo_ListBox_Control $stateYesNo */
    public $stateYesNo;

    /** @var Amhsoft_Input_Control $targetInput */
    public $targetInput;

    /** @var Amhsoft_ListBox_Control $parentListBox */
    public $parentListBox;

    /** @var Amhsoft_ListBox_Control $categoryListBox * */
    public $categoryListBox;
    public $submitButton;
    public $menuPanel;

    /**
     * Form Construct
     * @param type $name
     * @param type $method
     */
    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    /**
     * Initialize Form Components
     */
    public function initializeComponents() {
        $this->menuPanel = new Amhsoft_Widget_Panel(_t('Menu Point Data'));
        $this->titleInput = new Amhsoft_Input_Control('title', _t('Title'));
        $this->titleInput->DataBinding = new Amhsoft_Data_Binding('title');
        $this->titleInput->setWidth(300);
        $this->titleInput->Required = true;

        $this->aliasInput = new Amhsoft_Input_Control('alias', _t('Alias'));
        $this->aliasInput->DataBinding = new Amhsoft_Data_Binding('alias');

        $this->urlInput = new Amhsoft_Input_Control('url', _t('Extern Url'));
        $this->urlInput->DataBinding = new Amhsoft_Data_Binding('url');
        $this->urlInput->setWidth(300);

        $this->pageListbox = new Amhsoft_DirectoryInput_Control('page', _t('Select intern Page'));
        $this->pageListbox->DataBinding = new Amhsoft_Data_Binding('page', 'id', 'cms_page_id');
        $this->pageListbox->PopUpUrl = '?module=cms&page=page-quicklist';
        $this->pageListbox->setWidth(300);

        $this->cmsAreaListBox = new Amhsoft_ListBox_Control('cms_main_menu_id', _t('Main Menu'));
        $this->cmsAreaListBox->DataBinding = new Amhsoft_Data_Binding('cms_main_menu_id', 'id', 'name');
        $this->cmsAreaListBox->DataSource = new Amhsoft_Data_Set(new Cms_MainMenu_Model_Adapter());

        $this->stateYesNo = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);

        $targetSet = array(
		    array('id' => 'self', 'title' => _t('self')),
            array('id' => 'blank', 'title' => _t('blank')),
            
        );
        $this->targetInput = new Amhsoft_ListBox_Control('target', _t('Target'));
        $this->targetInput->DataSource = new Amhsoft_Data_Set($targetSet);
        $this->targetInput->DataBinding = new Amhsoft_Data_Binding('target', 'id', 'title');

        $this->parentListBox = new Amhsoft_ListBox_Control('parent_id', _t('Parent'));
        $this->parentListBox->DataBinding = new Amhsoft_Data_Binding('parent_id', 'id', 'title');
        $this->parentListBox->WithNullOption = true;
        
        $mainMenusDataSource = array(); //Cms_Menu_Model_Adapter::fetchAsTree();
        $this->parentListBox->DataSource = new Amhsoft_Data_Set($mainMenusDataSource);
        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'Button Save';
        $this->menuPanel->addComponent($this->titleInput);
        $this->menuPanel->addComponent($this->aliasInput);
        
        $panelLinkTarget = new Amhsoft_Widget_Panel();
        $panelLinkTargetLayout = new Amhsoft_Grid_Layout(4);
        $panelLinkTargetLayout->setAppendMode(Amhsoft_Abstract_Layout::APPEND);
        
        $panelLinkTarget->setLayout($panelLinkTargetLayout);
        $panelLinkTarget->addComponent($this->urlInput);
        $panelLinkTarget->addComponent($this->targetInput);
        $panelLinkTarget->addComponent(new Amhsoft_Html_Control('&nbsp;'));
        $panelLinkTarget->addComponent(new Amhsoft_Html_Control('&nbsp;'));
        
        $this->menuPanel->addComponent($panelLinkTarget);
        $this->menuPanel->addComponent($this->pageListbox);
        $this->menuPanel->addComponent($this->cmsAreaListBox);
        $this->menuPanel->addComponent($this->parentListBox);
        
        if (Amhsoft_System_Module_Manager::isModuleInstalled('Product')) {
            $this->categoryListBox = new Amhsoft_ListBox_Control('product_category_id', _t('Product Category'));
            $this->categoryListBox->WithNullOption = true;
            $categoryAdapter = new Product_Category_View_Model_Adapter();
            $this->categoryListBox->DataSource = new Amhsoft_Data_Set($categoryAdapter->fetchAllAsTree());
            $this->categoryListBox->DataBinding = new Amhsoft_Data_Binding('product_category_id', 'id', 'name');
            $this->categoryListBox->ToolTip = _t('You can link this menu to product category');
            $this->menuPanel->addComponent($this->categoryListBox);
        }
        $this->menuPanel->addComponent($this->stateYesNo);
        $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
        $navigationPanel->addComponent($this->submitButton);
        $this->addComponent($this->menuPanel);
        $this->addComponent($navigationPanel);
    }

    /**
     * Send Form Method
     * @return type
     */
    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
