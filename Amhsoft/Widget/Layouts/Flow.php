<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Flow.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Flow_Layout extends Amhsoft_Abstract_Layout implements Amhsoft_Widget_Interface {

    /** @var array components in this layout */
    private $components = array();

    /** @var boolean left to right */
    private $ltr = true;

    /** @var integer spacing */
    private $spacing = 0;

    /**
     *
     * @param ooolean $horizontal
     */
    public function __construct() {
        $this->components = new ArrayIterator();
    }

    /**
     * Get the number of columns in this layout.
     */
    public function getColumns() {
        return count($this->components);
    }

    public function addComponent(Amhsoft_Widget_Interface $component) {
        if ($component !== $this) {
            $this->components->offsetSet($component);
        }
    }

    public function hasComponent(Amhsoft_Widget_Interface $component) {
        return ($this->components->contains($component)) ? true : false;
    }

    public function removeComponent(Amhsoft_Widget_Interface $component) {
        if ($this->hasComponent($component)) {
            $this->components->detach($component);
        }
    }

    public function setComponents(ArrayIterator $components) {
        $this->components = $components;
    }

    public function getComponents() {
        return $this->components;
    }

    public function isLtr() {
        return $this->ltr;
    }

    public function setLtr($ltr) {
        $this->ltr = $ltr;
    }

    public function getSpacing() {
        return $this->spacing;
    }

    public function setSpacing($spacing) {
        $this->spacing = $spacing;
    }

    public function Render() {
        $this->components->rewind();
        $spacing = ($this->spacing > 0) ? 'border-spacing:' . $this->spacing . 'px"' : '';
        $ltr = ($this->ltr == true) ? ' dir="ltr"' : ' dir="rtl"';
        $out = '<div style="margin:0; width:100%;' . $spacing . '">';
        $cnt = $this->components->count();

        for ($i = 0; $i < $cnt; $i++) {
            if ($i == 0) {
                $out .= '<span style="margin:0px">';
            } else {
                $out .= '<span style="margin: 0 10px">';
            }
            if ($this->components->valid()) {
                if ($this->components->current() instanceof Amhsoft_CheckBox_Control) {
                    $out .= '<span>';
                    $out .= '<label for="' . $this->components->current()->Id . '">' . $this->components->current()->Render() . ' ' . $this->components->current()->Label . '</label>';
                    $out .= '</span>';
                } else {
                    $out .= '<span>' . $this->components->current()->getLabel() . ' ' . $this->components->current()->Render() . '</span>';
                }
            }
            $out .= '</span>';
            $this->components->next();
        }

        $out .= '</div>';

        return $out;
    }

}
