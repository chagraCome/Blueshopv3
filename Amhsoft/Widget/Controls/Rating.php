<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Rating.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * label component
 * @author Amir Cherif
 */
class Amhsoft_Rating_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    public $StarsCount = 5;

    /**
     * Construct component label and bind data to label
     * @param string $label label text for component
     * @param Amhsoft_DataBinding_Component $dataBinding dataBinding for this label
     */
    public function __construct($name, $label = null, $value = null, $size = null, Amhsoft_Data_Binding $dataBinding = null) {
        parent::__construct($name, $value);
        $this->Label = $label;
        $this->Size = $size;
        $this->Id = $this->Name;
        $this->DataBinding = $dataBinding;
    }

    public function setStarsCount($count) {
        $this->StarsCount = $count;
    }

    /**
     * 
     * <script src='Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.pack.js' type="text/javascript" language="javascript"></script>
     * <link href='Amhsoft/Ressources/Javascripts/JQuery/rating/jquery.rating.css' type="text/css" rel="stylesheet"/>
     * are needed
     * @return string
     */
    public function Draw() {
        $diabled = null;
        if ($this->Disabled == true) {
            $diabled = 'disabled="disabled"';
        }

        $str = '<div style="width: 100px">';
        for ($i = 1; $i <= $this->StarsCount; $i++) {
            if (ceil($this->Value) == $i) {
                $str .= '<input name="' . $this->Name . '" type="radio" class="star" '.$diabled.' value="' . $i . '"  checked="checked" />';
            } else {
                $str .= '<input name="' . $this->Name . '" type="radio" class="star" '.$diabled.' value="' . $i . '" />' . PHP_EOL;
            }
        }

        if ($this->overrideRender != null) {
            return $this->overrideRender->dispatchEvent($this);
        }
        $class = null;
        if ($this->Class) {
            $class = " class='$this->Class' ";
        }
        return $str.'</div>';
    }

}
