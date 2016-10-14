<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Modules_Rating_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * Initialize Module Menu Container
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $admin = $system->getMenuContainer()->findMenuByName("Product");
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Rating Comments"), "admin.php?module=rating&page=list"));
    }

    /**
     * On Module Install
     * @param Amhsoft_System $system
     * @return boolean
     */
    public function onInstall(Amhsoft_System $system) {
        $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
        try {
            $this->executeSQLFile($file);
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * Init RBAC Rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating', _t('Rating Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating_Backend_Delete_Controller', _t('Delete Rating'), 'Rating'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating_Backend_Details_Controller', _t('Details Rating'), 'Rating'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating_Backend_List_Controller', _t('List all Rating'), 'Rating'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating_Backend_Offline_Controller', _t('Offline Rating'), 'Rating'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Rating_Backend_Online_Controller', _t('Online Rating'), 'Rating'));
    }

    /**
     * Tables To Backup
     * @return type
     */
    public function getTablesToBackup() {
        return array(
            'entity_rating',
        );
    }
	
	/**
   * Gets last 5 Comment for portlet.
   * @return string
   */
    public static function getLast5Comment() {
    $ratingModelAdapter = new Rating_Model_Adapter();
    $ratingModelAdapter->orderBy('id DESC');
    $ratingModelAdapter->limit(5);
    $result = $ratingModelAdapter->fetch();
    $str = '<table class="grid" style="margin:0"> <tr><th>' . _t("Visitor") . '</th><th>' . _t("Date Time") . '</th><th>' . _t("Commented Propertie") . '</th></tr>';
    foreach ($result as $comment_item) {
      $link = '<a href="admin.php?module=rating&page=details&id=' . $comment_item->getId() . '"> ' . _t("Details") . ' </a>';
      $str .= '<tr>';
      $str .= '<td><a href="admin.php?module=rating&page=details&id=' . $comment_item->getId() . '"> ' . $comment_item->getName() . '</a></td>';
      $str .= '<td>' . Amhsoft_Locale::DateTime($comment_item->rate_date_time) . '</td>';
      
      $productModelAdapter = new Product_Product_Model_Adapter();
      $productModel= $productModelAdapter->fetchById($comment_item->getEntityId());
      if($productModel instanceof Product_Product_Model){
      $link2= '<a href="admin.php?module=product&page=product-detail&id='. $comment_item->getEntityId() .'">'.$productModel->getTitle().'</a>';
      $str .= '<td>' . $link2 . '</td>';}
      $str .= '</tr>';
    }
    $str .= '</table>';
    return $str;
  }

}

?>
