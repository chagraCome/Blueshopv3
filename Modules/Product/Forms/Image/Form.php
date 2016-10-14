<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Image_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var FileInput $documentfileInput */
  public $imagefileInput;

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

  /** @var Input $maxwidthInput */
  public $maxwidthInput;

  /** @var Input $maxHeightInput */
  public $maxHeightInput;
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
   * Initiallize Form Components
   */
  public function initializeComponents() {
    $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
    $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
    $this->nameInput->setWidth(300);
    $this->imagefileInput = new Amhsoft_FileInput_Control('image_file', _t('Image to upload', 'Add Image'));
    $ImageValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::JPG . ';' . Amhsoft_Mimetype::PNG . ';' . Amhsoft_Mimetype::JPEG);
    $this->imagefileInput->addValidator($ImageValidator);
    $this->imagefileInput->ToolTip = _t('Important for the search engines (image search)');
    $this->maxwidthInput = new Amhsoft_Input_Control('maxwidth', _t('Max Width (Pixel)'), 0);
    $this->maxwidthInput->DataBinding = new Amhsoft_Data_Binding('maxwidth');
    $this->maxwidthInput->Required = false;
    $this->maxHeightInput = new Amhsoft_Input_Control('maxheight', _t('Max Height (Pixel)'), 0);
    $this->maxHeightInput->DataBinding = new Amhsoft_Data_Binding('maxheight');
    $this->maxHeightInput->Required = false;
    $this->publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 1);
    $this->publicYesNoListBox->ToolTip = _t('if not public, the image will not be appear in the frontend');
    $this->remoteUrlInput = new Amhsoft_Input_Control('remote_url', _t('Remote URL'));
    $this->remoteUrlInput->DataBinding = new Amhsoft_Data_Binding('remote_url');
    $this->remoteUrlInput->setWidth(400);
    $this->remoteUrlInput->ToolTip = _t('Note: by using remote url, the uploaded image will be ignored!');
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $generalPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
    $generalPanel->addComponent($this->nameInput);
    $generalPanel->addComponent($this->publicYesNoListBox);
    $generalPanel->addComponent($this->imagefileInput);
    $generalPanel->addComponent($this->remoteUrlInput);
    $sizePanel = new Amhsoft_Widget_Panel(_t('Size Informations'));
    $sizePanel->addComponent($this->maxwidthInput);
    $sizePanel->addComponent($this->maxHeightInput);
    $this->addComponent($generalPanel);
    $this->addComponent($sizePanel);
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
