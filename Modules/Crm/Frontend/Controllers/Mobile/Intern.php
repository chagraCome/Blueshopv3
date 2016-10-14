<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Intern.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package    Crm
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
Application::import('Amhsoft.Core.Controls.JQMControl');

class Crm_Frontend_Mobile_Intern_Controller extends Amhsoft_System_Web_Controller {

  /** @var JQMDocument $jqueryMobileDocument */
  protected $jqueryMobileDocument;

  /**
   * Initialize event
   */
  public function __initialize() {
    $currentCustomer = Crm_Account_Model::getInstance();
    if ($currentCustomer <= 0)
      navigator::go('index.php?module=crm&page=login-mobile', true);
    $this->jqueryMobileDocument = new JQMDocument();
  }

  /**
   * Default event
   */
  public function __default() {
    $jqueryMobilePage = new JQMPage();
    $jqueryMobileHeader = new JQMHeader();
    $jqueryMobileHeader->addAttribute("style", "background: url('images/motors_souq_logo_mobile_slide.png'); margin-top:0; padding-top:0; height:110px; box-shadow: 0 0 8px 2px rgba(0, 0, 0, 0.1); border-bottom:1px solid silver");
    $jqueryMobileTitle = new JQMH1("<img src='images/motors_souq_logo_mobile.png' height='110px' align='left' />");
    $jqueryMobileTitle->addAttribute("style", "margin:0");
    $jqueryMobileHeader->addComponent($jqueryMobileTitle);
    $jqueryMobilePage->addComponent($jqueryMobileHeader);
    //content
    $jqMobileContent = new JQMContent();
    $jqMobileContent->addComponent($this->getContainer());
    $jqueryMobilePage->addComponent($jqMobileContent);
    //footer
    $jqueryMobileFooter = new JQMFooter();
    $jqueryMobileFooter->addComponent(new JQMHtml("&copy; 2012 motorssouq bahrain. All rights protected<br />Powered & Managed by AMHSOFT"));
    $jqueryMobileFooter->setFixedPosition();
    $jqueryMobilePage->addComponent($jqueryMobileFooter);
    $this->jqueryMobileDocument->addComponent($jqueryMobilePage);
  }

  protected function getContainer() {
    $list = new JQMBasicList();
    $list->addAttribute("data-divider-theme", "d");
    $list->addAttribute("data-inset", "false");
    $liHome = new JQMLI("Welcome");
    $liHome->addAttribute("data-role", "list-divider")
	    ->addAttribute("role", "heading");
    $list->addComponent($liHome);
    $list->addComponent(new JQMLI(new JQMLink(_t("Search Car"), "index.php?module=vehicle&page=search-mobile")));
    $list->addComponent(new JQMLI(new JQMLink(_t("Contact us"), "index.php?module=cms&page=contact-mobile")));
    $list->addComponent(new JQMLI(new JQMLink(_t("About us"), "index.php?module=cms&page=impress-mobile")));
    $liAccount = new JQMLI("Account");
    $liAccount->addAttribute("data-role", "list-divider")
	    ->addAttribute("role", "heading");
    $list->addComponent($liAccount);
    $liMyCars = new JQMLI(new JQMLink(_t("Insert Car"), "index.php?module=vehicle&page=add-mobile"));
    $list->addComponent($liMyCars);
    $list->addComponent(new JQMLI(new JQMLink(_t("My Cars"), "index.php?module=vehicle&page=list-mobile&event=mine")));
    $list->addComponent(new JQMLI(new JQMLink(_t("Logout"), "index.php?module=crm&page=logout-mobile")));
    return $list;
  }

  /**
   * Finalize event
   */
  public function __finalize() {
    echo $this->jqueryMobileDocument->Render();
  }

}

?>