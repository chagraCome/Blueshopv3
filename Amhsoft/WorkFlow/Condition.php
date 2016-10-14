<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Amhsoft_WorkFlow_Condition extends Amhsoft_WorkFlow_Condition_Abstract {

  private $left;
  private $right;
  private $operator;

  function __construct($left, $right, $operator) {
    $this->left = $left;
    $this->right = $right;
    $this->operator = $operator;
  }

  public function getLeft() {
    return $this->left;
  }

  public function setLeft($left, $args = null) {
    if ($args == null) {
      $this->left = $left;
      return $this;
    }

    if (is_object($args)) {
      $this->left = $this->getFromObject($left, $args);
      return $this;
    }

    if (is_array($args)) {

      foreach ($args as $o) {
        try {
          $result = $this->getFromObject($left, $o);
          return $this->left = $result;
        } catch (Amhsoft_Item_Not_Found_Exception $e) {
          continue;
        }
      }
      return $this;
    }
  }

  //left: Product_Model::category::name

  private function getFromObject($left, $object) {

    if (!is_object($object)) {
      throw new Exception($object . ' is not object');
    }
    $class = get_class($object);
    $trim_str = $class . '::';
    $left = str_replace($trim_str, '', $left);

    if ($left == '') {
      throw new Exception($left . ' is illigal');
    }
    if (strpos($left, '::')) {
      $_lefts = explode('::', $left);
      if (count($_lefts) == 2) {
        if (isset($object->{$_lefts[0]}->{$_lefts[1]})) {
          return $object->{$_lefts[0]}->{$_lefts[1]};
        } else {
          throw new Amhsoft_Item_Not_Found_Exception();
        }
      } else {
        return null;
      }
    }
    //if (!isset($object->$left)) {
    //    throw new Amhsoft_Item_Not_Found_Exception();
    //}
    return $object->$left;
  }

  public function getRight() {
    return $this->right;
  }

  public function setRight($right) {
    $this->right = $right;
  }

  public function getOperator() {
    return $this->operator;
  }

  public function setOperator($operator) {
    $this->operator = $operator;
  }

  public function valid($params = null) {

    $this->setLeft($this->left, $params);
    if ($this->operator == 'eq') {
      if (is_numeric($this->right)) {
        return Amhsoft_WorkFlow_Condition_Operation_Number::equals($this->left, $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::equals($this->left, $this->right);
      }
    }

    if ($this->operator == 'noteq') {
      if (is_numeric($this->right)) {
        return Amhsoft_WorkFlow_Condition_Operation_Number::notEquals($this->left, (double) $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::notEquals($this->left, (string) $this->right);
      }
    }

    if ($this->operator == 'startWith') {
      return Amhsoft_WorkFlow_Condition_Operation_String::startWith((string) $this->left, (string) $this->right);
    }

    if ($this->operator == 'endWith') {
      return Amhsoft_WorkFlow_Condition_Operation_String::endWith((string) $this->left, (string) $this->right);
    }

    if ($this->operator == 'contains') {
      return Amhsoft_WorkFlow_Condition_Operation_String::contains((string) $this->left, (string) $this->right);
    }

    if ($this->operator == 'notContains') {
      return !Amhsoft_WorkFlow_Condition_Operation_String::contains((string) $this->left, (string) $this->right);
    }

    if ($this->operator == 'greaterThan') {
      if (is_numeric($this->right)) {
        return Amhsoft_WorkFlow_Condition_Operation_Number::greaterThan((double) $this->left, (double) $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::greaterThan((string) $this->left, (string) $this->right);
      }
    }


    if ($this->operator == 'lessThan') {
      if (is_numeric($this->right)) {
        return Amhsoft_WorkFlow_Condition_Operation_Number::lessThan((double) $this->left, (double) $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::lessThan((string) $this->left, (string) $this->right);
      }
    }


    if ($this->operator == 'greaterEqualThan') {
      if (is_numeric($this->right)) {
        return
                Amhsoft_WorkFlow_Condition_Operation_Number::greaterThan((double) $this->left, (double) $this->right) ||
                Amhsoft_WorkFlow_Condition_Operation_Number::equals((double) $this->left, (double) $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::greaterThan((string) $this->left, (string) $this->right) ||
                Amhsoft_WorkFlow_Condition_Operation_String::equals((string) $this->left, (string) $this->right);
      }
    }


    if ($this->operator == 'lessEqualThan') {
      if (is_numeric($this->right)) {
        return
                Amhsoft_WorkFlow_Condition_Operation_Number::lessThan((double) $this->left, (double) $this->right) ||
                Amhsoft_WorkFlow_Condition_Operation_Number::equals((double) $this->left, (double) $this->right);
      } else {
        return Amhsoft_WorkFlow_Condition_Operation_String::lessThan((string) $this->left, (string) $this->right) ||
                Amhsoft_WorkFlow_Condition_Operation_String::equals((string) $this->left, (string) $this->right);
      }
    }


    if ($this->operator == 'greaterThan') {
      return Amhsoft_WorkFlow_Condition_Operation_String::in((string) $this->left, (string) $this->right, ',');
    }




//        if ($this->operator == 'strartWith') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//        if ($this->operator == 'notStrartWith') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'endWith') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//        if ($this->operator == 'notEndWith') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'contains') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'notContains') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'greatherThan') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'lessThan') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'greatherEqualsThan') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//        if ($this->operator == 'lessEuqlasThan') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
//
//
//        if ($this->operator == 'in') {
//            return Amhsoft_WorkFlow_Condition_String_Equals::Validate($this->left, $this->right);
//        }
  }

}

?>
