<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 367 2016-02-09 16:05:03Z amira.amhsoft $
 * $Rev: 367 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-09 17:05:03 +0100 (mar., 09 févr. 2016) $
 * $LastChangedDate: 2016-02-09 17:05:03 +0100 (mar., 09 févr. 2016) $
 * $Author: amira.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of list
 *
 * @author cherif
 */
class Banner_Backend_List_Controller extends Amhsoft_System_Web_Controller {

  /** @var ImageDataGridView $bannerDataGridView */
  protected $bannerDataGridView;

  /** @var ImageModelAdapter $bannerModelAdapter */
  protected $bannerModelAdapter;

  public function __initialize() {
    $this->bannerModelAdapter = new Banner_Model_Adapter();
    $this->bannerDataGridView = new Banner_DataGridView();
    $this->bannerDataGridView->Sortable = true;
    $this->bannerDataGridView->Searchable = true;
	$this->bannerDataGridView->Draggable = true;
    $this->bannerDataGridView->DragUrl = 'admin.php?module=banner&page=list&event=sort';
	$this->bannerModelAdapter->orderBy('sortid, id DESC');
    $this->bannerDataGridView->setWithPagination(true);
    $this->getView()->setMessage(_t('List Banners'), View_Message_Type::INFO);
  }

  public function __default() {
    $this->bannerDataGridView->performSort($this->getRequest(), $this->bannerModelAdapter);
    $this->bannerDataGridView->performSearch($this->getRequest(), $this->bannerModelAdapter);
  }
	
	
 /**
     * Sort Banner event
     */
    public function __sort() {
        $changes = false;
        foreach ($this->getRequest()->posts('grid') as $sortid => $itemid) {
            if (intval($itemid) > 0) {
                Amhsoft_Database::getInstance()->exec("UPDATE banner SET sortid = $sortid WHERE id = $itemid");
                $changes = true;
            }
        }

        exit;
    }	
  public function __finalize() {
    $projects = $this->bannerModelAdapter->fetch();
    $this->bannerDataGridView->DataSource = new Amhsoft_Data_Set($projects);
    $this->getView()->assign('grid', $this->bannerDataGridView);
    $this->show();
  }

}

?>
