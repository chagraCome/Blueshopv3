<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Index.php 460 2016-02-26 16:15:17Z montassar.amhsoft $
 * $Rev: 460 $
 * @package    Default
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-26 17:15:17 +0100 (ven., 26 févr. 2016) $
 * $Author: montassar.amhsoft $
 */
class Default_Frontend_Index_Controller extends Amhsoft_System_Web_Controller {

    /**
     * Initialize controller
     */
    public function __initialize() {
        $this->_title = Amhsoft_System_Config::getProperty('name_'. Amhsoft_System::getCurrentLang());
        $this->_description = Amhsoft_System_Config::getProperty('description_' . Amhsoft_System::getCurrentLang());
        $this->_keywords = Amhsoft_System_Config::getProperty('keywords_' . Amhsoft_System::getCurrentLang());
    }

    /**
     * Default event
     */
    public function __default() {
        $cmsConfiguration = new Amhsoft_Config_Table_Adapter("cms_settings");

        if ($cmsConfiguration->getValue('show_home_page_text', 0) == 1) {
            if (Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
                $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
                $cmsPageModelAdapter->where('state = 1');
                $cmsPageModelAdapter->fetchById(1);
                $cmsPageModel = $cmsPageModelAdapter->fetch()->fetch();
                if ($cmsPageModel instanceof Cms_Page_Model) {
                    $this->getView()->assign('homePageContent', $cmsPageModel);
                }
            }
        }

        $this->getView()->assign('show_manufacturer_home_page', $cmsConfiguration->getValue('show_manufacturer_home_page'));
        $this->getView()->assign('product_homepage', $cmsConfiguration->getValue('product_homepage'));
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->show();
    }

}

?>
