<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Controller.php 418 2016-02-11 16:28:26Z amira.amhsoft $
 * $Rev: 418 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-02-11 17:28:26 +0100 (jeu., 11 févr. 2016) $
 * $Author: amira.amhsoft $
 */
class Amhsoft_System_Web_Controller {

    protected $channel;
    protected $pageId = 1;
    protected $layout;
    protected $skin;
    protected $design;

    /** @var Amhsoft_View $view */
    protected $view;
    protected $layoutName;
    private $request;
    private $redirector;
    public static $css_scripts = array();
    public static $js_scripts = array();
    public $_title;
    public $_description;
    public $_keywords;
    public $breadcrumb = array();

    public function __construct() {
        $this->request = new Amhsoft_Web_Request();
        $this->redirector = new Amhsoft_Navigator();
        $this->view = Amhsoft_View::getInstance();
        $this->view->assign('shop', Amhsoft_System_Config::getInstance());
        $this->view->assign('appconfig', Amhsoft_System_Config::getInstance());
        $this->view->assign('appurl', rtrim(Amhsoft_System_Config::getProperty('appurl'), '/') . '/');
        $this->breadcrumb[] = array('label' => _t('Home'), 'link' => 'index.php');
        Amhsoft_History::Observe();
    }

    public function getView() {
        return $this->view;
    }

    public function getRequest() {
        return $this->request;
    }

    public function getRedirector() {
        return $this->redirector;
    }

    public function setBreadCrumb($breadcrumb = array()) {
        $this->breadcrumb[] = $breadcrumb;
        return $this;
    }

    public function renderBreadCrumb() {
        $str = '<section class="breadcrumbs"><div class="container"><ul class="horizontal_list clearfix bc_list f_size_medium">';
        foreach ($this->breadcrumb as $key => $bread) {
            if (!empty($bread)) {
                if ($key == 0) {
                    $str .='<li class="m_right_5 current"><a class="default_t_color" href="' . $bread['link'] . '"><i class="fa fa-home"></i>&nbsp;&nbsp;' . $bread['label'] . '</a></li>';
                } else if ($key == count($this->breadcrumb)) {
                    $str .='<li class="m_right_5"><a class="default_t_color" href="' . $bread['link'] . '">&nbsp;&nbsp;' . $bread['label'] . '</a></li>';
                } else {
                    $str .='<li class="m_right_5"><a class="default_t_color" href="' . $bread['link'] . '">&nbsp;<i class="fa fa-angle-double-right "></i>&nbsp;&nbsp;' . $bread['label'] . '</a></li>';
                }
            }
        }
        $str .='</ul></div></section>';
        return $str;
    }

    protected function includeJsFile($jsFile, $relative = true) {
        if ($relative == true) {
            self::$js_scripts[] = $this->parseJsDir() . ltrim($jsFile, '/');
        } else {
            self::$js_scripts[] = $jsFile;
        }
    }

    protected function includeCssFile($cssFile, $relative = true) {
        if ($relative == true) {
            self::$css_scripts[] = $this->parseCssDir() . ltrim($cssFile, '/');
        } else {
            self::$css_scripts[] = $cssFile;
        }
    }

    public function initializeComponents() {
        
    }

    protected function getDesign() {
        
    }

    protected function getSkin() {
        
    }

    public function setChannel($channel) {
        $this->channel = $channel;
    }

    public function getChannel() {
        return $this->channel;
    }

    public function getElement($name) {
        return $this->$name;
    }

    public function callFunction($functionName) {
        return $this->{$functionName}();
    }

    protected function close($params = array()) {
        $script = '<script type="text/javascript">';
        if (empty($params)) {
            $script .= 'window.opener.location.reload();';
        }
        foreach ((array) $params as $key => $val) {
            $script .= 'window.opener.$("[name=' . $key . ']").val("' . $val . '");';
        }
        $script .='window.close();</script>';
        echo $script;
    }

