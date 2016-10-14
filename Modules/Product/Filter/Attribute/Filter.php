<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Filter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Modules_Product_Filter_Attribute_Filter {

  /** @var Modules_Product_Filter_Attribute_Collection $attributeCollection */
  protected $attributeCollection;
  protected $availabelAttributeValues = array();
  protected $attributeviews = array();

  /** @var Product_View_Model_Adapter $productViewModelAdapter */
  private $productViewModelAdapter;
  private static $cache = array();

  /**
   * Construct
   * @param Amhsoft_Data_Db_Model_Adapter $adapter
   */
  public function __construct(Amhsoft_Data_Db_Model_Adapter $adapter) {
    $this->productViewModelAdapter = $adapter;
    //new Eav_Attribute_Model();
    $this->attributeCollection = new Modules_Product_Filter_Attribute_Collection();
  }

  /**
   * Perform Search
   */
  public function performSearch() {
    foreach ((array) $this->getQueryParamsOnlyAttributes() as $key => $val) {
      if (!$val) {
	continue;
      }
      $this->availabelAttributeValues['price'] = $this->getDistinct('price', $this->productViewModelAdapter->fetch());
      $exp = @explode('-', $val);
      if (count($exp) == 2) {
	$from = floatval($exp[0]);
	$to = floatval($exp[1]);
	if ($key == 'price') {
	  $from = $from / Amhsoft_Locale::getRate();
	  $to = $to / Amhsoft_Locale::getRate();
	}
	$this->productViewModelAdapter->where($key . " BETWEEN $from AND $to");
      } else {
	$val = addslashes($val);
	$this->productViewModelAdapter->where($key . ' = ? ', $val, PDO::PARAM_STR);
      }
    }
  }

  private function getQueryParamsWithout($remove_key) {
    $array = array();
    foreach ((array) $_GET as $key => $val) {
      if ($key != $remove_key) {
	$array[$key] = addslashes($val);
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

  protected function getItemsAsLink() {
    
  }

  protected function isAttributePresent($value, $attributeName) {
    return in_array($value, (array) @$this->availabelAttributeValues[$attributeName]);
  }

  protected function getListBoxAttributeFilter($attr) {
    $attributeDataSource = $attr->datasources;
    $str = '';
    foreach ((array) $attr->datasources as $source) {
      $src = $source->getId();
      $attribute_in_query = Amhsoft_Web_Request::get('attr_' . $attr->getName());
      if ($this->isAttributePresent($src, $attr->getName())) {
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
	$new_url = $old_url . '&attr_' . $attr->getName() . '=' . $src;
	if ($attribute_in_query && $attribute_in_query == $src) {
	  $link = '<a href="index.php?' . $old_url . '">';
	  $str .='<li>' . $link . '<img src="Amhsoft/Ressources/Icons/checkbox_1.png" />' . $source->getValue() . '</a></li>';
	} else {
	  $link = '<a href="index.php?' . $new_url . '">';
	  $str .='<li>' . $link . '<img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $source->getValue() . '</a></li>';
	}
      } else {
	if (count($attributeDataSource) < 10) {
	  $link = '<a style="color:gray; cursor:default" class="disabled"  href="#">';
	  $str .='<li>' . $link . '<img src="Amhsoft/Ressources/Icons/checkbox_0.png" />' . $source->getValue() . '</a></li>';
	}
      }
    }
    return $str;
  }

  protected function getColorAttributeFilter($attr) {
    $str = null;
    $source = array();
    $sql = "SELECT DISTINCT(`value`) as d FROM entity_attribute_value_lang LEFT JOIN entity_attribute_value ON entity_attribute_value.id = entity_attribute_value_lang.entity_attribute_value_id WHERE `VALUE` IS NOT NULL AND  entity_attribute_value.entity_attribute_id = " . $attr->getId();
    $re = Amhsoft_Database::getInstance()->query($sql);
    while ($color = $re->fetchColumn()) {
      $source[] = $color;
    }
    foreach ($source as $src) {
      if (in_array($src, (array) @$this->availabelAttributeValues[$attr->getName()])) {
	$attribute_in_query = Amhsoft_Web_Request::get('attr_' . $attr->getName());
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
	$new_url = $old_url . '&attr_' . $attr->getName() . '=' . $src;
	$colorLabel = new Amhsoft_ColorLabel_Control('Color');
	$colorLabel->Value = $src;
	if ($attribute_in_query && $attribute_in_query == $src) {
	  $link = '<a href="index.php?' . $old_url . '">';
	  $str .='<li>' . $link . $colorLabel->Render() . '<img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
	} else {
	  $link = '<a href="index.php?' . $new_url . '">';
	  $str .='<li>' . $link . $colorLabel->Render() . '</a></li>';
	}
      }
    }
    return $str;
  }

  protected function getCheckBoxAttributeFilter() {
    if (count($this->attributeviews) == 0) {
      return;
    }
    $str = null;
    list($viewid, $attributes) = each($this->attributeviews);
    $attributeViewModeAdapter = new Eav_Set_View_Model_Adapter();
    $viewModel = $attributeViewModeAdapter->fetchById($viewid);
    if ($viewModel instanceof Eav_Set_View_Model) {
      foreach ($attributes as $attr) {
	$attribute_in_query = Amhsoft_Web_Request::get('attr_' . $attr->getName());
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
	$new_url = $old_url . '&attr_' . $attr->getName() . '=' . 1;
	$checkBox = new Amhsoft_CheckBox_Control($attr->getName(), $attr->getLabel());
	if ($attribute_in_query && $attribute_in_query == 1) {
	  $checkBox->Checked = 1;
	  $link = '<a href="index.php?' . $old_url . '">';
	  $str .='<li>' . $link . $checkBox->Render() . ' ' . $checkBox->getLabel() . '</a></li>';
	} else {
	  $checkBox->Checked = 0;
	  $link = '<a style="text-decoration:none" href="index.php?' . $new_url . '">';
	  $str .='<li>' . $link . $checkBox->Render() . ' ' . $checkBox->getLabel() . '</a></li>';
	}
      }
      if ($str != null) {
	$str = '<h3 class="active">' . $viewModel->getName() . '</h3><ul class="filter_ul">' . $str . '</ul>';
      }
    }
    return $str;
  }

  protected function getRangeAttributeFilter($attr, $attribute_values) {
    if (count($attribute_values) < 2) {
      return;
    }
    sort($attribute_values);
    $min = min($attribute_values);
    $max = max($attribute_values);
    $count_of_attributes = count($attribute_values);
    if ($count_of_attributes > 6) {
      $count_of_attributes = 6;
    }
    $step = intval(($max - $min) / ($count_of_attributes));
    if ($count_of_attributes % 2 == 0) {
      $count_of_attributes--;
    }
    $old = $min;
    $steps = array(0, intval((Amhsoft_Locale::getRate() * $min) + 1));
    for ($i = 1; $i < $count_of_attributes - 1; $i++) {
      $old += $i * $step;
      $steps[] = intval(Amhsoft_Locale::getRate() * $old);
    }
    $steps[] = intval(Amhsoft_Locale::getRate() * $max);
    $chunked = array_chunk($steps, 2);
    $component = Amhsoft_Abstract_Control::CreateFrontEnd('attr', $attr->entity_attribute_type_backend_id);
    $component->Unit = Amhsoft_Locale::getCurrencySymbol();
    $count_chunked = count($chunked);
    $str = '';
    for ($i = 0; $i < $count_chunked; $i++) {
      if ($i == 0) {
	$min = $chunked[$i][0];
	$max = $chunked[$i][1];
      } else {
	$min = $chunked[$i - 1][1];
	$max = isset($chunked[$i][1]) ? $chunked[$i][1] : $chunked[$i - 1][1] + 100;
      }
      $str_range_value = $min . "-" . $max;
      $available_range = (array) @$this->availabelAttributeValues[$attr->getName()];
      sort($available_range);
      $max_available = max($available_range);
      $min_available = min($available_range);
      $attribute_in_query = Amhsoft_Web_Request::get('attr_' . $attr->getName());
      $old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
      $new_url = $old_url . '&attr_' . $attr->getName() . '=' . $str_range_value;
      if ($attribute_in_query && $attribute_in_query == $str_range_value) {
	$link = '<a href="index.php?' . $old_url . '">';
	$str .='<li>' . $link . $str_range_value . ' ' . (isset($component->Unit) ? $component->Unit : null) . '<img src="Amhsoft/Ressources/Icons/cross.gif" /></a></li>';
      } else {
	if ($max > $min_available && $min <= $max_available) {
	  $link = '<a href="index.php?' . $new_url . '">';
	  $str .='<li>' . $link . $str_range_value . '</a> ' . (isset($component->Unit) ? $component->Unit : null) . '</li>';
	} else {
	  $str .='<li style="color:gray" class="disabled">' . $str_range_value . (isset($component->Unit) ? $component->Unit : null) . '</li>';
	}
      }
    }
    return $str;
  }

  /**
   * Get Attributes
   * @return type
   */
  public function getAttributes() {
    $str = '';
    foreach ((array) @$this->attributeCollection->getAll() as $attr) {
      if ($attr->entity_attribute_type_backend_id == 2) {
	$str .='<h3 class="active">' . $attr->getLabel() . '</h3><ul class="filter_ul">';
	$str .= $this->getListBoxAttributeFilter($attr);
	$str .= '</ul>';
      } elseif ($attr->entity_attribute_type_backend_id == 21) {
	$attribute_values = (array) @$this->availabelAttributeValues[$attr->getName()];
	if (count($attribute_values) > 0) {
	  $str .='<h3 class="active">' . $attr->getLabel() . '</h3><ul class="filter_ul">';
	  $str .= $this->getColorAttributeFilter($attr);
	  $str .= '</ul>';
	}
      } elseif (($attr->entity_attribute_type_backend_id > 9 && $attr->entity_attribute_type_backend_id < 21) || $attr->entity_attribute_type_backend_id = 5) {
	$attribute_values = (array) @$this->availabelAttributeValues[$attr->getName()];
	if (count($attribute_values) > 0) {
	  $html_values = $this->getRangeAttributeFilter($attr, $attribute_values);
	  if ($html_values) {
	    $str .='<h3 class="active">' . $attr->getLabel() . '</h3><ul class="filter_ul">';
	    $str .=$html_values;
	    $str .= '</ul>';
	  }
	}
      }
    }
    $str .= $this->getCheckBoxAttributeFilter();
    if ($str) {
      return '</ul>' . $str;
    } else {
      return $str;
    }
  }

  /**
   * Distinct
   * @param type $attributeName
   * @param type $stmt
   * @return type
   */
  private function getDistinct($attributeName, $stmt) {
    $start = microtime(true);
    $where = ($stmt->getAdapter()->getWhereClause());
    $table = $stmt->getAdapter()->getTable();
    $sql = "SELECT ($attributeName)  FROM  $table $where";
    $re = Amhsoft_Database::getInstance()->query($sql);
    $re->execute();
    if ($re->rowCount() == 0) {
      return array();
    }
    $source = $re->fetchAll(PDO::FETCH_COLUMN);
    $source = array_unique($source);
    return $source;
  }

  /**
   * Calculate Attributes
   * @param type $stmt
   */
  public function calculateAttributes($stmt) {
    $attributes = array();
    $where = ($stmt->getAdapter()->getWhereClause());
    $table = $stmt->getAdapter()->getTable();
    $sql = "SELECT DISTINCT(entity_set_id) FROM $table $where ";
    $setstmt = Amhsoft_Database::getInstance()->query($sql);
    $setstmt->execute();
    $sets = $setstmt->fetchAll(PDO::FETCH_ASSOC);
    foreach ($sets as $s) {
      $id = intval($s['entity_set_id']);
      if ($id > 0) {
	$attributeSetAdapter = new Eav_Set_Model_Adapter();
	$set = $attributeSetAdapter->fetchById($id);
	if (!$set instanceof Eav_Set_Model) {
	  continue;
	}
	$attributes = $set->getAttributes();
	foreach ($attributes as $attribute) {
	  if (!$attribute->isSearchable()) {
	    continue;
	  }
	  if (isset($this->availabelAttributeValues[$attribute->getName()]) && !empty($this->availabelAttributeValues[$attribute->getName()])) {
	    continue;
	  }
	  $this->availabelAttributeValues[$attribute->getName()] = $this->getDistinct($attribute->getName(), $stmt);
	  switch ($attribute->entity_attribute_type_backend_id) {
	    case 9:
	    case 4:
	      if (!isset($this->attributeviews[$attribute->entity_set_view_id]) || !in_array($attribute, $this->attributeviews[$attribute->entity_set_view_id])) {
		$this->attributeviews[$attribute->entity_set_view_id][] = $attribute;
	      }
	      break;
	    default:
	      $this->attributeCollection->add($attribute);
	  }
	}
      }
    }
    $priceLabel = new Eav_Attribute_Model();
    $priceLabel->entity_attribute_type_backend_id = 5;
    $priceLabel->setName('price');
    $priceLabel->setLabel(_t('Price'));
    $priceLabel->searchable = true;
    $this->attributeCollection->add($priceLabel);
    if (!isset($this->availabelAttributeValues['price'])) {
      $this->availabelAttributeValues['price'] = $this->getDistinct('price', $stmt);
    }
  }

}

?>
