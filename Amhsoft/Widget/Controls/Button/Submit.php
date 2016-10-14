<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Submit.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * submit button component
 * @author Amir Cherif
 */
class Amhsoft_Button_Submit_Control extends Amhsoft_Input_Control {

    /** @var Event event of this component */
    public $onClick;
    public $AsButton = false;

    /**
     * Construct this component submit botton
     * @param string $name id-name of component submit button
     * @param string $value value text of submit button (default: 'Send')
     */
    public function __construct($name, $value = 'Send') {
        parent::__construct($name, null, $value);
        $this->Type = 'submit';
        $this->Class = 'Button';
        $this->Value = $value;
        $this->onClick = new Amhsoft_Widget_Event();
    }
    
    

    public function Render() {
        return '<button name="' . $this->Name . '" class="' . $this->Class . '" type="submit">' . $this->Value . '</button>';
    }

    /**
     * if id-name is valid, dispatch event for submit button on click
     */
    public function invoke() {
        if (isset($_POST[$this->Name]) || isset($_GET[$this->Name])) {
            $this->onClick->dispatchEvent($this);
        }
    }

    /**
     * get dispatched event for this component
     * @return Event dispatched event for this component
     */
    public function getOnClick() {
        return $this->onClick;
    }

    /**
     * set/dispatch event for this component
     * @param Event $onClick event for this component
     */
    public function setOnClick(Event $onClick) {
        $this->onClick = $onClick;
    }

}