    protected function setUpLayout($template, $pageId = null, $pageAlias = null) {
        if (Amhsoft_System::isCached() || !Amhsoft_System_Module_Manager::isModuleInstalled('Cms')) {
            return;
        }

        /** if (intval($this->pageId) == 0) {
          $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
          $cmsPage = $cmsPageModelAdapter->fetchByAlias($this->getChannel());

          if ($cmsPage instanceof Cms_Page_Model) {
          $this->pageId = $cmsPage->getId();
          } else {
          $this->pageId = Cms_Site_Model::getDefault()->getHomePage();
          if (!$this->pageId) {
          return;
          }
          }
          }* */
        if (intval($this->pageId) == 0) {
            $cmsPageModelAdapter = new Cms_Page_Model_Adapter();
            $cmsPage = $cmsPageModelAdapter->fetchByAlias($this->getChannel());

            if (!$cmsPage instanceof Cms_Page_Model) {
                return;
            }
            $this->pageId = $cmsPage->getId();
        }



        global $system;
        $boxModelAdapter = Cms_Page_Model::getBoxes($this->pageId);
        //$system->getLayoutManager()->addBlock(new Amhsoft_View_Layout_Block_File($template, $this->_title, 'page.tpl.html'), Amhsoft_View_Layout_Page::CENTER);
        foreach ($boxModelAdapter->fetch() as $box) {
            if ($box->file) {
                $block = new Amhsoft_View_Layout_Block_File($box->file, $box->name, 'box.tpl.html', $box->id, $box->border);
                $system->getLayoutManager()->addBlock($block, $box->position);
                continue;
            } elseif ($box->image) {
                continue;
            } else {
                $system->getLayoutManager()->addBlock(new Amhsoft_View_Layout_Block_Html($box->html, ($box->border ? $box->name : null), 'box.tpl.html', $box->id), $box->position, $box->border);
            }
        }

        $ob = new Cms_Menu_Model_Adapter();
        $ob->orderBy('id ASC');
        $system->getView()->assign('area_cms_menus', $ob);
    }

    private function parseJsDir() {
        $className = get_class($this);
        $pieces = explode('_', $className);
        array_pop($pieces);
        $module = array_shift($pieces);
        $level = array_shift($pieces);
        return 'Modules/' . $module . '/' . $level . '/Views/_Javascripts/';
    }

    private function parseCssDir() {
        $className = get_class($this);
        $pieces = explode('_', $className);
        array_pop($pieces);
        $module = array_shift($pieces);
        $level = array_shift($pieces);
        return 'Modules/' . $module . '/' . $level . '/Views/_Css/';
    }

    private function parseViewFile() {
        $className = get_class($this);
        $pieces = explode('_', $className);
        array_pop($pieces);
        $module = array_shift($pieces);
        $level = array_shift($pieces);
        $extendsFile = 'Design/' . $level . '/' . Amhsoft_System::getLayout() . '/Modules/' . $module . '/' . $level . '/Views/' . implode('/', $pieces) . '.html';
        if (file_exists($extendsFile)) {
            return $extendsFile;
        }
        $viewDir = 'Modules/' . $module . '/' . $level . '/Views/' . implode('/', $pieces) . '.html';
        return $viewDir;
    }

    public function show($page = null) {

        $this->getView()->assign('js_files', self::$js_scripts);
        $this->getView()->assign('css_files', self::$css_scripts);
        $this->getView()->assign('page_description', $this->_description);
        $this->getView()->assign('page_title', $this->_title);
        $this->getView()->assign('page_keywords', $this->_title);
        $this->getView()->assign('breadcrumb', $this->renderBreadCrumb());

        if ($page == null) {
            $page = $this->parseViewFile();
        }

        if (Amhsoft_System::getLevel() == 'Frontend' || Amhsoft_System::getLevel() == 'DealerLevel') {
            global $system;
            $this->setUpLayout($page);
            $block = new Amhsoft_View_Layout_Block_File($page, null, 'page.tpl.html');
            $system->getLayoutManager()->addBlock($block, Amhsoft_View_Layout_Page::CENTER);
            $system->getLayoutManager()->setup($this->view);
        } else {
            $this->view->assign('content_page', $page);
        }
        //$this->view->assign("content_page", $this->parseViewFile());
        if ($this->getRequest()->get('ret') == 'true') {
            $this->view->setMessage(_t('Action was successfully done'), View_Message_Type::SUCCESS);
        }
        if ($this->getRequest()->get('ret') == 'false') {
            $this->view->setMessage(_t('Action faild'), View_Message_Type::ERROR);
        }
        $this->view->assign('layout_path', $this->view->getLayoutPath());
        $this->view->assign('skin_path', $this->view->getSkinPath());


        Amhsoft_Debugger::getInstance()->getCollector('Smarty')->setData($this->view->getTemplateVars());

        if (Amhsoft_Navigator::$DEBUG_MODE == true) {
            Amhsoft_Web_Responce::setContent($this->view->fetch('index.tpl.html'));
        } else {
            $this->view->display('index.tpl.html', $this->view->cache_id);
        }
    }

    public function popup($page = null) {


        $this->includeCssFile('Design/' . Amhsoft_System::getLevel() . '/' . Amhsoft_System::getLayout() . '/Layout/' . Amhsoft_System::getSkin() . '/stylesheet_' . strtolower(Amhsoft_System::getCurrentLang()) . '.css', false);
        $this->getView()->assign('js_files', self::$js_scripts);
        $this->getView()->assign('css_files', self::$css_scripts);

        if ($page == null) {
            $page = $this->parseViewFile();
        }
        $this->view->assign('layout_path', $this->view->getLayoutPath());
        $this->view->assign('skin_path', $this->view->getSkinPath());
        $this->view->assign('content_page', $page);
        $this->view->display('popup.tpl.html');
    }

}

?>
