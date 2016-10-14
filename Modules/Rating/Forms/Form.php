<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Form.php 446 2016-02-19 13:41:32Z imen.amhsoft $
 * $Rev: 446 $
 * @package    Rating
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-19 14:41:32 +0100 (ven., 19 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Rating_Form extends Amhsoft_Widget_Form {

    public $rate;
    public $name;
    public $comment;
    public $entityid;
    public $entityname;
    public $submitButton;
    public $captcha;

    /**
     * Form Construct
     * @param type $name
     * @param type $method
     */
    public function __construct($name, $method = null) {
        parent::__construct($name, $method);
        $this->initializeComponents();
    }

    /**
     * Initialize Form
     */
    public function initializeComponents() {
        $this->entityid = new Amhsoft_Hidden_Control('entity_id');
        $this->entityname = new Amhsoft_Hidden_Control('entity_class');
        $this->addComponent($this->entityid);
        $this->addComponent($this->entityname);
        $this->rate = new Amhsoft_Rating_Control('rate', _t('Rate Quality'));
        $this->rate->DataBinding = new Amhsoft_Data_Binding('rate');
        $this->addComponent($this->rate);
        $this->name = new Amhsoft_Input_Control('name', _t('Name'));
        $this->name->DataBinding = new Amhsoft_Data_Binding('name');
        $this->name->Required = true;
        $this->name->setWidth('80%');
        $this->addComponent($this->name);
        $this->comment = new Amhsoft_TextArea_Control('comment', _t('Comment'));
        $this->comment->DataBinding = new Amhsoft_Data_Binding('comment');
        $this->comment->Required = true;
        $this->comment->setWidth('80%');
        $this->addComponent($this->comment);
        $this->captcha = new Amhsoft_CaptchaControl_Control("cap", _t("Security Code"));
        $this->captcha->Required = true;
        $this->addComponent($this->captcha);
        $this->submitButton = new Amhsoft_Button_Submit_Control("submit", _t("Rate Now"));
        $this->submitButton->Class = "Button rating_btn";
        $this->addComponent($this->submitButton);
    }

    /**
     * Send Form
     * @return type
     */
    public function isSend() {
        return isset($_POST["submit"]);
    }

}

?>