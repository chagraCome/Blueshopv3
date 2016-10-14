<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Banner
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Banner_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    protected $mainPanel;

    /**
     * Initialize Controller
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $this->getView()->setMessage(_t('Banner Settings'), View_Message_Type::INFO);
    }

    /**
     * Default Event
     */
    public function __default() {
        $this->getSetupForm();
    }

    /**
     * Setup Setting Form
     */
    protected function getSetupForm() {
        $bannerConfiguration = new Amhsoft_Config_Table_Adapter('banner');
        $panel = new Amhsoft_Widget_Panel(_t('Banner Settings'));
        $form = new Amhsoft_Widget_Form('setup_form', 'POST');
        $bannersOnline = new Amhsoft_YesNo_ListBox_Control('main_banner_frontend_state', _t('Show Banner'), 'main_banner_frontend_state', $bannerConfiguration->getValue('main_banner_frontend_state'));
        $form->addComponent($bannersOnline);
        //$bannerTransitionEffects = new Amhsoft_ListBox_Control('main_banner_frontend_transition_effect', _t('Banner Transition Effect'));
        //$array = array("fade","sliceDown","sliceDownLeft","sliceUp","sliceUpLeft","sliceUpDown","sliceUpDownLeft","fold","random","slideInRight","slideInLeft","boxRandom","boxRain","boxRainReverse","boxRainGrow","boxRainGrowReverse");
       // $bannerTransitionEffects->DataBinding = new Amhsoft_Data_Binding('main_banner_frontend_transition_effect', null, null, $bannerConfiguration->getValue('main_banner_frontend_transition_effect'));
        //$bannerTransitionEffects->DataSource = new Amhsoft_Data_Set($array);
        //$form->addComponent($bannerTransitionEffects);
        $bannerSourceListBox = new Amhsoft_ListBox_Control('banner_source', _t('Banner Source'));
        $bannerSourceListBox->DataBinding = new Amhsoft_Data_Binding('banner_source', "id", "name", $bannerConfiguration->getValue('banner_source'));
        $array = array(
            array(
                "id" => 1,
                "name" => _t('From Uploaded Banner')
            ),
            array(
                "id" => 2,
                "name" => _t('From Product images')
            )
        );
        $bannerSourceListBox->DataSource = new Amhsoft_Data_Set($array);

        $bannerWidth = new Amhsoft_Input_Control('banner_width', _t('Banner Width'));
        $bannerWidth->DataBinding = new Amhsoft_Data_Binding('banner_width');

        $bannerHeight = new Amhsoft_Input_Control('banner_height', _t('Banner Height'));
        $bannerHeight->DataBinding = new Amhsoft_Data_Binding('banner_height');

        $form->addComponent($bannerSourceListBox);
        $form->addComponent($bannerWidth);
        $form->addComponent($bannerHeight);
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $submitButton->setClass('Button Save');
        $nav = new Amhsoft_Widget_Panel(_t('Navigation'));
        $nav->addComponent($submitButton);
        $form->addComponent($nav);
        $panel->addComponent($form);
        $this->mainPanel->addComponent($panel);
        if ($this->getRequest()->isPost('submit')) {
            $form->DataSource = Amhsoft_Data_Source::Post();
            $values = $form->getValues();
            foreach ($values as $key => $val) {
                $bannerConfiguration->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }
        $form->DataSource = new Amhsoft_Data_Set($bannerConfiguration->getConfiguration());
        $form->Bind();
    }

    /**
     * Finalize Event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->mainPanel);
        $this->show();
    }

}

?>
