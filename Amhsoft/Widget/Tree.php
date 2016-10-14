<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Tree.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Tree class.
 */
class Amhsoft_Widget_Tree extends Amhsoft_Widget_Container implements Amhsoft_Widget_Interface {

  /** @var string id-name of control */
  public $Name;
  /** @var Amhsoft_Widget_Interface $node */
  protected $node;
  protected $Id = 'treeview';
  protected $NodeName;
  protected $checkedValues = array();
  

  /**
   * Construct tree control.
   * @param string $name id-name of control
   */
  public function __construct($nodeName = null) {
    $this->NodeName = $nodeName;
    $this->components = new ArrayIterator();

  }
  
  public function setCheckedValues($array){
      $this->checkedValues = $array;
  }

  /**
   * @return string $tagName
   */
  public function getTagName() {
    return $this->Id;
  }

  /**
   * @return String $label
   */
  public function getLabel() {
    return $this->Name;
  }

  /**
   * Sets Node.
   * @param Amhsoft_Widget_Interface $component 
   */
  public function setNode(Amhsoft_Widget_Interface $component) {
    $this->node = $component;
  }

  /**
   * Add new component for Tree.
   * @param Amhsoft_Widget_Interface $component New component for Tree.
   */
  public function addComponent(Amhsoft_Widget_Interface $component) {
    $this->components->append($component);
  }

  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Render() {
      
    $style = ($this->Id) ? 'id="treeview"': null;
    $html = '<ul '.$style.'>' . PHP_EOL;
   $this->node->Id = null;
    if (isset($this->node->Href)) {
      $nodeHref = (!isset($nodeHref)) ? ($this->node->Href . '&' . $this->node->DataBinding->Index . '=') : null;
    }
    
   
    foreach ($this->DataSource as $source) {
      if ($this->node instanceof Amhsoft_CheckBox_Control) {
        $this->node->Value = $source->{$this->node->DataBinding->Index};
        if(in_array($this->node->Value, $this->checkedValues)){
            $this->node->Checked=true;
        }else{
            $this->node->Checked=false;
        }
    
        $this->node->Index = $source->{$this->node->DataBinding->Index};
        $this->node->Name = $this->NodeName . '[]';
        $html .= '<li>' . $this->node->Render() .'&nbsp;'. $source->{$this->node->DataBinding->Text};
      } elseif ($this->node instanceof Link) {
        $this->node->Label = $source->{$this->node->DataBinding->Value};
        $this->node->Href = $nodeHref . $source->{$this->node->DataBinding->Index};
        $html .= '<li>' . $this->node->Render();
      } else {
        $this->node->Value = $source->{$this->node->DataBinding->Value};
        $html .= '<li>'. $this->node->Render();
      }
      
      $children = $source->getChildern();
      if (count($children)) {
        $t = new Amhsoft_Widget_Tree();
        $t->setCheckedValues($this->checkedValues);
        $t->NodeName = $this->NodeName;
        $t->Id = null;
        $t->setNode($this->node);
        
        $t->setDataSource(new Amhsoft_Data_Set($children));
        $html .= $t->Render() . PHP_EOL;
        
      }
      $html .= '</li>' . PHP_EOL;
      
    }
    
    $html .= '</ul>' . PHP_EOL;
   
    
    return $html;
  }

}
