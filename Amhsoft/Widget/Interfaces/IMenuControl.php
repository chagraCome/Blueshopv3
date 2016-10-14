<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: IMenuControl.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Amhsoft_IMenuControl_Interface Interface
 */
interface Amhsoft_IMenuControl_Interface {

  /**
   * add item to list of MenuItem
   * @param MenuItem $item new item to add
   * @return MenuItem instance of MenuItem
   */
  public function AddItem(MenuItem $item);

  /**
   * get list of MenuItem
   * @return array List of MenuItem
   */
  public function GetItems();

  /**
   * check if given MEnuItem already exists in item list
   * @param MenuItem $item MenuItem to check for existence in item list
   * @return boolean true if given MEnuItem already exists in item list
   */
  public function Contains(MenuItem $item);

  /**
   * remove given item from item list
   * @param MenuItem $item item to remove from item list
   */
  public function RemoveItem(MenuItem $item);

  /**
   * remove all child items
   */
  public function RemoveAllItems();

  /**
   * Draw/Render components
   * @return string output like HTML
   */
  public function Render();

}
