<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */

/**
 * Description of MailInboxPanel
 *
 * @author Montasser
 */
class Crm_MailInbox_Panel extends Amhsoft_Widget_Panel {

  /** @var Label $subjectLabel */
  public $subjectLabel;

  /** @var Label $createAtLabel */
  public $createAtLabel;

  /** @var Label $sendAtLabel */
  public $sendAtLabel;

  /** @var Label $personLabel */
  public $personLabel;

  /** @var Label $userLabel */
  public $userLabel;

  /** @var Label $contentLabel */
  public $contentLabel;

  public function __construct($name = null, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_GridLayout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('General Information'));
    $panelInformation->setLayout($layout);
    $this->subjectLabel = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('subject'));
    $this->createAtLabel = new Amhsoft_Label_Control(_t('Create Date'), new Amhsoft_Data_Binding('createat'));
    $this->sendAtLabel = new Amhsoft_Label_Control(_t('Send Date'), new Amhsoft_Data_Binding('sendat'));
    $this->userLabel = new Amhsoft_Label_Control(_t('User'), new Amhsoft_Data_Binding('user'));
    $this->personLabel = new Amhsoft_Label_Control(_t('Person'), new Amhsoft_Data_Binding('person'));
    $panelInformation->addComponent($this->subjectLabel);
    $panelInformation->addComponent($this->createAtLabel);
    $panelInformation->addComponent($this->sendAtLabel);
    $panelInformation->addComponent($this->userLabel);
    $panelInformation->addComponent($this->personLabel);
    $panelMessage = new Amhsoft_Widget_Panel(_t('Message'));
    $panelMessage->setLayout($layout);
    $this->contentLabel = new Amhsoft_Label_Control(_t('Paragraph content'), new Amhsoft_Data_Binding('content'));
    $panelMessage->addComponent($this->contentLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelMessage);
  }

}

?>
