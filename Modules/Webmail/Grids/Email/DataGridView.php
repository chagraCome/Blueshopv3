<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Webmail
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Webmail_Email_DataGridView extends Amhsoft_Widget_DataGridView {

  public $from_email;
  public $to_emails;
  public $subject;
  public $state;
  public $createat;
  public $sendat;
  public $editCol;
  public $deleteCol;

  /**
   * Grid Construct
   * @param type $linkUrl
   */
  public function __construct($linkUrl = 'admin.php') {
    parent::__construct();
    $this->LinkUrl = $linkUrl;
    $this->initializeComponents();
    $this->initializeSearch();
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    $this->from_email = new Amhsoft_Label_Control(_t('From'));
    $this->from_email->DataBinding = new Amhsoft_Data_Binding('from_email');
    $this->AddColumn($this->from_email);
    $this->to_emails = new Amhsoft_Label_Control(_t('To'));
    $this->to_emails->DataBinding = new Amhsoft_Data_Binding('to_emails');
    $this->AddColumn($this->to_emails);
    $this->subject = new Amhsoft_Label_Control(_t('Subject'));
    $this->subject->DataBinding = new Amhsoft_Data_Binding('subject');
    $this->AddColumn($this->subject);
    $this->state = new Amhsoft_Label_Control(_t('State'));
    $this->state->DataBinding = new Amhsoft_Data_Binding('status_text');
    $this->AddColumn($this->state);
    $this->createat = new Amhsoft_Date_Time_Label_Control(_t('Create Date'));
    $this->createat->DataBinding = new Amhsoft_Data_Binding('createat');
    $this->AddColumn($this->createat);
    $this->sendat = new Amhsoft_Date_Time_Label_Control(_t('Send Date'));
    $this->sendat->DataBinding = new Amhsoft_Data_Binding('sendat');
    $this->AddColumn($this->sendat);
    $this->editCol = new Amhsoft_Link_Control(_t('Edit'), 'admin.php?module=webmail&page=email-modify');
    $this->editCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->editCol->Class = "edit";
    $this->editCol->setWidth('60');
    $this->AddColumn($this->editCol);
    $this->deleteCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=webmail&page=email-delete');
    $this->deleteCol->DataBinding = new Amhsoft_Data_Binding('id');
    $this->deleteCol->Class = "delete";
    $this->deleteCol->JavaScript = 'onClick="return confirmDelete();"';
    $this->deleteCol->setWidth('60');
    $this->AddColumn($this->deleteCol);
  }

  /**
   * Initialize Seaarch Fieldds
   */
  public function initializeSearch() {
    $this->allowSearch();
    $this->addSearcField("text");
    $this->addSearcField("text");
    $this->addSearcField("text");
    $this->addSearcField("text");
    $this->addSearcField("date");
    $this->addSearcField("date");
  }

}

?>