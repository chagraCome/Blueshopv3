<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: History.php 112 2016-01-26 13:50:57Z a.cherif $
 * $Rev: 112 $
 * @package Crm
 * @copyright  200:id-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $LastChangedDate: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $
 * $Author: a.cherif $
 */
class Crm_Backend_Contact_History_Controller extends Amhsoft_System_Web_Controller {

  protected $id;
  protected $email;
  /**
   * Initialize 
   */
  public function __initialize() {
    $this->id = $this->getRequest()->getId();
    if($this->id <= 0){
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $contactAdapter = new Crm_Contact_Model_Adapter();
    $contact = $contactAdapter->fetchById($this->id);
    if(!$contact instanceof Crm_Contact_Model){
      throw new Amhsoft_Item_Not_Found_Exception();
    }
    $this->email = $contact->getEmail();
  }

  /**
   * Default Event
   */
  public function __default() {
    $this->getView()->setMessage(_t('Contact History'), View_Message_Type::INFO);
  }

  /**
   * Final Event
   */
  public function __finalize() {
    $sql = "SELECT 'Contact' as action,  CONCAT_WS(' ', c.firstname,  c.lastname) as `name`, c.create_date_time as insertat FROM contact c WHERE c.id = :id
UNION
SELECT 'Account' as action,  account.`name`, account.register_date_time as insertat FROM account LEFT JOIN contact ON account.id = contact.account_id WHERE contact.id = :id
UNION
SELECT 'Opportunity' as action, opportunitiy.`name`, opportunitiy.start_date as insertat from opportunitiy WHERE contact_id = :id
UNION 
SELECT 'Quotation' as action, quotation.`name`, quotation.insertat from quotation WHERE contact_id = :id
UNION
SELECT 'Task' as action, task.stubject, task.insertat FROM task WHERE task.entity = 'Crm_Contact_Model' and entity_id = :id
UNION
SELECT 'Comment' as action, comment_item.subject, comment_item.insertat FROM comment_item WHERE entity = 'Crm_Contact_Model' AND entity_id = :id
UNION
SELECT 'Email Received' as action, we.subject, we.createat as insertat FROM webmail_email we WHERE we.from_email = :email
UNION 
SELECT 'Email Send' as action, we.subject, we.sendat as insertat FROM webmail_email we WHERE we.to_emails = :email
ORDER By insertat ASC
";
    $database = Amhsoft_Database::getInstance()->prepare($sql);
    $database->bindValue(':id', $this->id);
    $database->bindValue(':email', $this->email, PDO::PARAM_STR);
    $database->execute();
    $result = $database->fetchAll(PDO::FETCH_ASSOC);
    
    $grid = new Amhsoft_Widget_DataGridView(array('action' => 'action', 'name' => 'name', 'insertat' => 'inserat'));
    $grid->DataSource = new Amhsoft_Data_Set($result);
    $this->getView()->assign('widget', $grid);
    $this->show();
  }

}
