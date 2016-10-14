<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Banner
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $

 * Application::import('Amhsoft.Core.Controls.Control');
 */
class Banner_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var FileInput $documentfileInput */
  public $bannerfileInput;

  /** @var Input $titleInput */
  public $titleInput;

  /** @var Input $nameInput */
  public $nameInput;

  /** @var ListBox $publicYesNoListBox * */
  public $publicYesNoListBox;

  /** @var TextArea $descriptionTextArea */
  public $descriptionTextArea;

  /** @var Input $remoteUrlInput */
  public $remoteUrlInput;
  public $submitButton;

  /**
   * Form Construct
   * @param type $name
   * @param type $method
   */
  public function __construct($name, $method = null) {
    parent::__construct($name, $method);
    $this->setMultipart(true);
    $this->initializeComponents();
  }

  /**
   * Initialize Form Components
   */
  public function initializeComponents() {
    $tPanel = new Amhsoft_Widget_Panel(_t('General Information'));
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(300);
    $this->nameInput->ToolTip = _t('Important for the search engines (Banner search)');
    $this->bannerfileInput = new Amhsoft_FileInput_Control('banner_file', _t('Banner to upload'), 'Add Image');
    $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
    $this->bannerfileInput->addValidator($ImageValidator);
    $this->bannerfileInput->Required = true;
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->remoteUrlInput = new Amhsoft_Input_Control('remote_url', _t('Url'));
    $this->remoteUrlInput->DataBinding = new Amhsoft_Data_Binding('remote_url');
    $this->remoteUrlInput->setWidth(300);
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->nameInput);
    $generalPanel->addComponent($this->remoteUrlInput);
    $generalPanel->addComponent($this->bannerfileInput);
    $this->addComponent($generalPanel);
    $navigationPanel = new Amhsoft_Widget_Panel(_t('Navigation'));
    $navigationPanel->addComponent($this->submitButton);
    $this->addComponent($navigationPanel);
  }

  /**
   * Send Form
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
