<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: RadioBox.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * input component
 * @author Amir Cherif
 */
class Amhsoft_Group_RadioBox_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    private $options = array();

    /** @var DataSorce $DataSource */
    public $DataSource;

    public function __construct($name, $label = null) {
        parent::__construct($name);
        $this->Label = $label;
        $this->Id = $this->Name;
    }

    public function addOption(Amhsoft_RadioBox_Control $option) {
        $option->Name = $this->Name;
        $option->Checked = ($this->Value == $option->Value);
        $this->options[] = $option;
    }

    public function addOptionValues($label, $value) {
        $option = new Amhsoft_RadioBox_Control($this->Name);
        $option->Label = $label;
        $option->Value = $value;
        $option->Id = 'option_' . $value;
        $this->addOption($option);
    }

    public function Render() {

        if ($this->DataSource instanceof Amhsoft_Data_Set) {
            $this->DataSource->rewind();

            for ($this->DataSource->rewind(); $this->DataSource->valid(); $this->DataSource->next()) {

                if ($this->Value == '') {
                    $this->Value = $this->DataBinding->SelectedItem;
                }

                if ($this->DataBinding->Text == null) {
                    $option = new Amhsoft_RadioBox_Control($this->Name);
                    $option->Label = $this->DataSource->current();
                    $option->Value = $this->DataSource->current();
                    $option->Id = 'option_' . $option->Value;
                    $this->addOption($option);
                } else {
                    $option = new Amhsoft_RadioBox_Control($this->Name);
                    $option->Label = $this->DataSource[$this->DataBinding->Text];
                    $option->Value = $this->DataSource[$this->DataBinding->Index];
                    $option->Id = 'option_' . $option->Value;
                    $this->addOption($option);
                }
            }
        }



        foreach ($this->options as $option) {
            if ($this->Required) {
                $option->Class = ($option->Class != null) ? $option->Class . ' required' : 'required';
                
            }
           
            $str .= '<label for="' . $option->Id . '">' . $option->Render() . ' ' . $option->Label . '</label>';
        }
        if($this->ToolTip){
            return $str. '<span class="error">'.$this->ToolTip.'</span>';
        }else{
            return $str;
        }
    }

    public function Draw() {
        return $this->Render();
    }

}
?>

