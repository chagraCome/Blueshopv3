<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Inbox_Email_Panel extends Amhsoft_Widget_Panel {

  public $attachementPanel;
  public $assignAccountButton;
  public $assignContactButton;

  /**
   * Panel Construct
   * @param type $label
   * @param type $tagName
   */
  public function __construct($label = null, $tagName = 'fieldset') {
    parent::__construct($label, $tagName);
    $this->initializeComponents();
  }

  /**
   * Initialize Panel Components
   */
  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(1);
    $layout->setWidth('100%');
    $this->setLayout($layout);
    $fromLabel = new Amhsoft_Label_Control(_t('From'), new Amhsoft_Data_Binding('from'));
    $subjectLabel = new Amhsoft_Label_Control(_t('Subject'), new Amhsoft_Data_Binding('subject'));
    $dateLabel = new Amhsoft_Date_Time_Label_Control(_t('Date'), new Amhsoft_Data_Binding('date'));
    $contentLabel = new Amhsoft_Label_Control(_t('Body'), new Amhsoft_Data_Binding('message'));
    $contentLabel->DataBinding = new Amhsoft_Data_Binding('message');
    $contentLabel->ReadOnly = true;
    $contentLabel->setWidth('100%');
    $this->addComponent($fromLabel);
    $this->addComponent($subjectLabel);
    $this->addComponent($dateLabel);
    $this->addComponent($contentLabel);
    $this->attachementPanel = new Amhsoft_Widget_Panel();
    $this->addComponent($this->attachementPanel);
    $this->assignAccountButton = new Amhsoft_Link_Control(_t('Assign Email to Account'), 'admin.php?module=crm&page=account-quicklist&refresh=true');
    $this->assignAccountButton->onClickOpenInPopUp(600, 400);
    $this->assignAccountButton->setClass('add');
    $this->assignAccountButton->Name = 'assignAccountButton';
    $this->assignContactButton = new Amhsoft_Link_Control(_t('Assign Email to Contact'), 'admin.php?module=crm&page=contact-quicklist&refresh=true');
    $this->assignContactButton->onClickOpenInPopUp(600, 400);
    $this->assignContactButton->setClass('add');
    $this->assignContactButton->Name = 'assignContactButton';
    $panel = new Amhsoft_Widget_Panel('Action');
    $panel->setLayout(new Amhsoft_Grid_Layout(2));
    $panel->addComponent($this->assignAccountButton);
    $panel->addComponent($this->assignContactButton);
    $this->addComponent($panel);
  }

}

?>
