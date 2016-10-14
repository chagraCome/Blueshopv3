<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Panel.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Control Amhsoft_Panel_Widget
 * @author Amir Cherif
 * @author Thomas Häber
 */
class Amhsoft_Widget_Panel extends Amhsoft_Widget_Container implements Amhsoft_Widget_Interface {

    /** @var string label text of panel */
    private $Label;

    /** @var string tag name of panel (default: fieldset, div ...) */
    private $TagName;

    /** @var string width attribute value */
    private $Width = '100%';

    /** @var string class attribute value */
    private $Class;

    /** @var integer cellpadding attribute value */
    private $Cellpadding = 0;

    /** @var integer cellspacing attribute value */
    private $Cellspacing = 6;

    /** @var string style attribute value */
    private $DockStyle = 'panel-div';

    /** @var string style attribute value of fieldset */
    private $Style;

    /** @var string id-tag of control panel */
    public $Id;

    /** @var Layout layout of the panel for example GridLayout */
    private $layout;
    private $render;
    public $Name;

    /**
     * Construct Amhsoft_Panel_Component
     * @param string $label label text of panel
     * @param string $name tag name of panel (default: fieldset, div ...)
     */
    public function __construct($label = null, $tagName = 'fieldset') {
        $this->Label = $label;
        $this->TagName = $tagName;
        $this->components = new ArrayIterator();
        
    }

    /**
     * get components as ArrayIterator of Amhsoft_Container_Control child classes
     * @return ArrayIterator Iterator of Amhsoft_Container_Control child classes
     */
    public function getComponents() {
        return $this->components;
    }

    public function setLayout(Amhsoft_Widget_Interface $layout) {
        $this->layout = $layout;
    }

    public function setRender(Amhsoft_Widget_Panel_Render_Abstract $render) {
        $this->render = $render;
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {

        if ($this->components->count() == 0) {
            return;
        }

        $event = 'before.render.' . get_class($this);
        Amhsoft_Event_Handler::trigger($event, $this, null);

        
        
        if ($this->render) {
            return $this->render->Render();
        }

       
         if ($this->layout instanceof Amhsoft_Abstract_Layout) {
            $panel_style = null;
            $this->layout->setComponents($this->components);
            $id_string = $this->Id  ? ' id="'.$this->Id.'"' : null;
            return $this->Label ? '<fieldset ' . $panel_style . $id_string.'><legend>' . $this->Label . '</legend>' . PHP_EOL . $this->layout->Render() . PHP_EOL . '</fieldset>' : $this->layout->Render();
        }
       
        
        $this->render = new Amhsoft_Widget_Panel_Render_Default_Render($this);
        return $this->render->Render();
    }

    /**
     * get id-tag of control panel
     * @return string id-tag of control panel
     */
    public function getId() {
        return $this->Id;
    }

    /**
     * set id-tag of control panel
     * @param string $Id id-tag of control panel
     */
    public function setId($Id) {
        $this->Id = $Id;
    }

    /**
     * get label of panel
     * @return string label of panel
     */
    public function getLabel() {
        return $this->Label;
    }

    /**
     * set label of panel
     * @param string $Label label of panel
     */
    public function setLabel($Label) {
        $this->Label = $Label;
    }

    /**
     * get tag name of panel (default: fieldset, div ...)
     * @return string tag name of panel (default: fieldset, div ...)
     */
    public function getTagName() {
        return $this->TagName;
    }

    /**
     * set tag name of panel (default: fieldset, div ...)
     * @param <type> $Name tag name of panel (default: fieldset, div ...)
     */
    public function setTagName($TagName) {
        $this->TagName = $TagName;
    }

    /**
     * get width value of panel
     * @return string get width attribute value of panel
     */
    public function getWidth() {
        return $this->Width;
    }

    /**
     * set width attribute value of panel
     * @param <type> $Width width attribute value of panel
     */
    public function setWidth($Width) {
        $this->Width = $Width;
    }

    /**
     * get class attribute value
     * @return string class attribute value
     */
    public function getClass() {
        return $this->Class;
    }

    /**
     * set class attribute value of panel
     * @param string $Class class attribute value
     */
    public function setClass($Class) {
        $this->Class = $Class;
    }

    /**
     * get cellpadding attribute value
     * @return integer cellpadding attribute value
     */
    public function getCellpadding() {
        return $this->Cellpadding;
    }

    /**
     * set cellpadding attribute value
     * @param integer $Cellpadding cellpadding attribute value
     */
    public function setCellpadding($Cellpadding) {
        $this->Cellpadding = $Cellpadding;
    }

    /**
     * get cellspacing attribute value
     * @return integer cellspacing attribute value
     */
    public function getCellspacing() {
        return $this->Cellspacing;
    }

    /**
     * set cellspacing attribute value
     * @param integer $Cellspacing cellspacing attribute value
     */
    public function setCellspacing($Cellspacing) {
        $this->Cellspacing = $Cellspacing;
    }

    /**
     * get style attribute value
     * @return string style attribute value
     */
    public function getDockStyle() {
        return $this->DockStyle;
    }

    /**
     * set style attribute value
     * @param string $DockStyle style attribute value
     */
    public function setDockStyle($DockStyle) {
        $this->DockStyle = $DockStyle;
    }

    /**
     * Get style attribute value of panel.
     * @return string Style attribute value.
     */
    public function getStyle() {
        return $this->Style;
    }

    /**
     * Set style attribute value of panel.
     * @param string $Style Style attribute value of panel.
     */
    public function setStyle($Style) {
        $this->Style = $Style;
    }

    /**
     *
     * @return boolean
     */
    public function isUseDivAmhsoft_Container_Control() {
        return $this->useDivAmhsoft_Container_Control;
    }

    /**
     *
     * @param boolean $useDiv
     */
    public function setUseDiv($useDivAmhsoft_Container_Control) {
        $this->useDiv = $useDivAmhsoft_Container_Control;
    }

}

