<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Newsletter.php 345 2016-02-05 16:02:36Z imen.amhsoft $
 * $Rev: 345 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-05 17:02:36 +0100 (ven., 05 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Crm_Frontend_Intern_Shop_Newsletter_Controller extends Amhsoft_System_Web_Controller {

    /** @var Newsletter_Email_Model model */
    protected $newsletterEmailsModel;

    /** @var Newsletter_Email_Model_Adapter model adapter */
    protected $newsletterEmailsModelAdapter;

    /** @var boolean True, if is valid newsletter email */
    protected $isvalid_newsletter_email = 0;

    /** @var string user email value */
    protected $email = false;

    /**
     * Initialize event
     */
    public function __initialize() {
        $this->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-home', 'label' => _t('My Account')))->setBreadCrumb(array('link' => 'index.php?module=crm&page=intern-shop-newsletter', 'label' => _t('Newsletter Subscription')));

        if ($this->getRequest()->post('check')) {
            $this->email = $this->getRequest()->post('newsletter_email');
            if (!isset($this->email)) {
                $this->getView()->assign('error', _t('Please Enter a valid email'));
                return false;
            }
            $validator = new Amhsoft_Email_Validator($this->email);
            if ($validator->isValid()) {
                $this->newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
                $this->newsletterEmailsModelAdapter->where('email = ?', $this->email, PDO::PARAM_STR);
                if ($this->newsletterEmailsModelAdapter->getCount() > 0) {
                    $this->getView()->assign('registred', _t('Following email is already registered in the newsletter system.'));
                    return false;
                }
            } else {
                $this->getView()->assign('error', _t('Please Enter a valid email'));
                return false;
            }
            $n_e_groupAdapter = new Newsletter_Email_Group_Model_Adapter();
            $n_e_groupAdapter->where('id = 4');
            $n_e_group = $n_e_groupAdapter->fetch()->fetch();
            if ($n_e_group == null) {
                $n_e_group = new Newsletter_Email_Group_Model();
                $n_e_group->name = 'public_group';
                $n_e_group->desc = 'Public Group';
                $n_e_groupAdapter->insert($n_e_group);
            }
            $this->newsletterEmailsModelAdapter = new Newsletter_Email_Model_Adapter();
            $this->newsletterEmailsModel = new Newsletter_Email_Model();
            $this->newsletterEmailsModel->email = $this->email;
            $this->newsletterEmailsModel->state = true;
            $this->newsletterEmailsModel->setGroup($n_e_group);
            $e = $this->newsletterEmailsModelAdapter->save($this->newsletterEmailsModel);
            if ($e > 0) {
                $this->getView()->assign('success', _t('The following E-Mail-Address has been successfully added to our newsletter'));
            } else {
                $this->getView()->assign('error', _t('Cannot Registred Email'));
                return false;
            }
        }
    }

    /**
     * Default event
     */
    public function __default() {
        
    }

    /**
     * Finalize event
     */
    public function __finalize() {
        $this->getView()->assign('newsletter_email', $this->email);
        $this->show();
    }

}

?>
