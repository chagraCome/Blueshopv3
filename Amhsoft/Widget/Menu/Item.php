<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Item.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Control Amhsoft_Widget_Menu_Item
 * @author Amir Cherif
 * @author Thomas Häber
 */
class Amhsoft_Widget_Menu_Item implements Amhsoft_Widget_Interface {

    /** @var array of Amhsoft_Widget_Menu_Items */
    private $items = array();

    /** @var string label of Amhsoft_Widget_Menu_Item */
    private $label = null;

    /** @var string link/anchor of Amhsoft_Widget_Menu_Item (used as HTML link) */
    private $link = null;
    private $cssClass = null;
    private $current = false;
    private $first = false;
    private $last = false;
    private $icon = null;

    /**
     * construct Amhsoft_Widget_Menu_Item
     * @param string $label label of Amhsoft_Widget_Menu_Item
     * @param string $link link/anchor of Amhsoft_Widget_Menu_Item (used as HTML link)
     */
    public function __construct($label, $link = '#', $icon = null) {
        $this->label = $label;
        $this->link = $link;
        $this->icon = $icon;
    }

    public function getCurrent() {
        return $this->current;
    }

    public function setCurrent($current) {
        $this->current = $current;
    }

    public function getFirst() {
        return $this->first;
    }

    public function setFirst($first) {
        $this->first = $first;
    }

    public function getLast() {
        return $this->last;
    }

    public function setLast($last) {
        $this->last = $last;
    }

    /**
     * add item to list of Amhsoft_Widget_Menu_Item
     * @param Amhsoft_Widget_Menu_Item $item new item to add
     * @return Amhsoft_Widget_Menu_Item instance of Amhsoft_Widget_Menu_Item
     */
    public function AddItem(Amhsoft_Widget_Menu_Item $item) {
        if (!$this->Contains($item)) {
            $this->items[] = $item;
        }
        return $this;
    }

    public function setCssClass($class) {
        $this->cssClass = $class;
    }

    public function getCssClass() {
        return $this->cssClass;
    }

    /**
     * get list of Amhsoft_Widget_Menu_Item
     * @return array List of Amhsoft_Widget_Menu_Item
     */
    public function GetItems() {
        return $this->items;
    }

    /**
     * check if given MEnuItem already exists in item list
     * @param Amhsoft_Widget_Menu_Item $item Amhsoft_Widget_Menu_Item to check for existence in item list
     * @return boolean true if given MEnuItem already exists in item list
     */
    public function Contains(Amhsoft_Widget_Menu_Item $item) {
        return in_array($item, $this->items);
    }

    /**
     * remove given item from item list
     * @param Amhsoft_Widget_Menu_Item $item item to remove from item list
     */
    public function RemoveItem(Amhsoft_Widget_Menu_Item $item) {
        $cnt = count($this->items);
        for ($i = 0; $i < $cnt; $i++) {
            if ($item->Equals($this->items[$i])) {
                unset($this->items[$i]);
                break;
            }
        }
    }

    /**
     * check if item has child items
     * @return boolean true if item has child items
     */
    private function HasItems() {
        return (count($this->items) > 0);
    }

    /**
     * remove all child items
     */
    public function RemoveAllItems() {
        $this->items = array();
    }

    /**
     * Check for true, if given item equals this item, false otherwise.
     * @param Amhsoft_Widget_Menu_Item $item
     * @return boolean True, if given item equals this item, false otherwise.
     */
    public function Equals(Amhsoft_Widget_Menu_Item $item) {
        return (trim(strtolower($this->label)) == trim(strtolower($item->label)));
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {
        $html = '';
        $iconHtml = $this->icon ? '<img src="' . $this->icon . '" />' : null;
        $first = $this->first ? ' first' : null;
        $last = $this->last ? ' last' : null;
        $current = $this->current ? ' current' : null;
        if (!$this->HasItems()) {
            $html .= '<li><a class="menuitem' . $first . $last . $current . '" href="' . $this->link . '">' . $iconHtml . $this->label . '</a></li>' . PHP_EOL;
        } else {
            $html .= '<li><a class="menuitem' . $first . $last . $current . '" href="' . $this->link . '">' . $iconHtml . $this->label . '</a>' . PHP_EOL;
            $html .= '<ul class="subnav">' . PHP_EOL;
            foreach ($this->items as $item) {
                $html .= $item->Render();
            }
            $html .= '</ul>' . PHP_EOL;
            $html .= '</li>' . PHP_EOL;
        }
        return $html;
    }

    /**
     * get label text of item
     * @return string label-text of item
     */
    public function getLabel() {
        return $this->label;
    }

    /**
     * set label text of item
     * @param string $label label-text of item
     */
    public function setLabel($label) {
        $this->label = $label;
    }

    /**
     * get link value of item
     * @return string link value of item
     */
    public function getLink() {
        if (version_compare(PHP_VERSION, '5.2.3', '<')) {
            return htmlspecialchars($this->link, ENT_QUOTES, 'UTF-8');
        } else {
            return htmlspecialchars($this->link, ENT_QUOTES, 'UTF-8', false);
        }
    }

    /**
     * set link value of item
     * @param string $link link value of item
     */
    public function setLink($link) {
        $this->link = $link;
    }

}
