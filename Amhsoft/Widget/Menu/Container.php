<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Container.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Widget_Menu_Container {

  protected $menus = array();

  /**
   * Create new Menu
   * @param Amhsoft_Widget_Menu_Bar $menu
   * @return Amhsoft_Widget_Menu_Container
   */
  public function addMenu(Amhsoft_Widget_Menu_Bar $menu) {
    $this->menus[$menu->getLabel()] = $menu;
    return $this;
  }

  /**
   * Append to Menu
   * @param type $menuName
   * @param Amhsoft_Widget_Menu_Item $menuItem
   */
  public function appenToMenu($menuName, Amhsoft_Widget_Menu_Item $menuItem) {
    $this->findMenuByName($menuName)->AddItem($menuItem);
    return $this;
  }

  /**
   * Gets Main menu by Name
   * @param string $menuName
   * @return Amhsoft_Widget_Menu_Bar
   */
  public function findMenuByName($menuName) {
    if (!isset($this->menus[$menuName])) {
      $menu = new Amhsoft_Widget_Menu_Bar();
      $menu->setLabel($menuName);
      $this->addMenu($menu);
    }

    return $this->menus[$menuName];
  }

  public function removeMenuByName($name) {
    if (isset($this->menus[$name])) {
      $removed = $this->menus[$name];
      unset($this->menus[$name]);
      return $removed;
    }
  }

  /**
   * Gets menu
   * @return array menues
   */
  public function getMenus() {
    //Todo: please upgrade this
    //ksort($this->menus);
    return $this->menus;
  }

  public function applyMenuCssStyle($css) {
    foreach ($this->menus as $label => $menu) {
      $menu->setCssClass($css);
    }
  }

  public function applyLabelCssStyle($css) {
    foreach ($this->menus as $label => $menu) {
      $menu->setLabelClass($css);
    }
  }

}

?>
