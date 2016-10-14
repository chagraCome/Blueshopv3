<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Filter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of ProductAttributeFilter
 *
 * @author cherif
 */
class Amhsoft_Widget_Filter {

    protected $availabelAttributeValues = array();
    protected $adapter;
    protected $components = array();
    protected $views = array();

    public function __construct(Amhsoft_Data_Db_Model_Adapter $adapter) {
        $this->adapter = clone $adapter;
    }

    private function getQueryParamsWithout($remove_key) {
        $array = array();
        foreach ((array) $_GET as $key => $val) {
            if ($key != $remove_key) {
                $array[$key] = $val;
            }
        }
        return $array;
    }

    private function getQueryParamsWithoutAsString($remove_key) {
        $array = $this->getQueryParamsWithout($remove_key);
        $str = '';
        foreach ($array as $key => $val) {
            if ($key == 'p')
                continue;
            $str .= $key . '=' . $val . '&';
        }
        return $str;
    }

    public function getQueryParamsOnlyAttributes() {
        $array = $this->getQueryParamsWithout(null);
        $attributes = array();
        foreach ((array) $array as $attribute_name => $attribute_value) {
            if (preg_match("/attr_/", $attribute_name)) {
                $attributes[str_replace("attr_", '', $attribute_name)] = $attribute_value;
            }
        }
        return $attributes;
    }

    protected function isAttributePresent($value, $attributeName) {
        return in_array($value, (array) @$this->availabelAttributeValues[$attributeName]);
    }

    public function getDistinct($attributeName, $adapter = null) {
        if ($adapter) {
            $sql = "SELECT DISTINCT($attributeName) as d  FROM (" . $adapter->selectSqlClause() . ") as t ";
        } else {
            $sql = "SELECT DISTINCT($attributeName) as d  FROM " . $this->adapter->getTable();
        }
        $re = Amhsoft_Database::getInstance()->query($sql);
        $re->execute();

        $source = array();
        while ($item = $re->fetch()) {
            if ($item['d']) {
                $source[] = $item['d'];
            }
        }
        return $source;
    }

    public function addComponent(Amhsoft_Widget_Filter_Abstract_Component $component) {
        $this->components[] = $component;
    }

    public function addUniqueFlat(Amhsoft_Widget_Filter_Component $component) {
        foreach ($this->getDistinct($component->getName()) as $item) {
            $component->addValue(new Amhsoft_Widget_Filter_Component_Value($item, $item));
        }
        $this->addComponent($component);
    }

    public function addCheckBox(Amhsoft_Widget_Filter_Component $component, $view) {
        $this->views[$view][] = $component;
    }

    
     protected function getCheckBoxComponentsFilter() {
        if (count($this->views) == 0) {
            return;
        }
        $str = null;
        list($view, $components) = each($this->views);

            foreach ($components as $component) {
                //if (in_array(1, (array) @$this->availabelAttributeValues[$attr->getName()])) {
                $attribute_in_query = Amhsoft_Web_Request::get('attr_' . $component->getName());
                $old_url = $this->getQueryParamsWithoutAsString('attr_' . $component->getName());
                $new_url = $old_url . '&attr_' . $component->getName() . '=' . 1;
                $checkBox = new Amhsoft_CheckBox_Control($component->getName(), $component->getLabel());

                if ($attribute_in_query && $attribute_in_query == 1) {
                    $checkBox->Checked = 1;
                    $link = '<a href="index.php?' . $old_url . '">';
                    $str .='<li>' . $link . $checkBox->Render() . ' ' . $checkBox->getLabel() . '</a></li>';
                } else {
                    $checkBox->Checked = 0;
                    $link = '<a style="text-decoration:none" href="index.php?' . $new_url . '">';
                    $str .='<li>' . $link . $checkBox->Render() . ' ' . $checkBox->getLabel() . '</a></li>';
                }
                //}
            }
            if ($str != null) {
                $str = '<h3 class="active">' .$view . '</h3><ul class="filter_ul" style="padding:5px">' . $str . '</ul>';
            }
  
        return $str;
    }
    
