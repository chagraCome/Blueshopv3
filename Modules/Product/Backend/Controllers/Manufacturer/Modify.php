<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Modify.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Backend_Manufacturer_Modify_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Manufacturer_Form productManufacturerForm */
    protected $productManufacturerForm;

    /** @var Product_Manufacturer_Model productManufacturerModel */
    protected $productManufacturerModel;

    public function __initialize() {
        $this->productManufacturerForm = new Product_Manufacturer_Form('productManufacturerForm_form', 'POST');
        $this->getView()->setMessage(_t('Modify Manufacturer'), View_Message_Type::INFO);
        $id = $this->getRequest()->getId();
        if ($id > 0) {
            $productManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
            $this->productManufacturerModel = $productManufacturerModelAdapter->fetchById($id);
        }
        if (!$this->productManufacturerModel instanceof Product_Manufacturer_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->productManufacturerForm->manufacturerLogo->setDeleteUrl('admin.php?module=product&page=manufacturer-modify&id=' . $this->productManufacturerModel->getId() . '&event=deletepicture');
        $this->productManufacturerForm->manufacturerLogo->setSrc($this->productManufacturerModel->getPictureSrc());

        $this->productManufacturerForm->DataSource = new Amhsoft_Data_Set($this->productManufacturerModel);
        $this->productManufacturerForm->Bind();
    }

    public function __default() {
        if ($this->productManufacturerForm->isSend()) {
            $this->productManufacturerForm->DataSource = Amhsoft_Data_Source::Post();
            $this->productManufacturerForm->Bind();
            if ($this->productManufacturerForm->isValid()) {
                $this->productManufacturerForm->DataBinding = $this->productManufacturerModel;
                $productManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
                $this->productManufacturerModel = $this->productManufacturerForm->getDataBindItem();

                $productManufacturerModelAdapter->save($this->productManufacturerModel);
                $pictureUploadControl = $this->productManufacturerForm->manufacturerLogo->getUploadControl();
                if ($pictureUploadControl->Value) {
                  //  $path = 'media/product/manufacturer/' . $this->productManufacturerModel->id . '.' . $pictureUploadControl->getExtention();
                      $pictureUploadControl->uploadTo('media/product/manufacturer/' . $this->productManufacturerModel->id . '.' . $pictureUploadControl->getExtention());
                }
              //  $this->productManufacturerModel->logosrc = $path;

                $this->handleSuccess();
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
    }

    public function __deletepicture() {
        @unlink("media/product/manufacturer/" . $this->productManufacturerModel->id . ".jpg");
        $this->getRedirector()->go('admin.php?module=product&page=manufacturer-modify&id=' . $this->productManufacturerModel->getId());
    }

    /**
     * Handle success.
     */
    protected function handleSuccess() {
        Amhsoft_Navigator::go(Amhsoft_History::back(0) . '&ret=true');
    }

    public function __finalize() {
        $this->getView()->assign('widget', $this->productManufacturerForm);
        $this->show();
    }

}
?>

