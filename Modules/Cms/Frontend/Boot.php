<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 */
class Modules_Cms_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * OnBoot 
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        
    }

    /**
     * Get Boxes by Page
     * @param type $pageId
     * @return Cms_Box_Model_Adapter
     */
    protected function getBoxes($pageId) {
        $boxModelAdapter = new Cms_Box_Model_Adapter();
        $boxModelAdapter->leftJoin('cms_page_has_cms_box', 'id', 'cms_box_id');
        $boxModelAdapter->select('cms_box.*');
        $boxModelAdapter->select('cms_page_has_cms_box.position');
        $boxModelAdapter->where('online = 1');
        $boxModelAdapter->orderBy('cms_page_has_cms_box.sortid ASC');
        $boxModelAdapter->where('cms_page_has_cms_box.cms_page_id = ' . $pageId);
        return $boxModelAdapter;
    }

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $cmsMenu = $system->getMenuContainer()->findMenuByName('Cms');
        $cmsMenu->setLabel(_t("Content Management"));
        $cmsMenu
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Block"), "admin.php?module=cms&page=box-preadd"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Blocks"), "admin.php?module=cms&page=box-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Page"), "admin.php?module=cms&page=page-preadd"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Pages"), "admin.php?module=cms&page=page-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add Menu Point"), "admin.php?module=cms&page=menu-add"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Menu Points"), "admin.php?module=cms&page=menu-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Menu Blocks"), "admin.php?module=cms&page=mainmenu-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Sites"), "admin.php?module=cms&page=site-list"));
    }

    /**
     * Get Mega Menu Category
     * @return string
     */
    public static function getMegaMenuCategoryContainer() {
        $categoryModelAdapter = new Product_Category_Model_Adapter();
        $categoryModelAdapter->where('parent_id IS NULL');
        $result = $categoryModelAdapter->fetch();
        $str = '';
        while ($item = $result->fetch()) {
            $str .= '<div class="nav-column">';
            $str .= '<h3>' . $item->getName() . '</h3>';
            if ($item->hasChildern()) {
                $children = $item->getChildern();
                $str .= '<ul>';
                while ($child = $children->fetch()) {
                    $str .= '  <li><a href="#">' . $child->getName() . '</a></li>';
                }
                $str .= '</ul>';
            }
            $str .= '</div>';
        }
        return $str;
    }

    /**
     * Get Mega Menu Container
     * @param type $boxid
     * @return type
     */
    public static function getMegaMenuContainer($boxid) {
        $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
        $cmsMenuModelAdapter->orderBy('sortid ASC');
        $cmsMenuModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
        $cmsMenuModelAdapter->where('online=1');
        $result = $cmsMenuModelAdapter->fetchByBoxId($boxid);
        return $result;
    }

    /**
     * Get Menu Container
     * @param type $boxid
     * @param type $class
     * @return type
     */
    public static function getMenuContainer($boxid, $class = null) {
        $cmsMenuModelAdapter = new Cms_Menu_Model_Adapter();
        $cmsMenuModelAdapter->orderBy('sortid ASC');
        $cmsMenuModelAdapter->where('(parent_id IS NULL OR parent_id = 0)');
        $result = $cmsMenuModelAdapter->fetchByBoxId($boxid);
        if (!$result) {
            return;
        }
        $count = $result->rowCount();
        $menuBar = new Amhsoft_Widget_Menu_Bar();
        $menuBar->setCssClass('nav');
        if ($class) {
            $menuBar->setCssClass($class);
        }
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
                    $icon = null;
                    if (@file_exists('media/category/logos/' . $child->product_category_id . '.jpg')) {
                        $icon = 'media/category/logos/' . $child->product_category_id . '.jpg';
                    }
                    $submenu = new Amhsoft_Widget_Menu_Item($child->getTitle(), $child->getLink(), $icon);
                    if ($child->hasChildrens()) {
                        foreach ($child->getChildrens() as $schild) {
                            $icon = null;
                            if (@file_exists('media/category/logos/' . $child->product_category_id . '.jpg')) {
                                $icon = 'media/category/logos/' . $child->product_category_id . '.jpg';
                            }
                            $submenu->AddItem(new Amhsoft_Widget_Menu_Item($schild->getTitle(), $schild->getLink(), $icon));
                        }
                    }
                    $menuItem->AddItem($submenu);
                }
            }
            $menuBar->AddItem($menuItem);
        }
        return $menuBar->Render();
    }

    /**
     * Check if User Logedin
     * @return type
     */
    public static function inBackendLoggedIn() {
        return Amhsoft_Session::read('Backend.logged_user_idententity') != null;
    }

}

?>