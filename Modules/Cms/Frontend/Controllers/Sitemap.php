<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Sitemap.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:39:00
 */
class Cms_Frontend_Sitemap_Controller extends Amhsoft_System_Web_Controller {

  /**
   * Initialize Components.
   */
  public function __initialize() {
    $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
    $cmsMenuModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
    $result = $cmsMenuModelAdapter->fetch();
    if (!$result) {
      return;
    }
    $count = $result->rowCount();
    $menuBar = new Amhsoft_Widget_Menu_Bar();
    foreach ($result as $it => $item) {
      $menuItem = new Amhsoft_Widget_Menu_Item($item->getTitle(), $item->getLink());
      if ($item->isCurrent()) {
	$menuItem->setCurrent(true);
      }
      if ($it == 0) {
	$menuItem->setFirst(true);
      }
      if ($it == $count - 1) {
	$menuItem->setLast(true);
      }
      if ($item->hasChildrens()) {
	foreach ($item->getChildrens() as $child) {
	  $menuItem->AddItem(new Amhsoft_Widget_Menu_Item($child->getTitle(), $child->getLink()));
	}
      }
      $menuBar->AddItem($menuItem);
    }
    $this->getView()->assign('sitemaphtml', $menuBar->Render());
  }

  /**
   * Default Event.
   */
  public function __default() {
    
  }

  /**
   * Finalize
   */
  public function __finalize() {
    $this->show();
  }

}
