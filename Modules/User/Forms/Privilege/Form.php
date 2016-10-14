<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    User
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class User_Privilege_Form extends Amhsoft_Widget_Form implements Amhsoft_Widget_Interface {

  /** @var Amhsoft_Widget_Tree $treeView */
  public $treeView;
  public $submitButton;

  /**
   * Construct
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
    $panel = new Amhsoft_Widget_Panel(_t('Manage Access Controls'));
    $this->treeView = new Amhsoft_Widget_Tree('access');
    $node = new Amhsoft_CheckBox_Control('Node', 'Allow', 1);
    $node->DataBinding = new Amhsoft_Data_Binding('name', 'name', 'label');
    $this->treeView->setNode($node);
    $this->treeView->setDataSource(new Amhsoft_Data_Set(Amhsoft_RBAC_Rule_Manager::getTops()));
    $panel->addComponent($this->treeView);
    $this->submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
    $this->submitButton->Class = 'ButtonSave';
    $this->addComponent($panel);
    $panel = new Amhsoft_Widget_Panel(_t('Save Persmissions'));
    $panel->addComponent($this->submitButton);
    $this->addComponent($panel);
  }

  /**
   * Form send method
   * @return type
   */
  public function isSend() {
    return isset($_POST['submit']);
  }

}

?>
