<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Boot.php 216 2016-01-31 17:14:53Z montassar.amhsoft $
 * $Revision: 216 $
 * $LastChangedDate: 2016-01-31 18:14:53 +0100 (dim., 31 janv. 2016) $
 * $LastChangedBy: montassar.amhsoft $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.06.2008 - 18:53:25
 */
class Modules_Crm_Frontend_Boot extends Amhsoft_System_Module_Abstract {

    public function onBoot(Amhsoft_System $system) {
        $auth = Amhsoft_Authentication::getInstance();
        if ($auth->isAuthenticated()) {
            $system->getView()->assign('loggedusername', $auth->getIdentity(), true);
            $system->getView()->assign('loggedaccount', $auth->getObject(), true);
        }

        $accountConfiguration = new Amhsoft_Config_Table_Adapter(Crm_Account_Model::SETTING);
        if ($accountConfiguration->getValue('facebook_login_state')) {
            $system->getView()->assign('facebook_login_state', $accountConfiguration->getValue('facebook_login_state'), true);
            $system->getView()->assign('facebook_app_id', $accountConfiguration->getValue('facebook_app_id'), true);
            $system->getView()->assign('facebook_secret_key', $accountConfiguration->getValue('facebook_secret_key'), true);
        }
    }

    public function getTablesToBackup() {
        return array(
            'account',
            'account_group',
            'account_has_document',
            'account_has_email',
            'account_source',
            'account_source_lang',
            'account_stage',
            'account_stage_lang',
            'address',
            'contact',
            'contact_group',
            'contact_has_document',
            'contact_has_email',
            'contact_source',
            'contact_source_lang',
            'contact_stage',
            'contact_stage_lang',
            'lead',
            'lead_group',
            'lead_has_email',
            'lead_source',
            'lead_source_lang',
        );
    }

}

?>