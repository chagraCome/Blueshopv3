<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Csv.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Coupon
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * @author cherif
 */
class Coupon_Backend_Import_Csv_Controller extends Amhsoft_System_Web_Controller {

    protected $importForm;
    protected $couponID;
    protected $couponModel;
    protected $dataFromCsv;
    protected $delimiter;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->couponID = $this->getRequest()->getId();
        if ($this->couponID > 0) {
            $couponModelAdapter = new Coupon_Model_Adapter();
            $this->couponModel = $couponModelAdapter->fetchById($this->couponID);


            if (!$this->couponModel instanceof Coupon_Model) {
                throw new Amhsoft_Item_Not_Found_Exception();
            }
        } else {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->getView()->setMessage(_t('Import Codes from Csv file'), View_Message_Type::INFO);
        $this->importForm = new Coupon_Import_Form('import_form', 'POST');
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->importForm->isSend()) {
            $this->importForm->fileInput->uploadTo('cache/' . $this->couponID . '.csv');
            if (file_exists('cache/' . $this->couponID . '.csv')) {
                $reader = new Amhsoft_Csv_Reader('cache/' . $this->couponID . '.csv');
                $reader->setDelimiter($this->detectDelimiter('cache/' . $this->couponID . '.csv'));
                for ($i = 0; $reader->valid(); $reader->next()) {
                    $data = $reader->current();
                    if (!$data[0]) {
                        continue;
                    }
                    if ($this->isExist($data[0]) === false) {
                        $this->generateModel($data[0], Amhsoft_Locale::UCTDateTime($data[1], 'Y-m-d H:i:s'));
                    }
                }

                $this->getRedirector()->go('admin.php?module=coupon&page=detail&id=' . $this->couponID . '&ret=true');
            } else {
                $this->getView()->setMessage(_t('Failed to load file'), View_Message_Type::ERROR);
            }
        }
    }

    protected function isExist($code) {
        $adapter = new Coupon_Code_Model_Adapter();
        $adapter->where("code LIKE ?", $code, PDO::PARAM_STR);

        return ($adapter->getCount() > 0);
    }

    protected function detectDelimiter($csvfile) {
        $handle = @fopen($csvfile, "r");
        if ($handle) {
            $line = fgets($handle, 4096);
            fclose($handle);

            $test = explode(',', $line);
            if (count($test) > 1)
                return ',';

            $test = explode(';', $line);
            if (count($test) > 1)
                return ';';
        }
        return null;
    }

    protected function generateModel($couponCode, $expirationDate) {
        $model = new Coupon_Code_Model();

        $model->setCode($couponCode);
        $model->setExpire_date($expirationDate);
        $model->setInsert_date_time(Amhsoft_Locale::UCTDateTime());
        $model->state_id = 1;
        $model->coupon_id = $this->couponID;
        $this->saveModel($model);
    }

    protected function saveModel(Coupon_Code_Model $model) {
        $adapter = new Coupon_Code_Model_Adapter();
        try {
            $adapter->save($model);
        } catch (Exception $e) {
            
        }
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('widget', $this->importForm);
        $this->show();
    }

}
