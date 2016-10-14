<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Modules_Workflow_Backend_Boot extends Amhsoft_System_Module_Abstract {

    public function initTranslation(Amhsoft_System $system) {
        if ($system->getCurrentLang() == 'ar') {
            $arabic = new Amhsoft_Config_Po_Adapter('Modules/Workflow/I18N/ar.po');
            $system->appendToTranslation($arabic->getDataAsArray());
        }
    }

    /**
     * Create Menu Container.
     * @param Amhsoft_System $system
     */
    public function onInitMenuContainer(Amhsoft_System $system) {
        $admin = $system->getMenuContainer()->findMenuByName("Workflow");
        $admin->setLabel(_t("Workflow"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Manage Workflows"), "admin.php?module=workflow&page=workflow-list"));
        $admin->AddItem(new Amhsoft_Widget_Menu_Item(_t("Add new Workflow"), "admin.php?module=workflow&page=workflow-add"));
    }

    public function initRBAC(Amhsoft_System $system) {

        //this->registerRbacControllerOb

        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow', _t('Workflow Module'), null));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_List_Controller', _t('List all Workflow'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Add_Controller', _t('Add new Workflow'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Modify_Controller', _t('Modify Workflow'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Details_Controller', _t('Show Workflow Informations '), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Delete_Controller', _t('Delete Workflow'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Online_Controller', _t('Set Workflow Online'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Workflow_Offline_Controller', _t('Set Workflow Offline'), 'Workflow'));

        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Action_Add_Controller', _t('Add new Workflow Action'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Action_Modify_Controller', _t('Modify Workflow Action'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Action_Details_Controller', _t('Show Workflow Action Informations '), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Action_Delete_Controller', _t('Delete Workflow Action'), 'Workflow'));

        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Add_Controller', _t('Add new Workflow Condition'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Modify_Controller', _t('Modify Workflow Condition'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Details_Controller', _t('Show Workflow Condition Informations '), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Delete_Controller', _t('Delete Workflow Condition'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Online_Controller', _t('Set Workflow Condition Online'), 'Workflow'));
        $system->registerRBACRule(new Amhsoft_RBAC_Rule('Workflow_Backend_Condition_Offline_Controller', _t('Set Workflow Condition Offline'), 'Workflow'));
    }

}

?>
