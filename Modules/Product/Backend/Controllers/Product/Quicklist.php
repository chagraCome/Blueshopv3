<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Quicklist.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Quicklist_Controller extends Amhsoft_System_Web_Controller {

  /** @ var ProductModelAdapter $productModelAdapter * */
  protected $productModelAdapter;

  /** @var DataGridView $dataGridView */
  protected $dataGridView;
  protected $registerkey = 'product_quick_list_selected_id';

  /**
   * Initialize Controller
   */
  public function __initialize() {
    if ($this->getRequest()->get('key')) {
      $this->registerkey = $this->getRequest()->get('key');
    }
    $this->dataGridView = new Amhsoft_Widget_DataGridView();
    $this->dataGridView->setSearchable(true);
    $this->dataGridView->setSortable(true);
    $this->dataGridView->setWithPagination(true);
    $this->initializeDataGridView();
    $this->productModelAdapter = new Product_Product_Model_Adapter();
  }

  /**
   * Default event
   */
  public function __default() {
    $this->dataGridView->performSearch($this->getRequest(), $this->productModelAdapter);
    $this->dataGridView->performSort($this->getRequest(), $this->productModelAdapter);
  }

  /**
   * Initialize Product Grid
   */
  protected function initializeDataGridView() {
    $imageCol = new Amhsoft_ImageTag_Control(_t('Image'), 'firstthumb', 0, 0);
    $imageCol->DataBinding = new Amhsoft_Data_Binding('firstthumb');
    $imageCol->setWidth(36);
    $imageCol->setHeight(36);
    $numberCol = new Amhsoft_Link_Control(_t('Product Number'), 'admin.php?module=product&page=product-quicklist&event=select&action=' . $this->getRequest()->get('action') . '&key=' . $this->registerkey);
    $numberCol->DisplayValue = 'number';
    $numberCol->DataBinding = new Amhsoft_Data_Binding('id', 'number');
    $nameCol = new Amhsoft_Link_Control(_t('Product Name'), 'admin.php?module=product&page=product-quicklist&event=select&action=' . $this->getRequest()->get('action') . '&key=' . $this->registerkey);
    $nameCol->DisplayValue = 'title';
    $nameCol->DataBinding = new Amhsoft_Data_Binding('id', 'title');
    $quantityLabel = new Amhsoft_Label_Control(_t('Quantity'));
    $quantityLabel->DataBinding = new Amhsoft_Data_Binding('quantity');
    $priceLabel = new Amhsoft_Currency_Label_Control(_t('Price'));
    $priceLabel->DataBinding = new Amhsoft_Data_Binding('saleprice');
    $this->dataGridView->addColumn($imageCol);
    $this->dataGridView->AddColumn($numberCol);
    $this->dataGridView->AddColumn($nameCol);
    $this->dataGridView->AddColumn($quantityLabel);
    $this->dataGridView->AddColumn($priceLabel);
    $this->dataGridView->addSearcField(null);
    $this->dataGridView->addSearcField('text');
    $this->dataGridView->addSearcField('text');
    $this->dataGridView->addSearcField('text');
    $this->dataGridView->addSearcField('text');
    $this->dataGridView->Sortable = true;
    $this->dataGridView->Searchable = true;
    $this->dataGridView->setRowCountProPage(100);
  }

  /**
   * Select Product event
   */
  public function __select() {
    $id = $this->getRequest()->getId();
    if ($id > 0) {
      if ($this->getRequest()->get('action') == 'producttinymce') {
	$this->handleTinyMCE($id);
      } else {
	Amhsoft_Registry::register($this->registerkey, $id);
      }
    }
    $this->close();
  }

  /**
   * Handle TinyMCE
   * @param type $id
   */
  protected function handleTinyMCE($id) {
    $compain_id = Amhsoft_Registry::get('compain_id_for_replace');

    $string = '<table style="width: 100%;" border="0" cellpadding="10">
                    <tbody>
                    <tr>
                    <td><a title="Product Ttile" href="_PRODUCT_URL_" target="_blank"><img src="_PRODUCT_IMAGE_" alt="product Tirle" width="151" /></a></td>
                    <td> 
                    _PRODUCT_DESCRIPTION_
                    </td>
                    <td>
                    _PRODUCT_PRICES_ 
                    </td>
                    </tr>
                    </tbody>
                    </table>';
    $productModelAdapter = new Product_Product_Model_Adapter();
    $productModel = $productModelAdapter->fetchById($id);
    if (!$productModel instanceof Product_Product_Model) {
      $this->close(array('product_id' => $id));
    }
    $string = str_replace('_PRODUCT_URL_', $productModel->getUrl() . '&xlscmp=' . $compain_id, $string);
    $string = str_replace('_PRODUCT_IMAGE_', $productModel->getFirstThumb(), $string);
    $string = str_replace('_PRODUCT_DESCRIPTION_', $productModel->getAttributeLabeledValuesAsString(), $string);
    $string = str_replace('_PRODUCT_PRICES_', $productModel->getPrice(), $string);
    $string = str_replace("\n", "", $string);
    $string = str_replace("\r", "", $string);
    $string = str_replace("\t", "", $string);
    $script = '<script type="text/javascript">';
    $script .= 'var editor = window.opener.tinyMCE.get("wysiwyg");';
    $script .= 'var oldContent = editor.getContent();';
    $script .= 'var newContent = oldContent + \'' . $string . '\';';
    $script .= 'editor.execCommand(\'mceSetContent\', false, newContent);';
    $script .= '</script>';
    echo $script;
    $this->close(array('product_id' => $id));
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    $this->dataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter->fetch());
    $panel = new Amhsoft_Widget_Panel(_t('Select a product'));
    $panel->addComponent($this->dataGridView);
    $this->getView()->assign('grid', $panel);
    $this->popup();
  }

}

?>
