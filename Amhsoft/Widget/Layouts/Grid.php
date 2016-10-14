<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Grid.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Grid_Layout extends Amhsoft_Abstract_Layout implements Amhsoft_Widget_Interface {

  /** @var integer rows / line */
  private $rows = 1;

  /** @var integer cols / columns */
  private $cols = 1;

  /** @var array components in this layout */
  private $components = array();

  /** @var boolean left to right */
  private $ltr = null;

  /** @var integer spacing */
  private $spacing = 0;
  private $width = 'auto';
  private $appendMode;

  /**
   *
   * @param integer $cols
   * @param integer $appendmode
   */
  public function __construct($cols, $appendModel = NULL) {
    $this->components = new ArrayIterator();
    $rows = 1;
    $cols = intval($cols);
    if ($rows > 0) {
      $this->rows = $rows;
    }
    if ($cols > 0) {
      $this->cols = $cols;
    }
    $this->appendMode = $appendModel;
  }

  public function setAppendMode($mode) {
    $this->appendMode = $mode;
  }

  public function setWidth($width) {
    $this->width = $width;
  }

  /**
   * Get the number of columns in this layout.
   */
  public function getColumns() {
    return count($this->components);
  }

  public function addComponent(Amhsoft_Widget_Interface $component) {
    if ($component !== $this) {
      $this->components->append($component);
    }
  }

  public function hasComponent(Amhsoft_Widget_Interface $component) {
    return (in_array($component, $this->components)) ? true : false;
  }

  public function removeComponent(Amhsoft_Widget_Interface $component) {
    if ($this->hasComponent($component)) {
      $index = array_search($component, $this->components);
      $this->components->offsetUnset($index);
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

  public function setRtl($rtl) {
    $this->ltr = !$rtl;
  }

  public function getSpacing() {
    return $this->spacing;
  }

  public function setSpacing($spacing) {
    $this->spacing = $spacing;
  }

  public function Render() {
    if ($this->components->count() == 0) {
      return;
    }


    $rows = ceil($this->components->count() / $this->cols);
    $this->rows = $rows;

    $this->components->rewind();
    $spacing = ($this->spacing > 0) ? 'border-spacing:' . $this->spacing . 'px"' : '';
    $ltr = null;
    if ($this->ltr !== null) {
      $ltr = ($this->ltr == true) ? ' dir="ltr"' : ' dir="rtl"';
    }

    $out = '<table  style="width:' . $this->width . ';' . $spacing . '"' . $ltr . '>';
    $cnt = $this->components->count();


    for ($r = 0; $r < $this->rows && $r < $cnt; $r++) {
      $out .= '<tr>';
      $cell_width = floor(intval($this->width) / $this->cols);
      if (preg_match('/%/', $this->width)) {
        $cell_width = $cell_width . "%";
      }

      if ($cell_width == 0)
        $cell_width = 'auto';

      for ($c = 0; $c < $this->cols && ($c + $r) < $cnt; $c++) {

        $out_width = (($c + 1) < $this->cols) ? ' width="' . $cell_width . '"' : 'width="auto"';

        $out .= '<td  valign="top"' . $out_width . '>';

        if ($this->components->valid()) {
          if ($this->components->current() instanceof Amhsoft_Widget_Container) {
            $out .= $this->components->current()->Render();
            $this->components->next();
            continue;
          }
          if ($this->appendMode == Amhsoft_Abstract_Layout::APPEND) {
            if ($this->components->current() instanceof Amhsoft_CheckBox_Control || $this->components->current() instanceof Amhsoft_RadioBox_Control) {
              $out .= '<div class="panel-div">';
              $out .= '<label for="' . $this->components->current()->Id . '"><br />' . $this->components->current()->Render() . ' ' . $this->components->current()->Label . '</label>';
              $out .= '</div>';
            } elseif ($this->components->current() instanceof Amhsoft_DirectoryInput_Control) {
              $out .= '<div class="panel-div">';
              $out .= '<label for="' . $this->components->current()->Name . '"><br />' . $this->components->current()->Label . ' ' . $this->components->current()->Render() . '</label>';
              $out .= '</div>';
            } else {
              $out .= '<div class="panel-div">';
              if ($this->components->current()->Label) {
                $out .= '<label for="' . $this->components->current()->Name . '">' . $this->components->current()->Label . ':</label>';
              }
              $out .= $this->components->current()->Render();
              $out .= '</div>';
            }
          } else {

            if ($this->components->current() instanceof Amhsoft_Link_Control || $this->components->current() instanceof Amhsoft_Button_Submit_Control) {
              $out .= '<span ' . $ltr . '>' . $this->components->current()->Render() . '</span>';
            }elseif ($this->components->current() instanceof Amhsoft_CheckBox_Control || $this->components->current() instanceof Amhsoft_RadioBox_Control) {
              $out .= '<div class="panel-div">';
              $out .= '<label for="' . $this->components->current()->Id . '">' . $this->components->current()->Render() . ' ' . $this->components->current()->Label . '</label>';
              $out .= '</div>';
            } else {
              $label = ($this->components->current()->Label == '') ? '' : $this->components->current()->Label . ': ';
              $out .= '<span ' . $ltr . ' style="display: inline-block ;min-width: 110px; ">' . $label .'</span>'. $this->components->current()->Render();
            }
          }
        }
        $out .= '</td>';
        $this->components->next();
      }

      $out .= '</tr>';
    }

    $out .= '</table>';
    return $out;
  }

}
