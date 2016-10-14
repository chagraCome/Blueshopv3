<?php


class Product_Frontend_Brand_Controller extends Amhsoft_System_Web_Controller {

  protected $ProductManufacturerModelAdapter;
  protected $start;
  protected $mem;
  protected $attributeFilter;
  protected $sort_by = 'new';
  protected $item_layout;
  protected $items_per_page = 16;
  
  protected $_array = array();

  /**
   * Initialize Controller
   */
  public function __initialize() {
    $this->ProductManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();  
    $this->ProductManufacturerModelAdapter->orderBy('name ASC');
	$items = $this->ProductManufacturerModelAdapter->fetch()->fetchAll();
	

	foreach($items as $item){

		$key = substr($item->name, 0,1);
		$key = strtoupper($key);
		$this->_array[$key][] = $item;
	}

	$this->getView()->assign('letters', array_keys($this->_array));
  }

  /**
   * Default event
   */
  public function __default() {
   
  }

  /*
   * Finalize event
   */

  public function __finalize() {
    $re = $this->ProductManufacturerModelAdapter->fetch();
    $totalCount = $re->rowCount();
    $pager = new Amhsoft_Paginate();
    $this->getView()->assign('total_result', $totalCount);
    $pager->Pager($totalCount, $this->items_per_page, $this->items_per_page);
    // calculate limit
    $limit = $pager->getLimit(Amhsoft_Web_Request::getCurrentPage());
    // use limit
    $this->ProductManufacturerModelAdapter->limit($limit);
    // design limit
    $this->getView()->assign("pager", $pager->ToHtml('index.php'));
    $this->getView()->assign('items', $this->_array);
    $this->show();
	
  }

}

?>