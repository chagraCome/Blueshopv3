<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ImageControl.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * image control component
 * @author Amir Cherif
 */
class Amhsoft_ImageControl_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    /** @var string source URI of image */
    private $Src;

    /** @var string alternative text of image */
    private $Alt;
    public $deleteUrl = null;
    private $Height;

    /** @var Amhsoft_FileInput_Control $uploadControl */
    public $uploadControl;

    public function getHeight() {
        return $this->Height;
    }

    public function setHeight($Height) {
        $this->Height = $Height;
    }

    public function getDeleteUrl() {
        return $this->deleteUrl;
    }

    public function setDeleteUrl($deleteUrl) {
        $this->deleteUrl = $deleteUrl;
    }

    /**
     * 
     * @return Amhsoft_FileInput_Control $uploadControl 
     */
    public function getUploadControl() {
        return $this->uploadControl;
    }

    public function setUploadControl(Amhsoft_FileInput_Control $uploadControl) {
        $this->uploadControl = $uploadControl;
    }

    /**
     * Construct component image with name and source URI
     * @param string $name id-name of component
     * @param string $src source URI of image
     * @param string $alt alternative text of image
     */
    public function __construct($name, $src = null, $alt = '') {
        parent::__construct($name);
        $this->Src = $src;
    }

    /**
     * get output HTML / string represantation of Control
     * @return string output HTML / string represantation of Control
     */
    public function Draw() {

        if ($this->Src == null) {
            $this->Src = $this->Value;
        }
        if ((!@file_exists($this->Src)) && (preg_match("%^((https?://)|(www\.))([a-z0-9-].?)+(:[0-9]+)?(/.*)?$%i",$this->Src) === 0)) {
            $this->Src = null;
        }


        if ($this->Src == null && $this->uploadControl instanceof Amhsoft_FileInput_Control) {
            return $this->uploadControl->Render();
        }


        $width = ($this->Width) ? 'width="' . $this->Width . '"' : null;
        $height = ($this->Height) ? 'height="' . $this->Height . '"' : null;
        $html = '<div style="padding: 2px; background: white; width:' . $this->Width . 'px">';
        $html .= '<img src="' . $this->Src . '?' . time() . '" ' . $width . ' ' . $height . '  alt="' . $this->Alt . '" />';
        if ($this->deleteUrl) {
            if ($this->deleteUrl instanceof Amhsoft_Link_Control) {
                $this->deleteUrl = $this->deleteUrl->Href;
            }
            $html .= '<div style="text-align:center; padding-top:10px"><a href="' . $this->deleteUrl . '" class="delete">' . _t('delete') . '</a></div>';
        }
        $html .= '</div>';

        return $html;
    }

    /**
     * get source URI of image
     * @return string source URI of image
     */
    public function getSrc() {
        return $this->Src;
    }

    /**
     * set source URI of image
     * @param string $Src source URI of image
     */
    public function setSrc($Src) {
        $this->Src = $Src;
    }

    /**
     * get alternative text of image
     * @return string alternative text of image
     */
    public function getAlt() {
        return $this->Alt;
    }

    /**
     * set alternative text of image
     * @param string $Alt alternative text of image
     */
    public function setAlt($Alt) {
        $this->Alt = $Alt;
    }

}
