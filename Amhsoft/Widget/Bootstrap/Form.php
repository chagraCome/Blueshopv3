<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Construct Form
 * @author Amir Cherif
 * @author Thomas Häber
 */
class Amhsoft_Widget_Bootstrap_Form extends Amhsoft_Widget_Form {

    /** @var string id-name of form */
    private $Name;

    /** @var string */
    public $Table;

    /** @var boolean bindingState */
    private $bindingState = false;

    /** @var string class attribute value */
    private $Class = 'forms';

    /** @var integer cellpadding attribute value */
    private $Cellpadding = 0;

    /** @var integer cellspacing attribute value */
    private $Cellspacing = 6;

    /** @var string width attribute value */
    private $Width = '100%';

    /** @var string action target of form/request */
    private $Action;

    /** @var string form request method (POST, GET ...) */
    private $Method;

    /** @var DataBinding data binding for this control */
    public $DataBinding;

    /** @var string style attribute value */
    private $Dock = "form-group";

    /** @var string|array data source for this control */
    public $DataSource;

    /** @var boolean True, to use javascript validation */
    private $JavascriptValidation = false;
    private $multipart = false;
    
    public $Prefix = null;
    
    /** @var Amhsoft_Widget_Form_Render_Abstract $render */
    private $render;

    /**
     * Construct Form
     * @param string $name id-name of form
     * @param string $method form request method (POST, GET ...)
     */
    public function __construct($name, $method = null) {
        $this->Name = $name;
        $this->Method = $method;
        $this->components = new ArrayIterator();
    }

    public function getMultipart() {
        return $this->multipart;
    }

    public function setMultipart($multipart) {
        $this->multipart = $multipart;
    }

    
    public function setRender(Amhsoft_Widget_Form_Render_Abstract $render){
        $this->render = $render;
    }
    
     public function isFormValid($dataSource=null){
        if($dataSource == null) $dataSource = Amhsoft_Data_Source::Post();
        $this->DataSource = $dataSource;
        $this->Bind();
        return $this->Validate();
    }
    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {

        if($this->render){
            return $this->render->Render();
        }else{
            $this->render = new Amhsoft_Widget_Form_Render_Default_Render($this);
            return $this->render->Render();
        }
        
    }

    /**
     * Send Compoenents to template
     * @param template $t
     */
    public function ToTemplate(&$t) {
        $this->components->rewind();
        while ($this->components->valid()) {
            $t->assign($this->components->current()->Name, $this->components->current());
            $this->components->next();
        }
    }

    /**
     * Unbind all Componenets.
     */
    public function UnBind() {
        $this->bindingState = false;
    }

    /**
     * @deprecated since version 1.1
     */
    public function Refresh() {}

    /**
     * reset components in list
     */
    public function Reset() {

        foreach ($this->components as $component) {
            if ($component instanceof Panel) {
                $component->Reset();
            } else {
                $component->Value = null;
            }
        }
    }

    /**
     * Get the data binding of this control
     * @return DataBinding data binding of this control
     */
    public function getDataBindItem() {
        $data = array();
        $this->getData($data);
        if (is_object($this->DataBinding)) {
            foreach ($data as $key => $val) {
                if ($key && !preg_match("/\[/", $key)) {
                    $this->DataBinding->{$key} = ($val == '') ? null : $val;
                }
            }
            return $this->DataBinding;
        } else {
            return $data;
        }
    }

    /**
     * Get values
     * @return array
     */
    public function getValues() {
        $data = array();
        $this->getData($data);
        return $data;
    }

    /**
     * get id-name of panel
     * @return string id-name of panel
     */
    public function getName() {
        return $this->Name;
    }

    /**
     * set id-name of panel
     * @param <type> $Name id-name of panel
     */
    public function setName($Name) {
        $this->Name = $Name;
    }

    /**
     * get width value of panel
     * @return string get width attribute value of panel
     */
    public function getWidth() {
        return $this->Width;
    }

    /**
     * set width attribute value of panel
     * @param <type> $Width width attribute value of panel
     */
    public function setWidth($Width) {
        $this->Width = $Width;
    }

    /**
     * get class attribute value
     * @return string class attribute value
     */
    public function getClass() {
        return $this->Class;
    }

    /**
     * set class attribute value of panel
     * @param string $Class class attribute value
     */
    public function setClass($Class) {
        $this->Class = $Class;
    }

    /**
     * get cellpadding attribute value
     * @return integer cellpadding attribute value
     */
    public function getCellpadding() {
        return $this->Cellpadding;
    }

    /**
     * set cellpadding attribute value
     * @param integer $Cellpadding cellpadding attribute value
     */
    public function setCellpadding($Cellpadding) {
        $this->Cellpadding = $Cellpadding;
    }

    /**
     * get cellspacing attribute value
     * @return integer cellspacing attribute value
     */
    public function getCellspacing() {
        return $this->Cellspacing;
    }

    /**
     * set cellspacing attribute value
     * @param integer $Cellspacing cellspacing attribute value
     */
    public function setCellspacing($Cellspacing) {
        $this->Cellspacing = $Cellspacing;
    }

    /**
     * get style attribute value
     * @return string style attribute value
     */
    public function getDock() {
        return $this->Dock;
    }

    /**
     * set style attribute value
     * @param string $Dock style attribute value
     */
    public function setDock($Dock) {
        $this->Dock = $Dock;
    }

    /**
     * get style attribute value
     * @return string style attribute value
     */
    public function getAction() {
        return $this->Action;
    }

    /**
     * set action target of form/request
     * @param string $Action action target of form/request
     */
    public function setAction($Action) {
        $this->Action = $Action;
    }

    /**
     * get form request method (POST, GET ...)
     * @return string form request method (POST, GET ...)
     */
    public function getMethod() {
        return $this->Method;
    }
    
    
    public function getLabel() {
      
    }
    /**
     * set form request method (POST, GET ...)
     * @param string $Method form request method (POST, GET ...)
     */
    public function setMethod($Method) {
        $this->Method = $Method;
    }

    /**
     * Get true, if Javascript validation is used, false otherwise.
     * @return boolean True, if Javascript validation is used, false otherwise.
     */
    public function isJavascriptValidation() {
        return $this->JavascriptValidation;
    }

    /**
     * Set true, if Javascript validation is used, false otherwise.
     * @param boolean True, if Javascript validation is used, false otherwise.
     */
    public function setJavascriptValidation($JavascriptValidation) {
        $this->JavascriptValidation = $JavascriptValidation;
    }

    public function __get($element) {
        foreach ($this->components as $component) {
            if ($component->Name == $element) {
                return $component;
            }
        }
    }

}
