<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: MultiFilter.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Modules_Product_Filter_Attribute_MultiFilter {

  /** @var Modules_Product_Filter_Attribute_Collection $attributeCollection */
  protected $attributeCollection;
  protected $availabelAttributeValues = array();
  protected $attributeviews = array();
  protected $selectedAttributeOptions = array();
  protected $selectedAttributes = array();

  /** @var Product_View_Model_Adapter $productViewModelAdapter */
  private $productViewModelAdapter;
  private static $cache = array();

  /**
   * Construct
   * @param Amhsoft_Data_Db_Model_Adapter $adapter
   */
  public function __construct(Amhsoft_Data_Db_Model_Adapter $adapter) {
    $this->productViewModelAdapter = $adapter;
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
      $db = $this->productViewModelAdapter->getDbAdapter();
//      $q = $db->prepare("DESCRIBE " . $this->productViewModelAdapter->getTable());
//      $q->execute();
//      $table_fields = $q->fetchAll(PDO::FETCH_COLUMN);
//      if (!in_array($key, $table_fields)) {
//	continue;
//      }
      $this->availabelAttributeValues['price'] = $this->getDistinct('price', $this->productViewModelAdapter->fetch());
      $exp = @explode('-', $val);
      if (count($exp) == 2) {
	$from = floatval($exp[0]);
	$to = floatval($exp[1]);
	if ($key == 'price') {
	  $from = $from / $this->getRate();
	  $to = $to / $this->getRate();
	  $from = addslashes($from);
	  $to = addslashes($to);
	}
	$this->productViewModelAdapter->where($key . " BETWEEN $from AND $to");
      } else {
	if (!is_array($val)) {
	  $val = addslashes($val);
	  $this->productViewModelAdapter->where($key . ' = ? ', $val, PDO::PARAM_STR);
	  $this->selectedAttributes[$key][] = $val;
	} else {
	  if (!empty($val)) {
	    $val_str_array = array();
	    foreach ($val as $item) {
	      $val_str_array[] = addslashes($item);
	    }
	    $val_str = "'" . implode("', '", $val_str_array) . "'";
	    $this->productViewModelAdapter->where($key . ' IN (' . $val_str . ')');
	    $this->selectedAttributes[$key] = $val;
	  }
	}
      }
    }
    $this->productViewModelAdapter->leftJoin('product_configuration_has_product', 'id', 'product_id');
    //$this->productViewModelAdapter->select('*');
    $this->productViewModelAdapter->select('IFNULL(product_configuration_has_product.product_configuration_id, id) as unique_id');
    $this->productViewModelAdapter->groupBy('unique_id');

  }

  /**
   * Get Rate
   * @return type
   */
  private function getRate() {
    return intval(Amhsoft_Locale::getRate()) > 0 ? intval(Amhsoft_Locale::getRate()) : 1;
  }

  private function getQueryParamsWithout($remove_key, $selectedValue = null) {
    $array = array();
    foreach ((array) $_GET as $key => $val) {
      if (!preg_match("/[a-zA-Z_1-9]+$/", $key)) {
	continue;
      }
      if ($remove_key != $key) {
	if (is_array($_GET[$key])) {
	  $values = Amhsoft_Web_Request::gets($key);
	  $array[$key] = $values;
	} else {
	  $array[$key] = Amhsoft_Web_Request::get($key);
	}
      } else {
	if (is_array($_GET[$key])) {
	  $values = Amhsoft_Web_Request::gets($key);
	  if ($selectedValue && in_array($selectedValue, $values)) {
	    $index = array_search($selectedValue, $values);
	    if ($index !== FALSE) {
	      unset($values[$index]);
	    }
	    if (!empty($values)) {
	      $values = array_values($values);
	      $array[$key] = $values;
	    }
	  } else {
	    $array[$key] = $values;
	  }
	}
      }
    }
    return $array;
  }

  private function getQueryParamsWithoutAsString($remove_key, $selectedValue = null) {
    $array = $this->getQueryParamsWithout($remove_key, $selectedValue);
    $str = '';
    foreach ($array as $key => $val) {
      if ($key == 'p') {
	continue;
      }
      if (is_array($val)) {
	foreach ($val as $index => $j) {
	  $str .= $key . '[]=' . $j . '&';
	}
      } else {
	$str .= $key . '=' . $val . '&';
      }
    }
    return $str;
  }

  public function getQueryParamsOnlyAttributes() {
    $array = $this->getQueryParamsWithout(null);
    $attributes = array();
    foreach ((array) $array as $attribute_name => $attribute_value) {
      if (preg_match("/^attr_[a-z_]+$/i", $attribute_name)) {
	$attributes[str_replace("attr_", '', $attribute_name)] = $attribute_value;
      }
    }
    return $attributes;
  }

  protected function isAttributePresent($value, $attributeName) {
    return in_array($value, (array) @$this->availabelAttributeValues[$attributeName]);
  }

  protected function isOptionSelected($attributeName, $optionId) {
    $attribute_in_query = Amhsoft_Web_Request::gets('attr_' . $attributeName);
    return in_array($optionId, (array) $attribute_in_query);
  }

  /**
   * Get Filter Data from a listbox control
   * @param Eav_Attribute_Model $attr
   * @return array
   */
  protected function getFilterDataFromListBox($attr) {
    $data = array();
    foreach ((array) $attr->datasources as $source) {
      if ($this->isAttributePresent($source->getId(), $attr->getName())) {
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName(), $source->getId());
	$new_url = $old_url . '&attr_' . $attr->getName() . '[]=' . $source->getId();
	if ($this->isOptionSelected($attr->getName(), $source->getId())) {
	  $data[] = array('link' => $old_url, 'label' => $source->getValue(), 'status' => 1);
	} else {
	  $data[] = array('link' => $new_url, 'label' => $source->getValue(), 'status' => 0);
	}
      } else {
	$data[] = array('link' => '#', 'label' => $source->getValue(), 'status' => -1);
      }
    }
    return $data;
  }

  /**
   * Get Filter data from a Color input control.
   * @param Eav_Attribute_Model $attr
   * @return array
   */
  protected function getFilterDataFromColor($attr, $stmt) {
    $data = array();
    $source = array();
     $where = $stmt->getWhereClause();
    $join = $stmt->getJoinStatement();
    $table = $stmt->getTable();
    $sql = "SELECT DISTINCT(`".$attr->getName()."`) as d FROM  $table $join $where  AND `".$attr->getName()."` IS NOT NULL";
    $re = Amhsoft_Database::getInstance()->query($sql);
    while ($color = $re->fetchColumn()) {
      $source[] = $color;
    }
    foreach ($source as $src) {
      if ($this->isAttributePresent($src, $attr->getName())) {
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
	$new_url = $old_url . '&attr_' . $attr->getName() . '=' . $src;
	$colorLabel = new Amhsoft_ColorLabel_Control('Color');
	$colorLabel->Value = $src;
	if ($this->isOptionSelected($attr->getName(), $src)) {
	  $data[] = array('link' => $old_url, 'label' => $src, 'status' => 1);
	} else {
	  $data[] = array('link' => $new_url, 'label' => $src, 'status' => 0);
	}
      }
    }
    return $data;
  }

  /**
   * Get Checkbox Attribute Filter
   * @return string 
   */
  protected function getCheckBoxAttributeFilter() {
    if (count($this->attributeviews) == 0) {
      return;
    }
    $str = null;
    list($viewid, $attributes) = each($this->attributeviews);
    $attributeViewModeAdapter = new Eav_Set_View_Model_Adapter();
    $viewModel = $attributeViewModeAdapter->fetchById($viewid);
    if ($viewModel instanceof Eav_Set_View_Model) {
      $data = array();
      foreach ($attributes as $attr) {
	$old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
	$new_url = $old_url . '&attr_' . $attr->getName() . '=' . 1;
	if ($this->isAttributePresent(1, $attr->getName())) {
	  $data[] = array('link' => $old_url, 'label' => $attr->getLabel(), 'status' => 1);
	} else {
	  $data[] = array('link' => $new_url, 'label' => $attr->getLabel(), 'status' => 0);
	}
      }
      $str = Modules_Product_Filter_Attribute_Render_Default::Render($viewModel->getName(), $viewModel->getName(), $data);
    }
    return $str;
  }

  protected function getFilterDataFromRange($attr, $attribute_values) {
    $data = array();
    if (count($attribute_values) < 2) {
      return;
    }
    sort($attribute_values);
    $multiplication = ($attr->getName() == 'price') ? $this->getRate() : 1;
    $min = min($attribute_values) * $multiplication;
    $max = max($attribute_values) * $multiplication;
    $count_of_attributes = count($attribute_values);
    if ($count_of_attributes > 12) {
      $count_of_attributes = 12;
    }
    $step = intval(($max - $min) / ($count_of_attributes));
    if ($count_of_attributes % 2 == 0) {
      $count_of_attributes--;
    }
    $old = $min;
    $steps = array(0, intval($min + 1));
    for ($i = 1; $i < $count_of_attributes - 1; $i++) {
      $old = $i * $step;
      $steps[] = intval($old);
    }
    $steps[] = intval($max);
    $chunked = array_chunk($steps, 2);
    $component = Amhsoft_Abstract_Control::CreateFrontEnd('attr', $attr->entity_attribute_type_backend_id);
    if ($attr->getName() == 'price') {
      $component->Unit = Amhsoft_Locale::getCurrencySymbol();
    }
    $count_chunked = count($chunked);
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
      $max_available = max($available_range) * $multiplication;
      $min_available = min($available_range) * $multiplication;
      $attribute_in_query = Amhsoft_Web_Request::get('attr_' . $attr->getName());
      $old_url = $this->getQueryParamsWithoutAsString('attr_' . $attr->getName());
      $new_url = $old_url . '&attr_' . $attr->getName() . '=' . $str_range_value;
      if ($attribute_in_query && $attribute_in_query == $str_range_value) {
	$data[] = array('link' => $old_url, 'label' => $str_range_value . ' ' . (isset($component->Unit) ? $component->Unit : null), 'status' => 1);
      } else {
	if ($max > $min_available && $min <= $max_available) {
	  $data[] = array('link' => $new_url, 'label' => $str_range_value . ' ' . (isset($component->Unit) ? $component->Unit : null), 'status' => 0);
	} else {
	  $data[] = array('link' => '#', 'label' => $str_range_value . ' ' . (isset($component->Unit) ? $component->Unit : null), 'status' => -1);
	}
      }
    }
    return $data;
  }

  /**
   * Get Attributes
   * @return type
   */
  public function getAttributes($stmt) {
    $str = '';
    foreach ((array) @$this->attributeCollection->getAll() as $attr) {
      if ($attr->entity_attribute_type_backend_id == 2) {
	$str .= Modules_Product_Filter_Attribute_Render_Default::Render($attr->getName(), $attr->getLabel(), $this->getFilterDataFromListBox($attr));
      } elseif ($attr->entity_attribute_type_backend_id == 21) {
	$attribute_values = (array) @$this->availabelAttributeValues[$attr->getName()];
	if (count($attribute_values) > 0) {
	  $str .= Modules_Product_Filter_Attribute_Render_Default::Render($attr->getName(), $attr->getLabel(), $this->getFilterDataFromColor($attr, $stmt), 'color');
	}
      } elseif (($attr->entity_attribute_type_backend_id > 9 && $attr->entity_attribute_type_backend_id < 21) || $attr->entity_attribute_type_backend_id = 5) {
	$attribute_values = (array) @$this->availabelAttributeValues[$attr->getName()];
	$str .= Modules_Product_Filter_Attribute_Render_Default::Render($attr->getName(), $attr->getLabel(), $this->getFilterDataFromRange($attr, $attribute_values), 'range');
      }
    }
    $str .= $this->getCheckBoxAttributeFilter();
    return $str;
  }

  /**
   * Remove Attributes
   * @param type $where
   * @param type $attributeName
   * @return type
   */
  private function removeAttributeFromWhere($where, $attributeName) {
    if (!isset($this->selectedAttributes[$attributeName])) {
      return $where;
    }
    $multivalues = $this->selectedAttributes[$attributeName];
    $multi_str = '';
    $multi_str = "'" . implode("', '", $multivalues) . "'";
    $multi_where = 'AND ' . $attributeName . ' IN (' . $multi_str . ')';
    $where = str_replace($multi_where, '', $where);
    return $where;
  }

  /**
   * Gets Distinct attribute values.
   * @param string $attributeName
   * @param Amhsoft_Database $stmt
   * @return array unique attributes
   */
  private function getDistinct($attributeName, $stmt, $multiselect = false) {
    try {
      $where = ($stmt->getAdapter()->getWhereClause());
      $table = $stmt->getAdapter()->getTable();
      $where = $this->removeAttributeFromWhere($where, $attributeName);
      $join = $stmt->getAdapter()->getJoinStatement();
      $sql = "SELECT ($attributeName)  FROM  $table  $join $where";

      $re = Amhsoft_Database::getInstance()->query($sql);
      $re->execute();
      if ($re->rowCount() == 0) {
	return array();
      }
      $source = $re->fetchAll(PDO::FETCH_COLUMN);
      $source = array_unique($source);
      return $source;
    } catch (Exception $e) {
      return array();
    }
  }

  /**
   * Calculate attribute combinations.
   * @param Amhsoft_Database $stmt
   * @return type
   */
  public function calculateAttributes($stmt) {
    $attributes = array();
    $sets = array();
    $where = $stmt->getAdapter()->getWhereClause();
    $join = $stmt->getAdapter()->getJoinStatement();
    $table = $stmt->getAdapter()->getTable();
    $sql = "SELECT DISTINCT(entity_set_id) FROM $table $join $where ";
    
    try {
      $setstmt = Amhsoft_Database::getInstance()->query($sql);
      $setstmt->execute();
      $sets = $setstmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (Exception $e) {
      return array();
    }
    foreach ($sets as $s) {
      $id = intval(@$s['entity_set_id']);
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
	  $this->availabelAttributeValues[$attribute->getName()] = $this->getDistinct($attribute->getName(), $stmt, true);
	  switch ($attribute->entity_attribute_type_backend_id) {
            case 9: //listbox
            case 4: //checkbox
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
