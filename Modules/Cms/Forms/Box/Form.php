<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Cms_Box_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_YesNo_ListBox_Control $borderYesNo */
  public $borderYesNo;

  /** @var Amhsoft_Input_Control §titleInput */
  public $titleInput;

  /** @var TextArea $content */
  public $content;

  /** @var Amhsoft_YesNo_ListBox_Control $stateYesNo */
  public $stateYesNo;

  /** @var Amhsoft_ListBox_Control $template */
  public $template;
  public $submitButton;

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
    $generealInformationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $this->titleInput = new Amhsoft_Input_Control('name', _t('Title'), null, null, new Amhsoft_Data_Binding('name'));
    $this->titleInput->Required = true;
    $this->titleInput->setWidth(300);
    $this->content = new Amhsoft_TextArea_Wysiwyg_Control('html', _t('Content'));
    $this->content->DataBinding = new Amhsoft_Data_Binding('html');
    $this->stateYesNo = new Amhsoft_YesNo_ListBox_Control('online', _t('Online'), 'online', 1);
    $this->borderYesNo = new Amhsoft_YesNo_ListBox_Control('border', _t('With Border'), 'border');
    $this->borderYesNo->Required = false;
    $tempplate_array = array(
	array('id' => 'Modules/Cms/Frontend/Views/Boxes/mainmenu.box.tpl.html', 'name' => '(Horizontal Menu) '),
	array('id' => 'Modules/Cms/Frontend/Views/Boxes/box.cms.tpl.html', 'name' => '(Vertical Menu) '),
	array('id' => 'Modules/Product/Frontend/Views/Boxes/Category.tpl.html', 'name' => '(Vertical Categry Box) '),
    );
    $this->template = new Amhsoft_ListBox_Control('file', _t('Template File'));
    $this->template->DataSource = new Amhsoft_Data_Set($tempplate_array);
    $this->template->DataBinding = new Amhsoft_Data_Binding('file', 'id', 'name');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'Button Save';
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));

    $generealInformationPanel->addComponent($this->titleInput);
    $generealInformationPanel->addComponent($this->content);
    $generealInformationPanel->addComponent($this->template);
    $generealInformationPanel->addComponent($this->stateYesNo);
    $generealInformationPanel->addComponent($this->borderYesNo);
    $navigationPanel->addComponent($this->submitButton);
    
    $this->addComponent($generealInformationPanel);
    $this->addComponent($navigationPanel);
  }

  /**
   * Sen Form Method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