    public function getComponents() {
        return $this->components;
    }

    public function flat(Amhsoft_Widget_Filter_Abstract_Component $component) {
        $str = '';
        
        foreach ((array) $component->possibleValues as $source) {
            $src = $source->getId();
            $attribute_in_query = Amhsoft_Web_Request::get('attr_' . $component->getName());

            if ($this->isAttributePresent($src, $component->getName())) {
                $old_url = $this->getQueryParamsWithoutAsString('attr_' . $component->getName());
                $new_url = $old_url . '&attr_' . $component->getName() . '=' . $src;

                if ($attribute_in_query && $attribute_in_query == $src) {
                    $link = '<a href="index.php?' . $old_url . '">';
                    $str .='<li>' . $link . $source->getText() . '<img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
                } else {
                    $link = '<a href="index.php?' . $new_url . '">';
                    $str .='<li>' . $link . $source->getText() . '</a></li>';
                }
            } else {
                if (count($component->possibleValues) < 10) {
                    $link = '<a style="color:gray" class="disabled" href="#">';
                    $str .='<li>' . $link . $source->getText() . '</a></li>';
                }
            }
        }
        return $str;
    }

    public function getRenderedComponents(Amhsoft_Data_Db_Model_Adapter $adappter) {
        $this->adapter = $adappter;
        $str = '';
        foreach ((array) @$this->components as $component) {
            
            if($component instanceof  Amhsoft_widget_Filter_Html_Component){
                $str .= $component->Render();
                continue;
            }
            
            if (isset($this->availabelAttributeValues[$component->getName()]) && !empty($this->availabelAttributeValues[$component->getName()])) {
                continue;
            }

            $this->availabelAttributeValues[$component->getName()] = $this->getDistinct($component->getName(), $adappter);

            $str .='<h3 class="active">' . $component->getLabel() . '</h3><ul class="filter_ul" style="padding:5px">';
            $str .= $this->flat($component);
            $str .= '</ul>';
        }
        $str .= $this->getCheckBoxComponentsFilter();
        if ($str) {
            return '</ul>' . $str;
        } else {
            return $str;
        }
    }

//    public function calculateAttributes($stmt) {
//        $attributes = array();
//        $sql = "SELECT entity_set_id FROM (" . $stmt->getAdapter()->selectSqlClause() . ") as t group by entity_set_id ";
//        $setstmt = Amhsoft_Database::getInstance()->query($sql);
//        $setstmt->execute();
//        $sets = $setstmt->fetchAll(PDO::FETCH_ASSOC);
//
//        foreach ($sets as $s) {
//            $id = intval($s['entity_set_id']);
//            if ($id > 0) {
//                $attributeSetAdapter = new Eav_Set_Model_Adapter();
//                $set = $attributeSetAdapter->fetchById($id);
//                if ($set instanceof Eav_Set_Model) {
//                    
//                    $attributes = $set->getAttributes();
//                    foreach ($attributes as $attribute) {
//                        if ($attribute->isSearchable()) {
//
//                            if (isset($this->availabelAttributeValues[$attribute->getName()]) && !empty($this->availabelAttributeValues[$attribute->getName()])) {
//                                continue;
//                            }
//
//                            $this->availabelAttributeValues[$attribute->getName()] = $this->getDistinct($attribute->getName(), $stmt);
//
//                            if ($attribute->entity_attribute_type_backend_id == 9 || $attribute->entity_attribute_type_backend_id == 4) {
//                                if (!isset($this->attributeviews[$attribute->entity_set_view_id]) || !in_array($attribute, $this->attributeviews[$attribute->entity_set_view_id])) {
//                                    $this->attributeviews[$attribute->entity_set_view_id][] = $attribute;
//                                }
//                            } else {
//                                $this->attributeCollection->add($attribute);
//                            }
//                        }
//                    }
//                }
//            }
//        }
//
//     
//    }
}

?>
