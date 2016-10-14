<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: BannerImageDataGridView.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Cms
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */
Application::import('Amhsoft.global.image.ImageDataGridView');

class BannerImageDataGridView extends ImageDataGridView {

  /**
   * Grid Construct
   * @param type $adapter
   */
  public function __construct($adapter = null) {
    parent::__construct($adapter);
  }

  /**
   * Initialize Grid Components
   */
  public function initializeComponents() {
    parent::initializeComponents();
    $delLinkCol = new Link(_t('Edit'), 'index.php?module=cms&page=modify-banner');
    $delLinkCol->DataBinding = new DataBinding('id');
    $delLinkCol->Class = 'edit';
    $delLinkCol->setWidth(80);
    $editLink = new Link(_t('Delete'), 'index.php?module=cms&page=delete-banner');
    $editLink->DataBinding = new DataBinding('id');
    $editLink->Class = 'delete';
    $editLink->setWidth(80);
    $this->AddColumn($delLinkCol);
    $this->AddColumn($editLink);
  }

}

?>
