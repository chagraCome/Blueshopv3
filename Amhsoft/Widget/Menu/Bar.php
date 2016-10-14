<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Bar.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Control MainMenu
 * @author Amir cherif
 * @author Thomas Häber
 */
class Amhsoft_Widget_Menu_Bar implements Amhsoft_Widget_Interface {

    /** @var array list of Amhsoft_Widget_Menu_Item */
    private $items = array();


    private $label;
    private $cssClass = "topnav";
    private $labelClass = 'label_class';

    

    public function setLabel($label) {
        $this->label = $label;
    }

    public function getLabel() {
        return $this->label;
    }

    public function setCssClass($class) {
        $this->cssClass = $class;
    }

    public function getCssClass() {
        return $this->cssClass;
    }
    
    public function getLabelClass() {
        return $this->labelClass;
    }

    public function setLabelClass($labelClass) {
        $this->labelClass = $labelClass;
    }

    
    /**
     * add item to menu
     * @param Amhsoft_Widget_Menu_Item $item item for menu
     * @param integer $sortid sorting position of new item
     * @return MainMenu instance of MainMenu
     */
    public function AddItem(Amhsoft_Widget_Menu_Item $item, $sortid = null) {
        if (!$this->Contains($item)) {
            if ($sortid != null)
               $this->items[$sortid] = $item;
            else
               $this->items[] = $item;
        }
        return $this;
    }

    /**
     * get list of Amhsoft_Widget_Menu_Item of MainManu
     * @return array List of Amhsoft_Widget_Menu_Items
     */
    public function GetItems() {
        return $this->items;
    }

    /**
     * checks of given item is in menu
     * @param Amhsoft_Widget_Menu_Item $item
     * @return boolean true if item in menu
     */
    public function Contains(Amhsoft_Widget_Menu_Item $item) {
        return in_array($item,$this->items);
    }

    /**
     * remove given item from menu list
     * @param Amhsoft_Widget_Menu_Item $item item to remove from menu list
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
     * get item with given label title
     * @param string $label
     * @return Amhsoft_Widget_Menu_Item Item with fitting label
     */
    public static function GetItem($label) {
        if ($label == '') {
            return null;
        }
        foreach ($this->items as $item) {
            if (trim(strtolower($item->getLabel())) == trim(strtolower($label))) {
                return $item;
            }
        }
    }

    /**
     * remove all items from list
     */
    public function RemoveAllItems() {
       $this->items = array();
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {      
      $id = 'menu-left-'.md5($this->label);
        $html = "";
        if ($this->label) {
            $html .= '<h3 class="'.$this->getLabelClass().'" id="'.$id.'">' . $this->getLabel() . '</h3>';
        }
        $html .= '<ul class="' . $this->getCssClass() . '">' . PHP_EOL;
        $keys = array_keys($this->items);
        sort($keys);
        foreach ($keys as $i) {
            $html .=$this->items[$i]->Render();
        }
        $html .= '</ul>';

        return $html;
    }

}
