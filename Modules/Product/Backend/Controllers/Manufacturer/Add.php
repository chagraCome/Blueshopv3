<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Product
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Product_Backend_Manufacturer_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Product_Manufacturer_Form productManufacturerForm */
    protected $productManufacturerForm;

    /** @var Product_Manufacturer_Model productManufacturerModel */
    protected $productManufacturerModel;

    public function __initialize() {
        $this->productManufacturerForm = new Product_Manufacturer_Form('productManufacturerForm_form', 'POST');
        $this->productManufacturerModel = new Product_Manufacturer_Model();
        $this->getView()->setMessage(_t('Add new Manufacturer'), View_Message_Type::INFO);
    }

    public function __default() {
        $this->productManufacturerForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->productManufacturerForm->isSend()) {
            if ($this->productManufacturerForm->isValid()) {
                $this->productManufacturerForm->DataBinding = $this->productManufacturerModel;
                $productManufacturerModelAdapter = new Product_Manufacturer_Model_Adapter();
                $this->productManufacturerModel = $this->productManufacturerForm->getDataBindItem();

                $productManufacturerModelAdapter->save($this->productManufacturerModel);
                @unlink('media/product/manufacturer/' . $this->productManufacturerModel->id . '.' . $this->productManufacturerForm->manufacturerLogo->getUploadControl()->getExtention()); //remove it if exists
                $this->productManufacturerForm->manufacturerLogo->getUploadControl()->uploadTo('media/product/manufacturer/' . $this->productManufacturerModel->id . '.' . $this->productManufacturerForm->manufacturerLogo->getUploadControl()->getExtention());

                $this->handleSuccess();
            } else {
                $this->getView()->setMessage(_t('Please check inputs.'), View_Message_Type::ERROR);
            }
        }
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