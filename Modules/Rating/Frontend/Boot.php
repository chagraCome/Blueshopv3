<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 489 2016-05-17 10:34:28Z imen.amhsoft $
 * $Rev: 489 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $LastChangedDate: 2016-05-17 12:34:28 +0200 (mar., 17 mai 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Modules_Rating_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        
    }

    /**
     * Get Rating
     * @param type $entityClassName
     * @param type $entityId
     * @param type $view
     * @return type
     */
    public static function getRating($entityClassName, $entityId, $view = "Modules/Rating/Frontend/Views/Helpers/Rating.html") {
        $template = Amhsoft_View::getInstance();
        $ratingModelAdapter = new Rating_Model_Adapter();
        $ratingModelAdapter->where('entity_class = ?', $entityClassName, PDO::PARAM_STR);
        $ratingModelAdapter->where('entity_id = ?', $entityId);
        $ratingModelAdapter->where('state = 1');
        $ratingModelAdapter->orderBy('id DESC');
        Amhsoft_System_Web_Controller::$js_scripts[] = 'Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.pack.js';
        Amhsoft_System_Web_Controller::$css_scripts[] = 'Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.css';
        $ratingForm = new Rating_Form('rating_form', 'POST');
        $ratingForm->entityid->Value = $entityId;
        $ratingForm->entityname->Value = $entityClassName;
        $ratingForm->setAction('index.php?module=rating&page=add');
        $template->assign('ratingForm', $ratingForm);
        $template->assign('ratings', $ratingModelAdapter->fetch());
        $result = $template->fetch($view);
        return $result;
    }

    public static function getCountRating($entityClassName, $entityId) {
        $template = Amhsoft_View::getInstance();
        $ratingModelAdapter = new Rating_Model_Adapter();
        $ratingModelAdapter->where('entity_class = ?', $entityClassName, PDO::PARAM_STR);
        $ratingModelAdapter->where('entity_id = ?', $entityId);
        $ratingModelAdapter->where('state = 1');
        $result = count($ratingModelAdapter->fetch()->fetchAll());
        return $result;
    }

}

?>
