<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: List.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Product_Backend_Product_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Product_DataGridView $productDataGridView * */
    protected $productDataGridView;

    /** @ var ProductModelAdapter $productModelAdapter * */
    protected $productModelAdapter;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $action = $this->getRequest()->get('select_action');
        if (trim($action) != '') {
            $ids = $this->getRequest()->getInts('id');
            if ($action == 'duplicate') {
                $this->duplicateProduct($ids);
                unset($_GET['id']);
            }
            if ($action == 'delete') {
                $ids = $this->getRequest()->getInts('id');
                $this->deleteProducts($ids);
            }
            if ($action == 'setonline') {
                $ids = $this->getRequest()->getInts('id');
                $this->setProductsOnline($ids);
            }
            if ($action == 'setoffline') {
                $ids = $this->getRequest()->getInts('id');
                $this->setProductsOffline($ids);
            }
        }
        $this->productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModelAdapter->orderBy('sort_id, id DESC');
        $this->productModelAdapter->where('online = 1');
        $this->productDataGridView = new Product_Product_DataGridView();
        $this->productDataGridView->onSortColumn->registerEvent($this, 'colSortCallBack');


        $this->productDataGridView->WithActions = true;
        $this->productDataGridView->actions = array(
            'duplicate' => _t('Duplication'),
            'setonline' => _t('Set Online'),
            'setoffline' => _t('Set Offline'),
            'delete' => _t('Delete'),
        );
        $this->productDataGridView->setWithPagination(true);
        $this->productDataGridView->Sortable = true;
        $this->productDataGridView->Searchable = true;
        $this->productDataGridView->Draggable = true;
        $this->productDataGridView->DragUrl = 'admin.php?module=product&page=product-list&event=sort';
        $delCol = new Amhsoft_Link_Control(_t('Delete'), 'admin.php?module=product&page=product-delete');
        $delCol->DataBinding = new Amhsoft_Data_Binding('id');
        $delCol->Class = 'delete';
        $delCol->JavaScript = 'onClick="return confirmDelete();"';
        $delCol->setWidth('60');
        $this->productDataGridView->AddColumn($delCol);
        $this->productDataGridView->performSort($this->getRequest(), $this->productModelAdapter);
        $this->productDataGridView->performSearch($this->getRequest(), $this->productModelAdapter);
    }

    /**
     * Set Selected Products online.
     * @param type $ids
     */
    protected function setProductsOnline($ids) {
        if (!empty($ids)) {
            $productModelAdapter = new Product_Product_Model_Adapter();
            foreach ($ids as $id) {
                if (intval($id) > 0) {
                    Amhsoft_Database::getInstance()->exec("UPDATE product SET online = 1 WHERE id = $id");
                }
            }
            $this->getRedirector()->go('admin.php?module=product&page=product-list&ret=true');
        }
    }

    /**
     * Set Selected Products offline.
     * @param type $ids
     */
    protected function setProductsOffline($ids) {
        if (!empty($ids)) {
            $productModelAdapter = new Product_Product_Model_Adapter();
            foreach ($ids as $id) {
                if (intval($id) > 0) {
                    Amhsoft_Database::getInstance()->exec("UPDATE product SET online = 0 WHERE id = $id");
                }
            }
        }
        $this->getRedirector()->go('admin.php?module=product&page=product-offlineproduct&ret=true');
    }

    /**
     * Default event
     */
    public function __default() {
        $this->getView()->setMessage(_t('List all products'), View_Message_Type::INFO);
    }

    /**
     * Duplicate Selected products.
     * @param type $ids
     */
    protected function duplicateProduct($ids) {
        foreach ($ids as $id) {
            $productModelAdapter = new Product_Product_Model_Adapter();
            $product = $productModelAdapter->fetchById($id);
            if ($product instanceof Product_Product_Model) {
                $product->setId(null);
                $product->setTitle($product->getTitle() . ' copy');
                $images = $product->getImages();
                $product->images = array();
                $productModelAdapter->save($product);
                $imageModelAdapter = new Product_Image_Model_Adapter();
                foreach ($images as $image) {
                    $image->setId(null);
                    $imageModelAdapter->save($image);
                    if ($image->getId()) {
                        $stmt = Amhsoft_Database::getInstance()->prepare("INSERT INTO product_has_image(product_id, image_id) VALUES(:pid, :iid)");
                        $stmt->bindValue(':pid', $product->getId(), PDO::PARAM_INT);
                        $stmt->bindValue(':iid', $image->getId(), PDO::PARAM_INT);
                        $stmt->execute();
                        @copy($image->absolutepath, trim($image->folder, '/') . '/' . $image->getId() . '.' . $image->extention);
                    }
                }
            }
        }
        $this->getRedirector()->go('admin.php?module=product&page=product-list&ret=true');
    }

    /**
     * Delete Selected products.
     * @param type $ids
     */
    protected function deleteProducts($ids) {
        if (!empty($ids)) {
            $productModelAdapter = new Product_Product_Model_Adapter();
            foreach ($ids as $id) {
                $productModelAdapter->deleteById($id);
            }
        }
        $this->getRedirector()->go('admin.php?module=product&page=product-list&ret=true');
    }

    /**
     * Sort Product event
     */
    public function __sort() {
        $changes = false;
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE product SET sort_id = $sortid WHERE id = $itemid");
                $changes = true;
            }
        }

        exit;
    }

    public static function colSortCallBack($columName, Amhsoft_Data_Db_Model_Adapter $adapter, $sortOrder) {
        if ($columName == 'firstthumb') {
            return true;
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->productDataGridView->DataSource = new Amhsoft_Data_Set($this->productModelAdapter);
        $this->getView()->assign('grid', $this->productDataGridView);
        $this->show();
    }

}

?>
