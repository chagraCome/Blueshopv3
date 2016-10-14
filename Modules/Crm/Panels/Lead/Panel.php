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
 * Description of LeadPanel
 *
 * @author Montasser
 */
class Crm_Lead_Panel extends Amhsoft_Widget_Panel {

  /** @var Label $companyLabel */
  public $compnayLabel;

  /** @var Label $firstnameLabel */
  public $firstnameLabel;

  /** @var Label $lastnameLabel */
  public $lastnameLabel;

  /** @var Label $dateofbirthLabel */
  public $dateofbirthLabel;

  /** @var Label $phoneLabel */
  public $phoneLabel;

  /** @var Label $emailLabel */
  public $emailLabel;

  /** @var Label $mobileLabel */
  public $mobileLabel;

  /** @var Label $faxLabel */
  public $faxLabel;

  /** @var Label $createdatetimeLabel */
  public $createdatetimeLabel;

  /** @var Label $updatedatetimeLabel */
  public $updatedatetimeLabel;

  /** @var Label $noticeLabel */
  public $noticeLabel;

  /** @var Label $groupLabel */
  public $groupLabel;

  /** @var Label $accountLabel */
  public $accountLabel;

  /** @var Label $stateLabel */
  public $stateLabel;
  public $created;
  public $updated;

  public function __construct($name = null, $method = null) {
    parent::__construct($name, $method);
    $this->initializeComponents();
  }

  public function initializeComponents() {
    $layout = new Amhsoft_Grid_Layout(2);
    $layout->setWidth(600);
    $panelInformation = new Amhsoft_Widget_Panel(_t('Lead Information'));
    $panelInformation->setLayout($layout);
    $this->compnayLabel = new Amhsoft_Label_Control(_t('Company '), new Amhsoft_Data_Binding('company'));
    $this->firstnameLabel = new Amhsoft_Label_Control(_t('First Name'), new Amhsoft_Data_Binding('firstname'));
    $this->lastnameLabel = new Amhsoft_Label_Control(_t('Last Name'), new Amhsoft_Data_Binding('lastname'));
    $this->dateofbirthLabel = new Amhsoft_Date_Label_Control(_t('Date of Birth'), new Amhsoft_Data_Binding('date_of_birth'));
    $this->phoneLabel = new Amhsoft_Label_Control(_t('Phone'), new Amhsoft_Data_Binding('phone'));
    $this->emailLabel = new Amhsoft_Label_Control(_t('Email'), new Amhsoft_Data_Binding('email'));
    $this->mobileLabel = new Amhsoft_Label_Control(_t('Mobile'), new Amhsoft_Data_Binding('mobile'));
    $this->faxLabel = new Amhsoft_Label_Control(_t('Fax'), new Amhsoft_Data_Binding('fax'));
    $this->createdatetimeLabel = new Amhsoft_Date_Time_Label_Control(_t('Create Date Time'), new Amhsoft_Data_Binding('create_date_time'));
    $this->updatedatetimeLabel = new Amhsoft_Date_Time_Label_Control(_t('Update Date Time'), new Amhsoft_Data_Binding('update_date_time'));
    $panelInformation->addComponent($this->compnayLabel);
    $panelInformation->addComponent($this->firstnameLabel);
    $panelInformation->addComponent($this->lastnameLabel);
    $panelInformation->addComponent($this->dateofbirthLabel);
    $panelInformation->addComponent($this->phoneLabel);
    $panelInformation->addComponent($this->emailLabel);
    $panelInformation->addComponent($this->mobileLabel);
    $panelInformation->addComponent($this->faxLabel);
    $panelInformation->addComponent($this->createdatetimeLabel);
    $panelInformation->addComponent($this->updatedatetimeLabel);
    $panelNotice = new Amhsoft_Widget_Panel(_t('Notice'));
    $panelNotice->setLayout($layout);
    $this->noticeLabel = new Amhsoft_Label_Control(_t('Notice'), new Amhsoft_Data_Binding('notice'));
    $panelNotice->addComponent($this->noticeLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelNotice);
  }

}

?>
