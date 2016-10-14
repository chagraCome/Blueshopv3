<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Index.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Default
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Default_Backend_Index_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize controller
   */
  public function __initialize() {
    $this->includeJsFile('Amhsoft/Ressources/Javascripts/JQuery/flot/jquery.flot.js', false);
    $this->includeJsFile('Amhsoft/Ressources/Javascripts/JQuery/flot/jquery.flot.categories.js', false);
    $this->includeJsFile('Amhsoft/Ressources/Javascripts/JQuery/flot/jquery.flot.pie.js', false);
    $this->getView()->setMessage(_t('Welcome to control panel'), View_Message_Type::INFO);
  }

  /**
   * Default event
   */
  public function __default() {
    $portletAdapter = new Default_Portlet_Model_Adapter();
    $portletAdapter->leftJoin('portlet_user', 'id', 'portlet_id');
    $portletAdapter->select('portlet.*');
    $portletAdapter->select('portlet_user.*');
    $portletAdapter->where('status = 1');
    if (Amhsoft_Authentication::getInstance()->getObject()) {
      $portletAdapter->where('user_id = ?', Amhsoft_Authentication::getInstance()->getObject()->id);
    }
    $result = $portletAdapter->fetch();
    $portlets = array();
    while ($portlet = $result->fetch()) {
      if (Amhsoft_System_Module_Manager::isModuleInstalled($portlet->module)) {
	$portlets[$portlet->position][] = array('id' => $portlet->getId(), 'title' => _t($portlet->getName()), 'content' => $portlet->getContent());
      }
    }
    $this->getView()->assign('portlets', $portlets);
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $onlineUsers = Modules_User_Backend_Boot::whoIsOnline();
    $this->getView()->assign('online_users', implode(', ', $onlineUsers));
    $this->show();
  }

}

?>
