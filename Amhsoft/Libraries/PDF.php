<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: PDF.php 469 2016-03-03 16:42:24Z montassar.amhsoft $
 * $Rev: 469 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-03-03 17:42:24 +0100 (jeu., 03 mars 2016) $
 * $LastChangedDate: 2016-03-03 17:42:24 +0100 (jeu., 03 mars 2016) $
 * $Author: montassar.amhsoft $
 * *********************************************************************************************** */

/**
 * Description of pdf
 *
 * @author cherif
 */

class Amhsoft_PDF  {

    public $htmlHeader;
    public $htmlFooter;

    public function __construct($orientation = 'P', $unit = 'mm', $format = 'A4', $unicode = true, $encoding = 'UTF-8', $diskcache = false, $pdfa = false) {
        parent::__construct($orientation, $unit, $format, $unicode, $encoding, $diskcache, $pdfa);
        $fontname = $this->addTTFfont(dirname(__FILE__) . '/tahoma.ttf', 'TrueTypeUnicode', '', 96);
        $this->SetFont('tahoma', '', 8);
    }

    //Page header
    public function Header() {
        $this->SetFont('tahoma', '', 8);
        $this->writeHTMLCell(0, 0, 0, 0, $this->htmlHeader, $border = 0, $ln = 1, $fill = 0, $reseth = true, $align = 'top', $autopadding = true);
    }

    public function setHtmlHeader($htmlHeader) {
        $this->htmlHeader = $htmlHeader;
    }

    public function setHtmlFooter($htmlFooter) {
        $this->htmlFooter = $htmlFooter;
    }

    // Page footer
    public function Footer() {
        $this->SetFont('tahoma', '', 8);
        $this->SetY(-35);
        $this->WriteHtmlCell(0, 0, '', '', $this->htmlFooter, 0, 1, 0, true, 'C', $autopadding = true);
    }

}

?>