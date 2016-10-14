<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Page.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Revision: 446 $
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $LastChangedBy: imen.amhsoft $
 * @package    Cms
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    18.11.2010 - 12:39:00
 */
class Cms_Frontend_Page_Controller extends Amhsoft_System_Web_Controller {

    /** @var Cms_Page_Model_Adapter CMS Page Model Adapter */
    protected $cmsPageModelAdapter;

    /** @var Cms_Page_Model CMS Page Model */
    protected $cmsPageModel;

    /** @var integer id */
    protected $id;

    /**
     * Initialize Components.
     */
    public function __initialize() {
        $this->id = $this->getRequest()->getId();
        $this->cmsPageModelAdapter = new Cms_Page_Model_Adapter();
        if ($this->id <= 0) {
            $site = $this->getRequest()->get('site');
            $site = rtrim($site, '/');
            $cmsSiteModelAdapter = new Cms_Site_Model_Adapter();
            $cmsSite = $cmsSiteModelAdapter->fetchByRoot($site);
            if ($cmsSite == null || !$cmsSite instanceof Cms_Site_Model) {
                die('Site not found!');
            }
            if ($cmsSite->getHomepage() <= 0) {
                die('Site has no home page');
            }
            $this->id = intval($cmsSite->getHomepage());
        }
        if ($this->id < 0) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }
        $this->cmsPageModel = $this->cmsPageModelAdapter->fetchById($this->id);
        if (!$this->cmsPageModel) {
            $this->getRedirector()->error_404();
        }
        $this->_title = $this->cmsPageModel->getTitle();
        $this->_description = $this->cmsPageModel->getDescription();
        if ($this->cmsPageModel->cms_site_id == 3) {
            Amhsoft_System_Config::getInstance()->logo = 'images/logos/service.png';
        }
        if ($this->cmsPageModel->cms_site_id == 4) {
            Amhsoft_System_Config::getInstance()->logo = 'images/logos/trading.png';
        }
        if ($this->cmsPageModel->cms_site_id == 5) {
            Amhsoft_System_Config::getInstance()->logo = 'images/logos/tekorent.png';
        }
        if (!$this->cmsPageModel instanceof Cms_Page_Model) {
            throw new Amhsoft_Item_Not_Found_Exception();
        }

        $this->_title = $this->cmsPageModel->getTitle();
        $this->_description = $this->cmsPageModel->getDescription();
        $this->_keywords = $this->cmsPageModel->getKeywords();
    }

    /**
     * Default Event.
     */
    public function __default() {
        $this->title = $this->cmsPageModel->title;
        $this->pageId = $this->cmsPageModel->getId();
    }

    public function buildSubmenus() {
        $this->getView()->assign('sub_menus_title', $this->cmsPageModel->getMenu()->getParent()->title);
        $this->getView()->assign('sub_menus', $this->cmsPageModel->getMenu()->getParent()->getChildrens(1));
    }

    /**
     * Finalize
     */
    public function __finalize() {
        $this->getView()->assign('admin_logged_in', Modules_Cms_Frontend_Boot::inBackendLoggedIn());
        $this->cmsPageModel->description;
        $this->cmsPageModel->keywords;
        $this->getView()->assign('page', $this->cmsPageModel);
        $this->show();
    }

}
