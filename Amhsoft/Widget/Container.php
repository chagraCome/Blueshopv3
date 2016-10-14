<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Container.php 456 2016-02-25 14:19:21Z amira.amhsoft $
 * $Revision: 456 $
 * $LastChangedDate: 2016-02-25 15:19:21 +0100 (jeu., 25 févr. 2016) $
 * $LastChangedBy: amira.amhsoft $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Amhsoft_Widget_Container class
 * @authir Amir Cherif
 */
abstract class Amhsoft_Widget_Container {

    /** @var array of Amhsoft_Abstract_Control components */
    protected $components;

    /** @var Amhsoft_Data_Source datasource */
    public $DataSource;

    /**
     * Gets Components.
     * @return array of Amhsoft_Abstract_Control.
     */
    public function getComponents() {
        return $this->components;
    }

    /**
     * Set Components.
     * @param array $components
     */
    public function setComponents(array $components) {
        $this->components = $components;
    }

    /**
     * Remove component by giving index
     * @param int $index
     */
    public function removeComponentAt($index) {
        unset($this->components[$index]);
// $this->components = array_values($this->components);
    }

    /**
     * Gets datasource.
     * @return Amhsoft_Data_Source $datasource
     */
    public function getDataSource() {
        return $this->DataSource;
    }

    /**
     * Sets the datasource
     * @param Amhsoft_Data_Source $DataSource 
     * @return Amhsoft_Widget_Container Description
     */
    public function setDataSource($DataSource) {
        $this->DataSource = $DataSource;
        return $this;
    }

    /**
     * add a component to container.
     * @param Amhsoft_Widget_Interface $component
     * @return Amhsoft_Widget_Container
     */
    public function addComponent(Amhsoft_Widget_Interface $component) {
        $this->components->append($component);
        return $this;
    }

    /**
     * Remove component by giving index alias to removeComponentAt
     * @param int $index
     * @return Amhsoft_Widget_Container container
     */
    public function removeColumnAt($index) {
        unset($this->components[$index]);
        return $this;
    }

    /**
     * Find component by name
     * @param string $name
     * @return \Amhsoft_Widget_Container|null
     */
    public function findByName($name) {
        foreach ($this->components as $component) {
            if ($component instanceof Amhsoft_Widget_Container) {
                return $component->findByName($name);
            } else {
                if ($component->Name == $name) {
                    return $component;
                }
            }
        }
        return null;
    }

    /**
     * Remove component by name.
     * @param string $name
     * @return Amhsoft_Widget_Container
     */
    public function removeByName($name) {
        $i = 0;
        foreach ($this->components as $component) {
            if ($component instanceof Amhsoft_Widget_Container) {
                $component->removeByName($name);
            } else {
                if ($component->Name == $name) {
                    $this->removeComponentAt($i);
                }
            }
            $i++;
        }
        return $this;
    }

    /**
     * Add a component collection
     * @param array $components
     * @return Amhsoft_Widget_Container container
     */
    public function addComponents(array $components) {
        $this->components = new ArrayIterator($components);
        return $this;
    }

    /**
     * reset values of the container
     * @return Amhsoft_Widget_Container container
     */
    public function reset() {
        $this->components->rewind();
        while ($this->components->valid()) {
            $this->components->current()->Value = null;
        }
        return $this;
    }

    /**
     * bind components of the container with values.
     * @see Amhsoft_Widget_Container::bind()
     */
    public function fill() {
        $this->Bind();
    }

