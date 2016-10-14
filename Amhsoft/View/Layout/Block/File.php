<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: File.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */
/**
 * Description of FileBlock
 *
 * @author cherif
 */
class Amhsoft_View_Layout_Block_File implements Amhsoft_View_Layout_Block_Interface{

    protected $fileName;
    protected $title;
    protected $template;
    protected $decorator;
    protected $blockid;
    protected $border;

    public function __construct($fileName, $title=null, $template=null, $blockid=null, $border=true) {
        $this->title = $title;
        $this->fileName = $fileName;
        $this->template = $template;
        $this->blockid = $blockid;
        $this->border = $border;
    }
    
    public function getTemplate() {
        return $this->template;
    }

    public function setTemplate($template) {
        $this->template = $template;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

        public function Render() {
            
        if ($this->title == null) {
            $tpl = Amhsoft_View::getInstance()->createTemplate($this->template);
            Amhsoft_View::getInstance()->assign('block_id', $this->blockid);
            Amhsoft_View::getInstance()->assign('block_id', $this->blockid);
            $content = Amhsoft_View::getInstance()->fetch($this->fileName);
            return $content;
        }else{
            $tpl = Amhsoft_View::getInstance()->createTemplate($this->template);
            Amhsoft_View::getInstance()->assign('block_id', $this->blockid);
            $content = Amhsoft_View::getInstance()->fetch($this->fileName);
            $tpl->assign('block_content',  html_entity_decode($content));
            $tpl->assign('block_title', $this->title);
            $tpl->assign('block_border', $this->border);
            $tpl->assign('block_id', $this->blockid);
            return $tpl->fetch($this->template);
        }
    }

}

?>
