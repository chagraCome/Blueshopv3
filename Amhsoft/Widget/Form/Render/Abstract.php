<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Abstract.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
abstract class Amhsoft_Widget_Form_Render_Abstract{
    
    /** @var Amhsoft_Widget_Form $widget */
    protected $widget;
    
    /**
     * Construct
     * @param Amhsoft_Widget_Form $widget
     */
    public function __construct(Amhsoft_Widget_Form $widget){
        $this->widget = $widget;
    }
    
    /**
     * Gets the Widget.
     * @return Amhsoft_Widget_Form widget
     */
    public function getWidget(){
        return $this->widget;
    }
    
    /**
     * Render widget as Html.
     */
    abstract function Render();
}
?>
