<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Media.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

class Product_Backend_Product_Media_Controller extends Amhsoft_System_Web_Controller {

    /** @var Amhsoft_Widget_Panel $panelMedia */
    protected $panelMedia;

    /** @var Product_Product_Model $productModel */
    protected $productModel;

    /**
     * Initailize Controller
     */
    public function __initialize() {
        $this->panelMedia = new Amhsoft_Widget_Panel();
        $id = $this->getRequest()->getId();
        if ($id < 0) {
            new Amhsoft_Item_Not_Found_Exception();
        }
        $productModelAdapter = new Product_Product_Model_Adapter();
        $this->productModel = $productModelAdapter->fetchById($id);
        if (!$this->productModel instanceof Product_Product_Model) {
            new Amhsoft_Item_Not_Found_Exception();
        }
    }

    /**
     * Default event
     */
    public function __default() {

        if ($this->getRequest()->isPost('upload')) {
            $this->upload_Click();
        }



        if ($this->getRequest()->isPost('submit_next')) {
            if ($this->productModel->isService()) {
                $this->getRedirector()->go('admin.php?module=product&page=product-marketing&id=' . $this->productModel->getId());
            } else {
                $this->getRedirector()->go('admin.php?module=product&page=product-shipping&id=' . $this->productModel->getId());
            }
        }
        if ($this->getRequest()->isPost('submit_back')) {
            $this->getRedirector()->go('admin.php?module=product&page=price-modify&id=' . $this->productModel->getId());
        }
        $this->getView()->setMessage(_t('Manage Media'), View_Message_Type::INFO);
        $this->setUpImagePanel();
        $this->setUpDocumentPanel();
    }

    protected function upload_Click() {
        if (isset($_FILES['photo_file']) && is_array($_FILES['photo_file'])) {
            $images = $_FILES['photo_file'];
            $preparedImages = array();
            for ($i = 0; $i < count($images['name']); $i++) {
                $img = array();
                if (strlen($images['name'][$i]) > 0) {
                    $img['name'] = $images['name'][$i];
                    $img['tmp_name'] = $images['tmp_name'][$i];
                    $img['type'] = $images['type'][$i];
                    $img['error'] = $images['error'][$i];
                    $img['size'] = $images['size'][$i];
                    $preparedImages[] = $img;
                } else {
                    return;
                }
            }

            $imageModelAdapter = new Product_Image_Model_Adapter();
            foreach ($preparedImages as $upFile) {
                // var_dump($upFile);
                // exit;            
                $imageModel = new Product_Image_Model();
                $imageModel->setFolder('/media/product/image');
                $imageModel->setName($upFile['name']);
                $imageModel->setPublic(1);
                $imageModel->setExtention(Amhsoft_Common::get_file_extension($upFile['name']));
                $imageModel->setInsertat(Amhsoft_Locale::UCTDateTime());
                $imageModelAdapter->save($imageModel);
                if ($imageModel->getId() > 0) {
                    $imageModel->uploadFromTemp($upFile);
                    $stmt = Amhsoft_Database::getInstance()->prepare("INSERT INTO product_has_image(product_id, image_id) VALUES(:pid, :iid)");
                    $stmt->bindValue(':pid', $this->getRequest()->getId(), PDO::PARAM_INT);
                    $stmt->bindValue(':iid', $imageModel->getId(), PDO::PARAM_INT);
                    $stmt->execute();
                }
            }
            $this->getRedirector()->go('?module=product&page=product-media&id=' . $this->getRequest()->getId() . '&ret=true');
        }
    }

    /**
     * Set up Image Panel
     */
    protected function setUpImagePanel() {
        $panelImage = new Amhsoft_Widget_Panel(_t('Product Images'));
        $productImageDataGridView = new Product_Image_DataGridView();
        $productImageDataGridView->Draggable = true;
        $productImageDataGridView->DragUrl = 'admin.php?module=product&page=product-media&event=sort&id=' . $this->productModel->getId();
        $productImageDataGridView->DataSource = new Amhsoft_Data_Set($this->productModel->getImages());
        $panelImage->addComponent($productImageDataGridView);
        $addLink = new Amhsoft_Link_Control(_t('Add new Image'), 'admin.php?module=product&page=image-add&product_id=' . $this->getRequest()->getId());
        $addLink->setClass('add');
        $panelImage->addComponent($addLink);
        $this->panelMedia->addComponent($panelImage);
    }

    /**
     * Sort Image event
     */
    public function __sort() {
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE product_has_image SET sortid = $sortid WHERE image_id = $itemid AND product_id = " . $this->productModel->getId());
            }
        }
        exit;
    }

    /**
     * Set Document Panel
     */
    protected function setUpDocumentPanel() {
        $panelDocument = new Amhsoft_Widget_Panel(_t('Product Documents'));
        $productDocumentDataGridView = new Product_Document_DataGridView();
        $productDocumentDataGridView->DataSource = new Amhsoft_Data_Set($this->productModel->getDocuments());
        $panelDocument->addComponent($productDocumentDataGridView);
        $addLink = new Amhsoft_Link_Control(_t('Add new Document'), 'admin.php?module=product&page=document-add&product_id=' . $this->getRequest()->getId());
        $addLink->setClass('add');
        $panelDocument->addComponent($addLink);
        $this->panelMedia->addComponent($panelDocument);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->panelMedia);
        $this->getView()->assign('product', $this->productModel);
        $this->show();
    }

}

?>
