<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    Cart
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    05.12.2012 - 12:58:41
 * @encoding   UTF-8
 */
class Modules_Cart_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * On Module Boot
   * @param Amhsoft_System $system
   */
  public function onBoot(Amhsoft_System $system) {
    
  }

  /**
   * Initialize Menu Container
   * @param Amhsoft_System $system
   */
  public function onInitMenuContainer(Amhsoft_System $system) {
    $admin = $system->getMenuContainer()->findMenuByName('Setting');
    $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Shopping cart"), "admin.php?module=cart&page=setting"));
  }

}
