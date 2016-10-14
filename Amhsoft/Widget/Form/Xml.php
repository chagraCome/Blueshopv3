<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_Widget_Form_Xml extends Amhsoft_Widget_Form {

  protected $xmlObject;

  public function __construct($xmlfile) {
    $this->xmlObject = simplexml_load_file($xmlfile);
    parent::__construct($this->xmlObject['name'], $this->xmlObject['method']);
    $this->initializeComponents();
  }

  public function initializeComponents() {

    foreach ($this->xmlObject->panel as $xpanel) {
      $panelName = (string) $xpanel['name'];
      $this->{$panelName} = new Amhsoft_Widget_Panel($xpanel['label']);
      foreach ($xpanel->widget as $widget) {
        $class = (string) $widget['type'];
        $controlName = (string) $widget['name'];
        if ($class == 'Amhsoft_Html_Control') {
          $this->{$controlName} = new $class(@$widget['html']);
        } elseif ($class == 'Amhsoft_YesNo_ListBox_Control') {
          $this->{$controlName} = new $class($controlName, (string) @$widget['label'], $controlName);
          $this->{$controlName}->WithNullOption = @$widget['WithNullOption'];
        } else {
          $this->{$controlName} = new $class($controlName);
        }
        if (isset($widget['id'])) {
          $this->{$controlName}->setId((string) $widget['id']);
        } else {
          $this->{$controlName}->setId($controlName);
        }

        $this->{$controlName}->setLabel(_t((string) $widget['label']));
        $this->{$controlName}->setRequired((int) $widget['required']);
        $this->{$controlName}->addValidator((string) $widget['validator']);
        $this->{$controlName}->setWidth((string) $widget['width']);
        $this->{$controlName}->Value = ((string) $widget['value']) ? ((string) $widget['value']) : ((string) $widget['default']);

        $this->{$controlName}->DataBinding = new Amhsoft_Data_Binding($controlName);

        if ($class == 'Amhsoft_ListBox_Control') {
          if (isset($widget->datasource)) {
            $data = array();
            foreach ($widget->datasource as $src) {
              $data[] = array('id' => (string) $src['id'], 'text' => _t((string) $src['text']));
            }
            $this->{$controlName}->DataSource = new Amhsoft_Data_Set($data);
            $this->{$controlName}->DataBinding->Index = 'id';
            $this->{$controlName}->DataBinding->Text = 'text';
          }
        }

        if ($class == 'Amhsoft_YesNo_ListBox_Control') {
          $this->{$controlName}->DataBinding->Index = 'id';
          $this->{$controlName}->DataBinding->Text = 'name';
        }

        $this->$panelName->addComponent($this->{$controlName});
      }
      $this->addComponent($this->$panelName);
    }
  }

}

?>
