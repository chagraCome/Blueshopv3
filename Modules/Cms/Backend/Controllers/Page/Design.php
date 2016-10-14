<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Design.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:58:41
 * @encoding   UTF-8
 */
//imports

class Cms_Backend_Page_Design_Controller extends Amhsoft_System_Web_Controller {

  protected $pageid;

  /**
   * Initialize Components.
   */
  public function __initialize() {
    $this->pageid = $this->getRequest()->getInt('pageid');
    if ($this->pageid == 0) {
      throw new Amhsoft_Item_Not_Found_Exception();
    }
  }

  /**
   * Default Event.
   */
  public function __default() {
    $this->getView()->setMessage(_t('Frontend management'));
  }

  /**
   * Event/action Order Boxes
   */
  public function __order() {
    $boxes = $this->getRequest()->postInts('box');
    $view = $this->getRequest()->get('view');
    $position = null;
    switch ($view) {
      case 'pageleft' :
	$position = 'L';
	break;
      case 'pageright':
	$position = 'R';
	break;
      case 'pagecenter':
	$position = 'C';
	break;
      case 'pagecentertop':
	$position = 'CT';
	break;
      case 'pagecenterbottom':
	$position = 'CB';
	break;
      case 'pageheader':
	$position = 'T';
	break;
      case 'pagefooter':
	$position = 'B';
	break;
    }
    if (!$position) {
      exit;
    }
    $sql_delete = "DELETE FROM cms_page_has_cms_box WHERE cms_page_id = :pid AND position = :pos";
    $delstmt = Amhsoft_Database::getInstance()->prepare($sql_delete);
    $delstmt->bindParam(':pid', $this->pageid);
    $delstmt->bindParam(':pos', $position);
    $delstmt->execute();
    $sql_insert = "INSERT INTO cms_page_has_cms_box (cms_page_id, cms_box_id, position, sortid) VALUES(:pageid, :boxid, :position, :sortid)";
    $stmt = Amhsoft_Database::getInstance()->prepare($sql_insert);
    foreach ($boxes as $i => $boxid) {
      $stmt->bindParam(':pageid', $this->pageid);
      $stmt->bindParam(':boxid', $boxid);
      $stmt->bindParam(':position', $position);
      $stmt->bindParam(':sortid', $i);
      $stmt->execute();
    }
    echo $position;
    Amhsoft_Database::getInstance()->exec("UPDATE cms_page SET inherit_design_from_site = 0 WHERE id = $this->pageid;");
    exit;
  }

  /**
   * Get Boxes by Position
   * @param type $position
   * @param type $page
   * @return type
   */
  public function getRightBoxesByPosition($position, $page) {
    if (intval($page) == 0) {
      return;
    }
    $boxModelAdapter = new Cms_Box_Model_Adapter();
    $boxModelAdapter->leftJoin('cms_page_has_cms_box', 'id', 'cms_box_id');
    $boxModelAdapter->select('cms_page_has_cms_box.position');
    $boxModelAdapter->where('cms_page_has_cms_box.position = ?', $position, PDO::PARAM_STR);
    $boxModelAdapter->where('cms_page_has_cms_box.cms_page_id = ' . $page);
    return $boxModelAdapter->fetch();
  }

  /**
   * Get Unused Boxes
   * @param type $page
   * @return type
   */
  public function getUnUsedBoxes($page) {
    if (intval($page) == 0) {
      return;
    }
    $boxModelAdapter = new Cms_Box_Model_Adapter();
    $boxModelAdapter->where('id  not in (select cms_box_id FROM cms_page_has_cms_box WHERE cms_page_id = ' . $page . ')');
    return $boxModelAdapter->fetch();
  }

  /**
   * Finalize event.
   */
  public function __finalize() {
    $this->getView()->assign('headerboxes', $this->getRightBoxesByPosition('T', $this->pageid));
    $this->getView()->assign('rightboxes', $this->getRightBoxesByPosition('R', $this->pageid));
    $this->getView()->assign('leftboxes', $this->getRightBoxesByPosition('L', $this->pageid));
    $this->getView()->assign('bottomboxes', $this->getRightBoxesByPosition('B', $this->pageid));
    $this->getView()->assign('centerboxes', $this->getRightBoxesByPosition('C', $this->pageid));
    $this->getView()->assign('centertboxes', $this->getRightBoxesByPosition('CT', $this->pageid));
    $this->getView()->assign('centerbboxes', $this->getRightBoxesByPosition('CB', $this->pageid));
    $this->getView()->assign('unsedboxes', $this->getUnUsedBoxes($this->pageid));
    $this->includeCssFile('cms-list-general.css');
    $this->includeJsFile('cms-list-general.js');
    $this->show();
  }

}
