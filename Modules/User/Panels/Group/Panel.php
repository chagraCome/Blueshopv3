<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Group_Panel extends Amhsoft_Widget_Panel {

  /** @var Amhsoft_Label_Control $usernameLabel */
  public $usernameLabel;

  /** @var Amhsoft_Label_Control $passwordLabel */
  public $passwordLabel;

  /** @var Amhsoft_Label_Control $firstnameLabel */
  public $firstnameLabel;

  /** @var Label $lastnameLabel */
  public $lastnameLabel;

  /** @var Amhsoft_Label_Control $dateofbirthLabel */
  public $dateofbirthLabel;

  /** @var Amhsoft_Label_Control $phoneLabel */
  public $phoneLabel;

  /** @var Amhsoft_Label_Control $emailLabel */
  public $emailLabel;

  /** @var Amhsoft_Label_Control $mobileLabel */
  public $mobileLabel;

  /** @var Amhsoft_Label_Control $faxLabel */
  public $faxLabel;

  /** @var Amhsoft_Label_Control $stateLabel */
  public $stateLabel;

  /** @var Amhsoft_Label_Control $createdatetimeLabel */
  public $createdatetimeLabel;

  /** @var Amhsoft_Label_Control $updatedatetimeLabel */
  public $updatedatetimeLabel;

  /** @var Amhsoft_Label_Control $noticeLabel */
  public $noticeLabel;

  /** @var Amhsoft_Label_Control $addressLabel */
  public $addressLabel;

  /** @var Amhsoft_Label_Control $postalcodeLabel */
  public $postalcodeLabel;

  /** @var Amhsoft_Label_Control $cityLabel */
  public $cityLabel;

  /** @var Amhsoft_Label_Control $provinceLabel */
  public $provinceLabel;

  /** @var Amhsoft_Label_Control $countryLabel */
  public $countryLabel;

  /** @var Amhsoft_Label_Control $lastlogindtaeLabel */
  public $lastlogindateLabel;

  /** @var Amhsoft_Label_Control $lastloginhostLabel */
  public $lastloginhostLabel;

  /** @var Amhsoft_Label_Control $remoteidLabel */
  public $remoteidLabel;

  /** @var Amhsoft_Label_Control $groupLabel */
  public $groupLabel;

  /** @var Amhsoft_Label_Control $departmentLabel */
  public $departmentLabel;

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
    $layout = new Amhsoft_Grid_Layout(2);
    $panelInformation = new Amhsoft_Widget_Panel(_t('User Information'));
    $panelInformation->setLayout($layout);
    $this->usernameLabel = new Amhsoft_Label_Control(_t('User Name'), new Amhsoft_Data_Binding('username'));
    $this->passwordLabel = new Amhsoft_Label_Control(_t('Password'), new Amhsoft_Data_Binding('password'));
    $this->firstnameLabel = new Amhsoft_Label_Control(_t('First Name'), new Amhsoft_Data_Binding('firstname'));
    $this->lastnameLabel = new Amhsoft_Label_Control(_t('Last Name'), new Amhsoft_Data_Binding('lastname'));
    $this->dateofbirthLabel = new Amhsoft_Label_Control(_t('Date of birth'), new Amhsoft_Data_Binding('date_of_birth'));
    $this->phoneLabel = new Amhsoft_Label_Control(_t('Phone'), new Amhsoft_Data_Binding('phone'));
    $this->emailLabel = new Amhsoft_Label_Control(_t('Email'), new Amhsoft_Data_Binding('email'));
    $this->mobileLabel = new Amhsoft_Label_Control(_t('Mobile'), new Amhsoft_Data_Binding('mobile'));
    $this->faxLabel = new Amhsoft_Label_Control(_t('Fax'), new Amhsoft_Data_Binding('fax'));
    $this->stateLabel = new Amhsoft_Label_Control(_t('State'), new Amhsoft_Data_Binding('state'));
    $this->createdatetimeLabel = new Amhsoft_Label_Control(_t('Create Date Time'), new Amhsoft_Data_Binding('create_date_time'));
    $this->updatedatetimeLabel = new Amhsoft_Label_Control(_t('Update Date Time'), new Amhsoft_Data_Binding('update_date_time'));
    $this->lastlogindateLabel = new Amhsoft_Label_Control(_t('Last Login Date'), new Amhsoft_Data_Binding('lastLoginDate'));
    $this->lastloginhostLabel = new Amhsoft_Label_Control(_t('Last Login Host'), new Amhsoft_Data_Binding('lastLoginHost'));
    $this->remoteidLabel = new Amhsoft_Label_Control(_t('Remote Id'), new Amhsoft_Data_Binding('remote_id'));

    $panelInformation->addComponent($this->usernameLabel);
    $panelInformation->addComponent($this->passwordLabel);
    $panelInformation->addComponent($this->firstnameLabel);
    $panelInformation->addComponent($this->lastnameLabel);
    $panelInformation->addComponent($this->dateofbirthLabel);
    $panelInformation->addComponent($this->phoneLabel);
    $panelInformation->addComponent($this->emailLabel);
    $panelInformation->addComponent($this->mobileLabel);
    $panelInformation->addComponent($this->faxLabel);
    $panelInformation->addComponent($this->stateLabel);
    $panelInformation->addComponent($this->createdatetimeLabel);
    $panelInformation->addComponent($this->updatedatetimeLabel);
    $panelInformation->addComponent($this->lastlogindateLabel);
    $panelInformation->addComponent($this->lastloginhostLabel);
    $panelInformation->addComponent($this->remoteidLabel);

    $panelNotice = new Amhsoft_Widget_Panel(_t('Notice'));
    $panelNotice->setLayout($layout);
    $this->noticeLabel = new Amhsoft_Label_Control(_t('Notice'), new Amhsoft_Data_Binding('notice'));
    $panelNotice->addComponent($this->noticeLabel);
    $panelAddress = new Amhsoft_Widget_Panel(_t('Address'));
    $panelAddress->setLayout($layout);
    $this->addressLabel = new Amhsoft_Label_Control(_t('Address'), new Amhsoft_Data_Binding('address'));
    $this->postalcodeLabel = new Amhsoft_Label_Control(_t('Postal Code'), new Amhsoft_Data_Binding('postalcode'));
    $this->cityLabel = new Amhsoft_Label_Control(_t('City'), new Amhsoft_Data_Binding('city'));
    $this->provinceLabel = new Amhsoft_Label_Control(_t('Province'), new Amhsoft_Data_Binding('province'));
    $this->countryLabel = new Amhsoft_Label_Control(_t('Country'), new Amhsoft_Data_Binding('country'));
    $panelAddress->addComponent($this->addressLabel);
    $panelAddress->addComponent($this->postalcodeLabel);
    $panelAddress->addComponent($this->cityLabel);
    $panelAddress->addComponent($this->provinceLabel);
    $panelAddress->addComponent($this->countryLabel);
    $this->addComponent($panelInformation);
    $this->addComponent($panelAddress);
    $this->addComponent($panelNotice);
  }

}

?>
