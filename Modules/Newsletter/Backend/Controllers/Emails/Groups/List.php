<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: List.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Newsletter
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 * *********************************************************************************************** */

class Newsletter_Backend_Emails_Groups_List_Controller extends Amhsoft_System_Web_Controller {

    /** @var Newsletter_Emails_Groups_DataGridView $newsletterEmailsGroupsDataGridView */
    protected $newsletterEmailsGroupsDataGridView;

    /** @var Newsletter_Email_Group_Model_Adapter $newsletterEmailGroupModelAdapter */
    protected $newsletterEmailGroupModelAdapter;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->newsletterEmailGroupModelAdapter = new Newsletter_Email_Group_Model_Adapter();
        $this->newsletterEmailsGroupsDataGridView = new Newsletter_Emails_Groups_DataGridView();
        $this->newsletterEmailsGroupsDataGridView->Sortable = true;
        $this->newsletterEmailsGroupsDataGridView->Searchable = true;
        $this->newsletterEmailsGroupsDataGridView->setWithPagination(true);
        $this->newsletterEmailGroupModelAdapter->orderBy("id DESC");
        $this->getView()->setMessage(_t('List Email Groups'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->newsletterEmailsGroupsDataGridView->performSort($this->getRequest(), $this->newsletterEmailGroupModelAdapter);
        $this->newsletterEmailsGroupsDataGridView->performSearch($this->getRequest(), $this->newsletterEmailGroupModelAdapter);
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $items = $this->newsletterEmailGroupModelAdapter->fetch();
        $this->newsletterEmailsGroupsDataGridView->DataSource = new Amhsoft_Data_Set($items);
        $this->getView()->assign('widget', $this->newsletterEmailsGroupsDataGridView);
        $this->show();
    }

}
?>

