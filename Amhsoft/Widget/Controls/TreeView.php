<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: TreeView.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_TreeViewControl_Control
 *
 * @author cherif
 */
class Amhsoft_TreeViewControl_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {
    protected $tree;

    
     public function setDataSource($DataSource) {
        $this->tree->setDataSource($DataSource);
    }
    

    public function Render() {
        return $this->Draw();
    }

    public function Draw() {
        return '<style>ul#treeview {margin:0; padding:0}#treeview li {list-style:none;}</style><div style="background:#e8e8e8; width: 320px; height: 160px; overflow:scroll; margin:0; border:1px solid #ccc">'.$this->tree->Render().'</div>';
    }
    
    

}

class CheckBoxAmhsoft_TreeViewControl_Control extends Amhsoft_TreeViewControl_Control {

    protected $checkedValues = array();

    public function __construct($name, $nodeName, $DataBinding) {
        parent::__construct($name, null);
        $this->tree = new Tree($name);
        
        $node = new CheckBox($nodeName);
        
        $node->DataBinding = $DataBinding;
        $this->DataBinding = $DataBinding;
        $this->tree->setCheckedValues($this->checkedValues);
        $this->tree->setNode($node);
    }

    public function setCheckedValues($array) {
        $this->tree->setCheckedValues($array);
    }
    
   public function getTreeValue(){
       return $this->tree->Value;
   }
    
   
    
    

}

?>
