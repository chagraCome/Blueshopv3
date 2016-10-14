<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Setting.php 334 2016-02-04 16:22:04Z montassar.amhsoft $
 * $Rev: 334 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-04 17:22:04 +0100 (jeu., 04 févr. 2016) $
 * $Author: montassar.amhsoft $
 */

/**
 * Description of setting
 *
 * @author Montasser
 */
class Cms_Backend_Setting_Controller extends Amhsoft_System_Web_Controller {

    protected $mainPanel;
    protected $cmsSettingsForm;
    protected $cmsConfiguration;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->mainPanel = new Amhsoft_Widget_Panel();
        $this->getView()->setMessage(_t('Home page Settings'), View_Message_Type::INFO);
        $this->cmsConfiguration = new Amhsoft_Config_Table_Adapter("cms_settings");
        $this->cmsSettingsForm = new Amhsoft_Widget_Form('cms_settings', 'POST');

        $this->loadHomePageSettings();

        $panel = new Amhsoft_Widget_Panel(_t('Action'));
        $submitButton = new Amhsoft_Button_Submit_Control('submit', _t('Save'));
        $panel->addComponent($submitButton);
        $this->cmsSettingsForm->addComponent($panel);
        $this->mainPanel->addComponent($this->cmsSettingsForm);
    }

    /**
     * Default event
     */
    public function __default() {
        if ($this->getRequest()->isPost('submit')) {
            $values = $this->cmsSettingsForm->getValues();
            foreach ($values as $key => $val) {
                $this->cmsConfiguration->setValue($key, $val);
            }
            $this->getView()->setMessage(_t('Data was successfully saved'), View_Message_Type::SUCCESS);
        }

        $this->cmsSettingsForm->DataSource = new Amhsoft_Data_Set($this->cmsConfiguration->getConfiguration());
        $this->cmsSettingsForm->Bind();
    }

    public function loadHomePageSettings() {
        $panel = new Amhsoft_Widget_Panel(_t('Home page design'));

        $contentArray = array(
            array('name' => _t('Latest Products'), 'value' => 'latestproducts'),
            array('name' => _t('Special Products'), 'value' => 'specialproducts'),
            array('name' => _t('New Products'), 'value' => 'newproducts'),
        );

        $homePageContent = new Amhsoft_ListBox_Control('product_homepage', _t('Home page products'));
        $homePageContent->DataBinding = new Amhsoft_Data_Binding('product_homepage', 'value', 'name', $this->cmsConfiguration->getValue('product_homepage'));
        $homePageContent->Required = true;
        $homePageContent->DataSource = new Amhsoft_Data_Set($contentArray);

        $homeProductCount = new Amhsoft_ListBox_Control('homepage_product_count', _t('Home page products count'));
        $homeProductCount->DataBinding = new Amhsoft_Data_Binding('homepage_product_count', null, null, $this->cmsConfiguration->getValue('homepage_product_count'));
        $homeProductCount->Required = true;
        $homeProductCount->DataSource = new Amhsoft_Data_Set(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20));

        $showHomePageText = new Amhsoft_YesNo_ListBox_Control('show_home_page_text', _t('Show Home page text'), 'show_home_page_text', $this->cmsConfiguration->getValue('show_home_page_text', 4));

        $showManuFacturerCarrousel = new Amhsoft_YesNo_ListBox_Control('show_manufacturer_home_page', _t('Show Manufacturer in home page'), 'show_manufacturer_home_page', $this->cmsConfiguration->getValue('show_manufacturer_home_page', 4));


        $panel->addComponent($homePageContent);
        $panel->addComponent($showHomePageText);
        $panel->addComponent($homeProductCount);
        $panel->addComponent($showManuFacturerCarrousel);
        $this->cmsSettingsForm->addComponent($panel);
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('panel', $this->mainPanel);
        $this->show();
    }

}

?>
