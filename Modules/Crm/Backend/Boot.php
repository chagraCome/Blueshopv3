<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Boot.php 319 2016-02-04 13:56:16Z montassar.amhsoft $
 * $Rev: 319 $
 * @package    Crm
 * @copyright  2006-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-02-04 14:56:16 +0100 (jeu., 04 févr. 2016) $
 * $LastChangedDate: 2016-02-04 14:56:16 +0100 (jeu., 04 févr. 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

class Modules_Crm_Backend_Boot extends Amhsoft_System_Module_Abstract {

    /**
     * On Module Boot Actoion.
     * @param Amhsoft_System $system
     */
    public function onBoot(Amhsoft_System $system) {
        $system->publishModel('Crm_Account_Model', 'Account');
        $system->publishForImport('Crm_Import_Account_Model', 'Account');
        $system->publishForImport('Crm_Import_Contact_Model', 'Contact');
    }

    /**
     * On Initi Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $crmMenu = $system->getMenuContainer()->findMenuByName('Crm');
        $crmMenu->setLabel(_t("CRM"));
        $crmMenu
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t('Manage Accounts'), "admin.php?module=crm&page=account-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Contacts"), "admin.php?module=crm&page=contact-list"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Groups"), "admin.php?module=crm&page=group-account"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Sources"), "admin.php?module=crm&page=source-account"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Account Set"), "admin.php?module=eav&page=attributeset-detail&entity=3&id=11"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Account Attributes"), "admin.php?module=eav&page=attributes-list&entity=3"))
                ->AddItem(new Amhsoft_Widget_Menu_Item(_t("Settings"), "admin.php?module=crm&page=accountsetting"));
    }

    /**
     * On Module install action.
     * @param Amhsoft_System $system
     * @return boolean
     */
    public function onInstall(Amhsoft_System $system) {
        $file = dirname(dirname(__FILE__)) . '/Install/mysql.sql';
        try {
            $this->executeSQLFile($file);
            if (Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
                $page = new Cms_Page_Model();
                $page->setAlias('crm.frontend.contact');
                $page->setTitle('Contact');
                $page->setContent('contact content');
                $page->setFixed(1);
                $page->setState(1);
                $pageModelAdapter = new Cms_Page_Model_Adapter();
                $pageModelAdapter->save($page);
            }
            return true;
        } catch (Exception $e) {
            return false;
        }
    }

    /**
     * After Module Install Action.
     * @param Amhsoft_System $system
     */
    public function afterInstall(Amhsoft_System $system) {
        $system->getRedirector()->go('admin.php?module=crm&page=setting');
    }

    /**
     * Init RBAC Rules.
     * @param Amhsoft_System $system
     */
    public function initRBAC(Amhsoft_System $system) {
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm', _t('Crm Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Accountsetting_Controller', _t('Set account Settings'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_List_Controller', _t('List all Accounts'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Add_Controller', _t('Add new Account'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Detail_Controller', _t('Show Account Information'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Modify_Controller', _t('Modify Account'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Delete_Controller', _t('Delete Accoount'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Quicklist_Controller', _t('Account Quicklist'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Source_Controller', _t('Account Source'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Group_Controller', _t('Account Group'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Address_Add_Controller', _t('Add Account address'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Address_Modify_Controller', _t('Modify Account address'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Address_Delete_Controller', _t('Delete Account address'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Document_Add_Controller', _t('Add Account Document'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Document_Delete_Controller', _t('Delete Account Document'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Account_Document_Detail_Controller', _t('Detail Account Document'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contactsetting_Controller', _t('Set contact Settings'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Document_Add_Controller', _t('Add Contact Document'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Document_Delete_Controller', _t('Delete Contact Document'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_List_Controller', _t('List all Contacts'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Quicklist_Controller', _t('Show Contacts Quicklist'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Add_Controller', _t('Add new Contact'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Detail_Controller', _t('Show Contact Information'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Modify_Controller', _t('Modify Contact'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Contact_Delete_Controller', _t('Delete Contact'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Inbox_Add_Controller', _t('Add new Message'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Inbox_Modify_Controller', _t('Modify Message'), 'Crm'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Crm_Backend_Inbox_Delete_Controller', _t('Delete Message'), 'Crm'));
    }

    /**
     * Get Last 5 Accounts for home portlet.
     * @return string
     */
    public static function getLast5Accounts() {
        $crmLeadAdapter = new Crm_Account_Model_Adapter();
        $crmLeadAdapter->orderBy('id DESC');
        $crmLeadAdapter->limit(5);
        $result = $crmLeadAdapter->fetch();
        $str = '<table class="grid" style="margin:0"> <tr><th>' . _t("Item") . '</th><th>' . _t("Date Time") . '</th><th>' . _t("Link") . '</th></tr>';
        foreach ($result as $account) {
            $link = '<a href="admin.php?module=crm&page=account-detail&id=' . $account->getId() . '"> ' . _t("Details") . ' </a>';
            $str .= '<tr>';
            $str .= '<td>' . $account->getName() . '</td>';
            $str .= '<td>' . Amhsoft_Locale::DateTime($account->register_date_time) . '</td>';
            $str .= '<td>' . $link . '</td>';
            $str .= '</tr>';
        }
        $str .= '</table>';
        return $str;
    }

    /**
     * Get Last 5 Contacts for home portlet.
     * @return string
     */
    public static function getLast5Contacts() {
        $crmLeadAdapter = new Crm_Contact_Model_Adapter();
        $crmLeadAdapter->orderBy('id DESC');
        $crmLeadAdapter->limit(5);
        $result = $crmLeadAdapter->fetch();
        $str = '<table class="grid" style="margin:0"> <tr><th>' . _t("Item") . '</th><th>' . _t("Date Time") . '</th><th>' . _t("Link") . '</th></tr>';
        foreach ($result as $contact) {
            $link = '<a href="admin.php?module=crm&page=contact-detail&id=' . $contact->getId() . '"> ' . _t("Details") . ' </a>';
            $str .= '<tr>';
            $str .= '<td>' . $contact->name . '</td>';
            $str .= '<td>' . Amhsoft_Locale::DateTime($contact->create_date_time) . '</td>';
            $str .= '<td>' . $link . '</td>';
            $str .= '</tr>';
        }
        $str .= '</table>';
        return $str;
    }

    /**
     * Get Last 5 Contacts for home portlet.
     * @return string
     */
    public static function getLast5Leads() {
        $crmLeadAdapter = new Crm_Lead_Model_Adapter();
        $crmLeadAdapter->orderBy('id DESC');
        $crmLeadAdapter->limit(5);
        $result = $crmLeadAdapter->fetch();
        $str = '<table class="grid" style="margin:0"> <tr><th>' . _t("Item") . '</th><th>' . _t("Date Time") . '</th><th>' . _t("Link") . '</th></tr>';
        foreach ($result as $lead) {
            $link = '<a href="admin.php?module=crm&page=lead-detail&id=' . $lead->getId() . '"> ' . _t("Details") . ' </a>';
            $str .= '<tr>';
            $str .= '<td>' . $lead->name . '</td>';
            $str .= '<td>' . Amhsoft_Locale::DateTime($lead->create_date_time) . '</td>';
            $str .= '<td>' . $link . '</td>';
            $str .= '</tr>';
        }
        $str .= '</table>';
        return $str;
    }

    public function onUpdate(Amhsoft_System $system, $installedVersion) {
        if (version_compare('3.0', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-3.0.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('3.1', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-3.1.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('3.2', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-3.2.sql';
            $this->executeSQLFile($file);
        }
        if (version_compare('3.3', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-3.3.sql';
            $this->executeSQLFile($file);
        }

        if (version_compare('3.7', $installedVersion, ">")) {
            $file = dirname(dirname(__FILE__)) . '/Install/upgrade-3.7.sql';
            $this->executeSQLFile($file);
        }
    }

    public function getFolderToBackup() {
        return array('media/account', 'media/contact');
    }

    public function getTablesToBackup() {
        return array(
            'account',
            'contact',
            'lead',
            'account_group',
            'account_has_document',
            'account_has_email',
            'account_source',
            'account_source_lang',
            'address',
            'contact_group',
            'contact_has_document',
            'contact_has_email',
            'contact_source',
            'contact_source_lang',
            'lead',
            'lead_group',
            'lead_has_email',
            'lead_source',
            'lead_source_lang'
        );
    }

}

?>
