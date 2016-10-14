<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Cms_Page_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Input_Control $titleInput * */
  public $titleInput;

  /** @var Amhsoft_Input_Control $aliasInput */
  public $aliasInput;

  /** @var Amhsoft_Input_Control $keywordsInput * */
  public $keywordsInput;

  /** @var Amhsoft_Input_Control $descriptionInput */
  public $descriptionInput;

  /** @var TextArea $contentTextArea */
  public $contentTextArea;

  /** @var Amhsoft_Input_Control $authorNameInput */
  public $authorNameInput;

  /** @var Amhsoft_Input_Control $updateAuthorNameInput */
  public $updateAuthorNameInput;

  /** @var DateControl $insertAtDateControl */
  public $insertAtDateControl;

  /** @var DateControl $updateAtDateControl */
  public $updateAtDateControl;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNo */
  public $stateYesNo;

  /** @var Amhsoft_YesNo_ListBox_Control $borderYesNo */
  public $borderYesNo;

  /** @var Amhsoft_YesNo_ListBox_Control $customDesignYesNo */
  public $customDesignYesNo;

  /** @var Amhsoft_YesNo_ListBox_Control $fixedYesNo */
  public $fixedYesNo;
  /*   * @var Amhsoft_YesNo_ListBox_Control $layoutYesNo */
  public $layoutYesNo;
  public $submitButton;

  /** @var Amhsoft_ListBox_Control $siteList */
  public $siteList;
  public $titlePanel;
  public $searchEnginePanel;
  public $contentPanel;
  public $settingsPanel;

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
    $this->titlePanel = new Amhsoft_Widget_Panel(_t('Page Title'));
    $this->searchEnginePanel = new Amhsoft_Widget_Panel(_t('Search Engine'));
    $this->contentPanel = new Amhsoft_Widget_Panel(_t('Page Content'));
    $this->settingsPanel = new Amhsoft_Widget_Panel(_t('Page Settings'));
    $this->titleInput = new Amhsoft_Input_Control('title', _t('Title'));
    $this->titleInput->DataBinding = new Amhsoft_Data_Binding('title');
    $this->titleInput->setWidth(300);
    $this->titleInput->Required = true;
    $this->aliasInput = new Amhsoft_Input_Control('alias', _t('Page Name (intern)'), null, null, new Amhsoft_Data_Binding('alias'));
    $this->aliasInput->Required = true;
    $this->aliasInput->setWidth(300);
    $this->keywordsInput = new Amhsoft_Input_Control('keywords', _t('Meta Keywords'));
    $this->keywordsInput->DataBinding = new Amhsoft_Data_Binding('keywords');
    $this->keywordsInput->setWidth(300);
    $this->keywordsInput->ToolTip = _t('comma separated keywords');
    $this->descriptionInput = new Amhsoft_TextArea_Control('description', _t('Meta Description'));
    $this->descriptionInput->DataBinding = new Amhsoft_Data_Binding('description');
    $this->contentTextArea = new Amhsoft_TextArea_Wysiwyg_Control('content', _t('Html Content'));
    $this->contentTextArea->DataBinding = new Amhsoft_Data_Binding('content');
    $this->stateYesNo = new Amhsoft_YesNo_ListBox_Control('state', _t('Online'), 'state', 1);
    $this->borderYesNo = new Amhsoft_YesNo_ListBox_Control('border', _t('With Border'), 'border', 1);
    $this->borderYesNo->Required = true;
    $this->layoutYesNo = new Amhsoft_YesNo_ListBox_Control('layout', _t('Layout'), 'layout', 1);
    $this->updateAtDateControl = new Amhsoft_Hidden_Control(('updateat'), new Amhsoft_Data_Binding('updateat'), date('Y-m-d H:i:s'));
    $this->authorNameInput = new Amhsoft_Input_Control('author_name', _t('Author Name'));
    $this->authorNameInput->DataBinding = new Amhsoft_Data_Binding('author_name');
    $this->updateAuthorNameInput = new Amhsoft_Input_Control('update_author_name', _t('Update Author Name'));
    $this->updateAuthorNameInput->DataBinding = new Amhsoft_Data_Binding('update_author_name');
    $this->customDesignYesNo = new Amhsoft_YesNo_ListBox_Control('inherit_design_from_site', _t('Inherit Design from Site'), 'inherit_design_from_site', 1);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'Button Save';
    $this->siteList = new Amhsoft_ListBox_Control('cms_site_id', _t('Site'));
    $this->siteList->DataBinding = new Amhsoft_Data_Binding('cms_site_id', 'id', 'name');
    $this->siteList->DataSource = Amhsoft_Data_Source::Table('cms_site');
    $this->siteList->Required = true;
    $this->titlePanel->addComponent($this->titleInput);
    $this->searchEnginePanel->addComponent($this->aliasInput);
    $this->searchEnginePanel->addComponent($this->keywordsInput);
    $this->searchEnginePanel->addComponent($this->descriptionInput);
    $this->addComponent($this->titlePanel);
    $this->addComponent($this->searchEnginePanel);
    $this->contentPanel->addComponent($this->contentTextArea);
    $this->addComponent($this->contentPanel);

    $this->settingsPanel->addComponent($this->stateYesNo);
    $this->settingsPanel->addComponent($this->borderYesNo);
    $this->settingsPanel->addComponent($this->siteList);
    $this->settingsPanel->addComponent($this->customDesignYesNo);
    $this->settingsPanel->addComponent($this->submitButton);
    $this->addComponent($this->settingsPanel);
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
