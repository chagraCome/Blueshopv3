<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Exception
 *
 * @author administrator
 */
class Amhsoft_Exception extends Exception {
  
}

class Amhsoft_Item_Not_Found_Exception extends Amhsoft_Exception {

  public function __construct($message = null, $code = 0, Exception $previous = null) {
    Amhsoft_Navigator::error_404();
    parent::__construct($message, $code, $previous);
  }

}

class Amhsoft_NoEnougthQuantity_Exception extends Amhsoft_Exception {
  
}

class Amhsoft_Permission_Denied_Exception extends Amhsoft_Exception {

  public function __construct($message = null, $code = 0, Exception $previous = null) {
    parent::__construct($message, $code, $previous);
    Amhsoft_Navigator::go('?module=default&page=nopermission');
  }

}

class Amhsoft_Illigal_Controller_Exception extends Amhsoft_Exception {
  
}

class Amhsoft_File_Not_Found_Exception extends Amhsoft_Exception {
  
}

class Product_NoEnougthQuantity_Exception extends Amhsoft_Exception {
  
}

class Product_Not_Available_Exception extends Amhsoft_Exception {
  
}

?>
