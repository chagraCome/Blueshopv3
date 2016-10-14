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
 * @package    Comment
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 16:23:21
 * @encoding   UTF-8
 */
// imports

class Modules_Comment_Backend_Boot extends Amhsoft_System_Module_Abstract {

  /**
   * On Module Install
   * @param Amhsoft_System $system
   * @return boolean
   */
  public function onInstall(Amhsoft_System $system) {
    $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
    try {
      $this->executeSQLFile($file);
      return true;
    } catch (Exception $e) {
      return false;
    }
  }

  /**
   * Init RBAC Rules.
   * @param Amhsoft_System $system
   */
  public function initRBAC(Amhsoft_System $system) {
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment', _t('Comment Module'), null));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment_Backend_Add_Controller', _t('Add Comment'), 'Comment'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment_Backend_Delete_Controller', _t('Delet Comment'), 'Comment'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment_Backend_Detail_Controller', _t('Comment Details'), 'Comment'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment_Backend_List_Controller', _t('List Comments'), 'Comment'));
    $system->registerRBACRule(new Amhsoft_RBAC_Rule('Comment_Backend_Modify_Controller', _t('Edit Comment'), 'Comment'));
  }

  /**
   * Tables To Backup
   * @return type
   */
  public function getTablesToBackup() {
    return array(
	'comment_item',
	'comment_item_replay',
    );
  }

}
