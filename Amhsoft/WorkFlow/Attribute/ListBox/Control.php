<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Attribute_ListBox_Control extends Amhsoft_ComplexListBox_Control {

    private $regex;

    public function __construct($name, $bindingValue, $label = null, $regex = null, $sendValueTo = null) {
        parent::__construct($name, $label);
        $this->regex = $regex;
        $this->DataBinding = new Amhsoft_Data_Binding($bindingValue, 'var', 'text');
        $this->DataSource = new Amhsoft_Data_Set($this->getVariableSource());
        if ($sendValueTo != null) {
            $this->JavaScript = 'document.getElementById(\''.$sendValueTo.'\').value += this.value+ \',\'';
        }
    }

    public function getVariableSource() {
        $publishedModels = Amhsoft_System::getPublishedModels();
        if (empty($publishedModels)) {
            return array();
        }

        $source = array();
        foreach ($publishedModels as $model) {
            while (list($alias, $attributes) = each($model)) {
                if ($this->regex != null) {
                    $_attributes = array();
                    foreach ($attributes as $key => $val) {
                        if (preg_match("/$this->regex/i", $key)) {
                            $_attributes[$key] = $val;
                        }
                    }
                    if (!empty($_attributes)) {
                        $source[] = array('var' => $alias, 'text' => $_attributes);
                    }
                } else {
                    $source[] = array('var' => $alias, 'text' => $attributes);
                }
            }
        }

        return $source;
    }

    public function Render() {
        return parent::Render();
    }

}

?>
