<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: module.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Revision: 112 $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    newsletter
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    19.11.2010 - 10:42:40
 */

/**
 * Module newsletter
 */
class newsletter implements IModule, IModule_Frontend {

  /**
   * Entry Point.
   */
  public function initialize() {
    
  }

  public function addEmailToGroup($email, $group = 'Contacts Group') {
    Application::import('Amhsoft.Libs.InputValidation');
    Application::import('modules.newsletter.models.NewsletterEmailsModel');
    Application::import('modules.newsletter.models.NewsletterEmailGroupsModel');

    $this->newsletterEmailsModelAdapter = new NewsletterEmailsModelAdapter();
    if ($this->newsletterEmailsModelAdapter->where('email = ?', $email, PDO::PARAM_STR)->fetch()) {
      return;
    }

    $n_e_groupAdapter = new NewsletterEmailGroupsModelAdapter();
    $n_e_groupAdapter->where('name = ?', $group, PDO::PARAM_STR);

    $n_e_group = $n_e_groupAdapter->fetch()->fetch();
    if ($n_e_group == null) {
      $n_e_group = new NewsletterEmailGroupsModel();
      $n_e_group->name = $group;
      $n_e_group->desc = $group;
      $n_e_groupAdapter->insert($n_e_group);
    }

    $this->isvalid_newsletter_email = true;
    $this->newsletterEmailsModelAdapter = new NewsletterEmailsModelAdapter();
    $this->newsletterEmailsModel = new NewsletterEmailsModel();
    $this->newsletterEmailsModel->email = $email;
    $this->newsletterEmailsModel->state = true;
    $this->newsletterEmailsModel->setGroup($n_e_group);
    $this->newsletterEmailsModelAdapter->save($this->newsletterEmailsModel);
  }

}
