<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Model.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Data
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Data_Import_Model {

  private $data = array();
  private $importfile;
  protected $modelName;
  protected $adapterName;
  protected $index = 0;

  public function __construct() {
    $this->importfile = 'cache/import_' . session_id();
  }

  public function getAttributes($args = null) {
    $vars = array();
    $model = new $this->adapterName();
    $attributes = array_keys($model->getMap());
    return $attributes;
  }

  public function getRequired($form) {
    $attributes = array();
    foreach ($form->getComponents() as $value) {
      if ($value->Required == TRUE) {
	$attributes[] = $value;
      }
    }
    //$attributes = array_keys($model->getMap());
    return $attributes;
  }

  public function getMessage(&$message = '') {
    
  }

  public function import(Amhsoft_Data_Db_Model_Interface $object, $args = array()) {
    $object->import_index = $this->index;
    $this->data[$this->index] = $object;
    $this->index++;
  }

  public function onFinishImportCallBack() {
    file_put_contents($this->importfile, serialize($this->data));
  }

  public function getObject() {
    return new $this->modelName();
  }

  /**
   * 
   * @return \Amhsoft_Widget_DataGridView
   */
  public function getDataGridView() {

    $dataGridView = new Amhsoft_Widget_DataGridView(array('data_index' => 'c'));

    foreach ($this->getAttributes() as $attribute) {

      $dataGridView->AddColumn(new Amhsoft_Label_Control($attribute, new Amhsoft_Data_Binding($attribute)), $attribute);
    }

    $dataGridView->Searchable = false;
    $dataGridView->setWithPagination(true);
    $dataGridView->setRowCountProPage(100);

    return $dataGridView;
  }

  public function getCachedData() {
    $data_string = file_get_contents($this->importfile);
    //$data_string=file($this->importfile, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    $data_array = unserialize($data_string);
    array_pop($data_array);
    return $data_array;
  }

  public function doImport($models = array()) {
    $adapter = new $this->adapterName();
    foreach ($models as $model) {
      $adapter->save($model);
    }
  }

}
