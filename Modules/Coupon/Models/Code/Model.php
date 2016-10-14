<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Model.php 362 2016-02-09 14:51:35Z imen.amhsoft $
 * $Rev: 362 $
 * @package    Coupon
 * @copyright  2005-2014 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 
 * $LastChangedDate: 2016-02-09 15:51:35 +0100 (mar., 09 févr. 2016) $
 * $Author: imen.amhsoft $
 */
class Coupon_Code_Model implements Amhsoft_Data_Db_Model_Interface {

  public $id;
  public $coupon_id;
  public $code;
  public $insert_date_time;
  public $expire_date;
  public $delivery_date_time;
  public $state;
  public $state_id;

  /** @var Coupon_Model $coupon */
  public $coupon;

  const SETTINGS = 'coupon_settings';
  const BLOCK_NUMBER = 'block_number';
  const CARACTER_PER_BLOCK = 'caracter_per_block';
  const IMAGE_TEMPLATE_PATH = 'image_template_path';
  const CHARACHTER_OFFSET = 'code_caracter_offset';
  const BLOCK_SEPARATOR = 'block_separator';
  const COUPON_TEMPLATE = 'coupon_template';

  /**
   * Gets id.
   * @return 
   * */
  public function getId() {
    return $this->id;
  }

  /**
   * Set id.
   * @param  id 
   * @return Coupon_Code_Model
   * */
  public function setId($id) {
    $this->id = $id;
    return $this;
  }

  /**
   * Gets coupon.
   * @return 
   * */
  public function getCoupon() {
    return $this->coupon;
  }

  /**
   * Set coupon.
   * @param  coupon 
   * @return Coupon_Code_Model
   * */
  public function setCoupon($coupon) {
    $this->coupon = $coupon;
    return $this;
  }

  /**
   * Gets code.
   * @return 
   * */
  public function getCode() {
    return $this->code;
  }

  /**
   * Set code.
   * @param  code 
   * @return Coupon_Code_Model
   * */
  public function setCode($code) {
    $this->code = $code;
    return $this;
  }

  /**
   * Gets insert_date_time.
   * @return 
   * */
  public function getInsert_date_time() {
    return $this->insert_date_time;
  }

  /**
   * Set insert_date_time.
   * @param  insert_date_time 
   * @return Coupon_Code_Model
   * */
  public function setInsert_date_time($insert_date_time) {
    $this->insert_date_time = $insert_date_time;
    return $this;
  }

  /**
   * Gets expire_date.
   * @return 
   * */
  public function getExpire_date() {
    return $this->expire_date;
  }

  /**
   * Set expire_date.
   * @param  expire_date 
   * @return Coupon_Code_Model
   * */
  public function setExpire_date($expire_date) {
    $this->expire_date = $expire_date;
    return $this;
  }

  /**
   * Gets delivery_date_time.
   * @return 
   * */
  public function getDelivery_date_time() {
    return $this->delivery_date_time;
  }

  /**
   * Set delivery_date_time.
   * @param  delivery_date_time 
   * @return Coupon_Code_Model
   * */
  public function setDelivery_date_time($delivery_date_time) {
    $this->delivery_date_time = $delivery_date_time;
    return $this;
  }

  public function getCoupon_id() {
    return $this->coupon_id;
  }

  public function setCoupon_id($coupon_id) {
    $this->coupon_id = $coupon_id;
    return $this;
  }

  public function getState_id() {
    return $this->state_id;
  }

  public function setState_id($state_id) {
    $this->state_id = $state_id;
    return $this;
  }

  /**
   * Gets Coupon_Code_State_Model state.
   * @return 
   * */
  public function getState() {
    return $this->state;
  }

  public function getSummary() {
    $amount = new Amhsoft_Currency_Label_Control('coupon_amount');
    $amount->setValue($this->coupon->getAmount());

    $minamount = new Amhsoft_Currency_Label_Control('coupon_amount');
    $minamount->setValue($this->coupon->getMinumShoppingCartAmount());

    $discount_string = $this->coupon->getAmount() > 0 ? $amount->Render() : $this->coupon->getPercent() . ' %';
    $type_string = $this->coupon->getType()->getId() == Coupon_Type_Model::FREE_SHIPPING ? _t('Free Shipping') : $discount_string;
    return $this->coupon->getName() . '(' . $type_string . '): ' . $this->code . '<br />' . _t('Min Shopping Cart Amount') . ': ' . $minamount->Render();
  }

  /**
   * Set state.
   * @param Coupon_Code_State_Model  $state 
   * @return Coupon_Code_Model
   * */
  public function setState($state) {
    $this->state = $state;
    return $this;
  }

  public static function generateCode() {
    $settings = new Amhsoft_Config_Table_Adapter(self::SETTINGS);
    $blocCount = $settings->getValue(self::BLOCK_NUMBER, 4);
    $blocLength = $settings->getValue(self::CARACTER_PER_BLOCK, 4);
    $blockSep = $settings->getValue(self::BLOCK_SEPARATOR, '-');
    $chars = $settings->getValue(self::CHARACHTER_OFFSET, 'QWERTZUIOPASDFGHJKLYXCVBNM123456789');
    $blocks = array();
    for ($j = 0; $j < $blocCount; $j++) {
      $password = "";
      $i = 0;
      while ($i < $blocLength) {
	$password .= $chars{mt_rand(0, strlen($chars) - 1)};
	$i++;
      }
      $blocks[] = $password;
    }
    return implode($blockSep, $blocks);
  }

  public function generateImage() {
    $NewImage = imagecreatefromjpeg("media/coupons/coupon_template.jpg"); //image create by existing image and as back ground
    $barCode = new Amhsoft_Code_Bar($this->getCode());
    $bar = $barCode->asRessource();
    imagecopymerge($NewImage, $bar, 165, 230, 0, 0, 300, 42, 75);
    ob_start();
    imagejpeg($NewImage); //Output image to browser
    $image_data = ob_get_contents();
    ob_end_clean();
    $image_data_base64 = base64_encode($image_data);
    @file_put_contents("media/coupons/" . $this->getId() . ".jpg", base64_decode($image_data_base64));
    imagedestroy($bar);
    imagedestroy($NewImage);
    $link = 'media/coupons/' . $this->getId() . '.jpg';
    return $link;
  }

  public static function generateCodeForMarketing($idCoupon) {
    $arr=array();
    if ($idCoupon > 0) {
      $ModelAdapter = new Coupon_Model_Adapter();
      $Model = $ModelAdapter->fetchById($idCoupon);
      if (!$Model instanceof Coupon_Model) {
	return 0;
      }
    } else {
      return 0;
    }
    $thisDate = new DateTime(date('Y-m-d'));
    $thisDate->add(new DateInterval('P30D'));
    $expirationDate = $thisDate->format('Y-m-d');
    $codemodel = new Coupon_Code_Model();

    $codemodel->setCode(Coupon_Code_Model::generateCode());
    $codemodel->setExpire_date($expirationDate);
    $codemodel->setInsert_date_time(Amhsoft_Locale::UCTDateTime());
    $codemodel->state_id = 1;
    $codemodel->coupon_id = $Model->id;
    $codeAdapter = new Coupon_Code_Model_Adapter();
    $codeAdapter->save($codemodel);
    $linkAttachment = $codemodel->generateImage();
    array_push($arr,$linkAttachment , $codemodel);
    return $arr;
  }

}

?>