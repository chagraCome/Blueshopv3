<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 385 2016-02-10 14:55:12Z amira.amhsoft $
 * $Rev: 385 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-10 15:55:12 +0100 (mer., 10 févr. 2016) $
 * $Author: amira.amhsoft $

 * Application::import('Amhsoft.Core.Controls.Control');
 */
class Crm_Document_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

    /** @var Input $nameInput * */
    public $nameInput;

    /** @var ListBox $typeInput * */
    public $typeInput;

    /** @var Input extensionInput * */
    public $extensionInput;

    /** @var Amhsoft_FileInput_Control $documentfileInput */
    public $documentfileInput;

    /** @var ListBox $publicYesNoListBox * */
    public $publicYesNoListBox;
    public $submitButton;

    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->setMultipart(true);
        $this->initializeComponents();
    }

    public function initializeComponents() {
        $this->nameInput = new Amhsoft_Input_Control('name', _t('Name'));
        $this->nameInput->DataBinding = new Amhsoft_Data_Binding('name');
        $this->nameInput->Required = true;

        $types = array(_t('Document'), _t('Image'), _t('Zip File'), _t('Software'));

        $this->typeInput = new Amhsoft_ListBox_Control('type', _t('Type'));
        $this->typeInput->DataBinding = new Amhsoft_Data_Binding('type');
        $this->typeInput->DataSource = new Amhsoft_Data_Set($types);



        $this->publicYesNoListBox = new Amhsoft_YesNo_ListBox_Control('public', _t('Public'), 'public', 1);

        $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $this->submitButton->Class = 'ButtonSave';


        $this->documentfileInput = new Amhsoft_FileInput_Control('project_file', _t('File to upload'), 'Add Document');
        $docValidator = new Amhsoft_File_Validator(2000, Amhsoft_Mimetype::DOC . ';' . Amhsoft_Mimetype::PDF . ';' . Amhsoft_Mimetype::ZIP . ';' . Amhsoft_Mimetype::EXCEL . ';' . Amhsoft_Mimetype::IMAGES);
        $this->documentfileInput->addValidator($docValidator);

        $this->documentfileInput->Required = true;

	$generealInformationPanel = new Amhsoft_Widget_Panel(_t('General Informations'));
	
        $generealInformationPanel->addComponent($this->nameInput);
        $generealInformationPanel->addComponent($this->typeInput);
        $generealInformationPanel->addComponent($this->publicYesNoListBox);
        $generealInformationPanel->addComponent($this->documentfileInput);
	$nav = new Amhsoft_Widget_Panel(_t('Navigation'));
        $nav->addComponent($this->submitButton);
	
	$this->addComponent($generealInformationPanel);
	$this->addComponent($nav);
    }

    public function isSend() {
        return isset($_POST['submit']);
    }

}

?>