    /**
     * bind components of the container with values.
     */
    public function Bind() {
        $this->components->rewind();
        foreach ($this->components as $component) {
            if ($component instanceof Amhsoft_Widget_Container) {
//if ($component->DataSource == null) {
                $component->setDataSource($this->DataSource);
                @$component->Bind();
//}
            } else {
                if (isset($component->DataBinding)) {
					if ($component instanceof Amhsoft_ListBox_Control && $component->multiple) {
                    $component->selectedItems = @$this->DataSource[$component->DataBinding->Value];
                    } 
                    if ($component instanceof Amhsoft_TreeViewControl_Control) {
                        $component->setCheckedValues($component->Value);
                    }  elseif ($component instanceof Amhsoft_CheckBox_Control) {
                        if (substr($component->DataBinding->Value, -1) == ']') {
                            $binding = substr($component->DataBinding->Value, 0, -2);
                            if (in_array($component->Value, $this->DataSource[$binding])) {
                                $component->Checked = true;
                            } else {
                                $component->Checked = false;
                            }
                        } else {
                            if (isset($this->DataSource[$component->DataBinding->Value]) && $component->Value == $this->DataSource[$component->DataBinding->Value]) {
                                $component->Checked = true;
                            } else {
                                $component->Checked = false;
                            }
                        }
                    } elseif ($component instanceof Amhsoft_DirectoryInput_Control) {
                        if (isset($this->DataSource[$component->DataBinding->Value])) {
                            $component->Value = $this->DataSource[$component->DataBinding->Value];
                        }
                        if (isset($this->DataSource[$component->DataBinding->Text])) {
                            $component->HiddenValue = $this->DataSource[$component->DataBinding->Text];
                        }
                    } elseif ($component instanceof Amhsoft_FileInput_Control) {
                        $component->Value = isset($_FILES['trigger_' . $component->Name]) ? $_FILES['trigger_' . $component->Name] : NULL;
                    } else {
                        if (isset($this->DataSource[$component->DataBinding->Value])) {
                            $component->Value = $this->DataSource[$component->DataBinding->Value];
                        }
                    }
                }
            }
        }
    }

    /**
     * validate the container.
     * @return boolean $valid.
     */
    public function Validate() {
        $valid = true;
        $this->components->rewind();
        foreach ($this->components as $component) {
            if ($component instanceof Amhsoft_Button_Submit_Control) {
                continue;
            }
            if ($component instanceof Amhsoft_Widget_Container) {
                $valid &= $component->Validate();
            } else {
                if ($component instanceof Amhsoft_Abstract_Control && (count($component->getValidators()) > 0 || $component->getRequired() == true)) {
                    $valid &= $component->Validate();
                }
            }
        }


        if (!$this instanceof Amhsoft_Widget_Panel) {
            $req = new Amhsoft_Web_Request();
            $token = $req->post('sec_nekot');
            if (Amhsoft_Common::CsrfValidateToken($this->getName(), $token) == true) {
                return $valid &= true;
            } else {
                return $valid &= false;
            }
        }




        return (bool) $valid;
    }

    /**
     * Validate the form
     * @return bool True when the form is valud
     */
    public function isValid() {
        return $this->Validate();
    }

    /**
     * @param template $t 
     */
    public function ToTemplate(&$t) {
        $this->components->rewind();
        while ($this->components->valid()) {
            $t->assign($this->components->current()->Name, $this->components->current());
            $this->components->next();
        }
    }

    /**
     * Gets data from container.
     * @return array $data
     */
    public function getData(&$data) {

        foreach ($this->components as $component) {

            if ($component instanceof Amhsoft_Button_Submit_Control || $component instanceof Link) {
                continue;
            }
            if ($component instanceof Amhsoft_Widget_Panel) {
//array_merge($this->data, $this->components->current()->getData());
                $component->getData($data);
                continue;
            } else {
                if (!$component->Name) {
                    continue;
                }
// if(isset($this->components->current()->DataBinding->Value)){
                if ($component instanceof Amhsoft_CheckBox_Control) {
                    $data[$component->Name] = $component->Checked;
                } elseif ($component instanceof Amhsoft_DirectoryInput_Control) {
                    if ($component->Value != '') {
                        $data[$component->DataBinding->Text] = $this->DataSource[$component->DataBinding->Text];
                    } else {
                        @$data[$component->DataBinding->Text] = '';
                        $data[$component->Name] = '';
                    }
                } elseif ($component instanceof Amhsoft_Currency_Input_Control) {
                    $c_value = strval(floatval($component->Value));
                    if (!strcmp($c_value, $component->Value)) {
                        $component->Value = str_replace(Amhsoft_Locale::getThousandSep(), '', $component->Value);
                        $component->Value = str_replace(Amhsoft_Locale::getDecimalSep(), '.', $component->Value);
                    }

                    $component->Value = $component->Value / Amhsoft_Locale::getRate();

                    $data[$component->Name] = $component->Value;
                } elseif ($component instanceof Amhsoft_FileInput_Control) {
                    $data[$component->Name] = null;
                } else {
                    $data[$component->Name] = $component->Value;
                }
// }
            }
        }
        return $data;
    }

}
