<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Page.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_View_Layout_Page
 *
 * @author cherif
 */
class Amhsoft_View_Layout_Page {

  protected $topBlocks = array();
  protected $rightBlocks = array();
  protected $leftBlocks = array();
  protected $bottomBlocks = array();
  protected $mainBlocks = array();
  public static $blockCount = 0;
  protected $mainBlockstop = array();
  protected $mainBlocksbottom = array();

  const TOP = 'T';
  const LEFT = 'L';
  const RIGHT = 'R';
  const BOTTOM = 'B';
  const CENTER = 'C';
  const CENTER_TOP = 'CT';
  const CENTER_BOTTOM = 'CB';

  /**
   * Add block to layout
   * @param Block $block 
   */
  public function addBlock(Amhsoft_View_Layout_Block_Interface $block, $position) {
    switch ($position) {
      case Amhsoft_View_Layout_Page::TOP:
        if ($block instanceof Amhsoft_View_Layout_Block_File) {
          $block->setTitle(null);
        }
        $this->topBlocks[] = $block;
        self::$blockCount++;
        break;
      case Amhsoft_View_Layout_Page::BOTTOM:
        $this->bottomBlocks[] = $block;
        self::$blockCount++;
        break;
      case Amhsoft_View_Layout_Page::RIGHT:
        $this->rightBlocks[] = $block;
        self::$blockCount++;
        break;
      case Amhsoft_View_Layout_Page::CENTER:
        $this->mainBlocks[] = $block;
        self::$blockCount++;
        break;
       case Amhsoft_View_Layout_Page::CENTER_TOP:
        $this->mainBlockstop[] = $block;
        self::$blockCount++;
        break;
       case Amhsoft_View_Layout_Page::CENTER_BOTTOM:
        $this->mainBlocksbottom[] = $block;
        self::$blockCount++;
        break;
      case Amhsoft_View_Layout_Page::LEFT:
        $this->leftBlocks[] = $block;
        self::$blockCount++;
        break;
      default:
        break;
    }
  }

  public function setup(Amhsoft_View $view) {



    $view->assign('headerblocks', $this->topBlocks);
    $view->assign('mainblocks', $this->mainBlocks);
    $view->assign('leftblocks', $this->leftBlocks);
    $view->assign('rightblocks', $this->rightBlocks);
    $view->assign('bottomblocks', $this->bottomBlocks);
    $view->assign('mainblockstop', $this->mainBlockstop);
    $view->assign('mainblocksbottom', $this->mainBlocksbottom);

    if (empty($this->leftBlocks) && empty($this->rightBlocks)) {
      $view->assign('applicationlayout', '1');
      return;
    }
    if (!empty($this->leftBlocks) && !empty($this->rightBlocks)) {
      $view->assign('applicationlayout', '3');
      return;
    }
    if (empty($this->leftBlocks)) {
      $view->assign('applicationlayout', '2r');
    } else {
      $view->assign('applicationlayout', '2l');
    }
  }

  public static function SingePage($file, $title = null) {
    $view->assign('applicationlayout', 1);
    $view->assign('mainblocks', array(new Amhsoft_View_Layout_Block_File($file, $title, 'page.tpl.html')));
  }

}

?>
