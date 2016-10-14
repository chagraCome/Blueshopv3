<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Add.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Rating_Frontend_Add_Controller extends Amhsoft_System_Web_Controller {

    /** @var Rating_Form ratingForm */
    protected $ratingForm;

    /** @var Rating_Model ratingModel */
    protected $ratingModel;
    protected $entity;
    protected $entityid;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->entity = $this->getRequest()->get('entity');
        //var_dump($this->entity); exit;
        $this->entityid = $this->getRequest()->getInt('entityid');
        $this->ratingForm = new Rating_Form('ratingForm_form', 'POST');
        $this->ratingModel = new Rating_Model();
        //  $this->getView()->setMessage(_t('Add new Rating'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->ratingForm->DataSource = Amhsoft_Data_Source::Post();
        if ($this->ratingForm->isSend()) {
            if ($this->ratingForm->isValid()) {

                $this->ratingForm->DataBinding = $this->ratingModel;
                $ratingModelAdapter = new Rating_Model_Adapter();
                $this->ratingModel = $this->ratingForm->getDataBindItem();
                $this->ratingModel->setComment(strip_tags($this->ratingModel->getComment()));
                $this->ratingModel->rate_date_time = Amhsoft_Locale::UCTDateTime();
                $this->ratingModel->setEntityClass($this->entity);
                $this->ratingModel->setEntityId($this->entityid);
                //var_dump($this->ratingModel); exit;
                $this->ratingModel->setIp(Amhsoft_Common::GetClientIp());


                $ratingModelAdapter->save($this->ratingModel);
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
        Amhsoft_Navigator::go(Amhsoft_History::back(1));
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->includeJsFile('Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.pack.js', false);
        $this->includeCssFile('Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.css', false);
        $this->getView()->assign('widget', $this->ratingForm);
        $this->show();
    }

}

?>