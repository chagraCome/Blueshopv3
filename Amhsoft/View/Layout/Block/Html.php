<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Html.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of HtmlBlock
 *
 * @author cherif
 */
class Amhsoft_View_Layout_Block_Html implements Amhsoft_View_Layout_Block_Interface {

  protected $htmlContent;
  protected $title;
  protected $template;
  protected $blockid;
  protected $border;

  public function __construct($htmlContent, $title = null, $template = 'box.tpl.html', $blockid = 0, $border=true) {
    $this->htmlContent = $htmlContent;
    $this->title = $title;
    $this->template = $template;
    $this->blockid = $blockid;
    $this->border = $border;
  }

  public function Render() {
    if ($this->title == null) {
      return html_entity_decode($this->htmlContent);
      
    } else {
      
      $tpl = Amhsoft_View::getInstance()->createTemplate($this->template);
      $tpl->assign('block_title', $this->title);
      $tpl->assign('block_content', ($this->htmlContent));
      $tpl->assign('block_id', $this->blockid);
      $tpl->assign('block_border', $this->border);
      return $tpl->fetch($this->template);
    }
  }

}

?>
