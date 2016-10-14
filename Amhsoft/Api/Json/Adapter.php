<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of Amhsoft FrameWork
 * Amhsoft FrameWork is a commercial software
 *
 * $Id: Adapter.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package Api
 * @copyright  2005-2013 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Api_Json_Adapter extends Amhsoft_Api_Abstract_Adapter {

  public function error($message) {
    $array = array(
        'responce' => array(
            'result' => 0,
            'message' => $message,
            'data' => null
        )
    );
    echo json_encode($array);
  }

  public function responce(Amhsoft_System $system) {
    $package = $this->getPackage();

    if ($this->isLoginPackage() == 'login') {
      $this->handleLogin($system, $package);
      return;
    }


    if ($package->Class) {

      if ($package->Procedure == 'deleteById') {
        $this->handledeleteById($system, $package);
      }

      if ($package->Procedure == 'fetch') {
        $this->handleFetch($system, $package);
      }

      if ($package->Procedure == 'save') {
        $this->handleSave($system, $package);
      }
    } else {
      $this->handleWebForm($system, $package);
    }
  }

  protected function handleLogin(Amhsoft_System $system, Amhsoft_Api_Package $package) {
    $username = $package->Params['username'];
    $password = $package->Params['password'];
    $auth = Amhsoft_Authentication::getInstance();
    $auth->authenticate($username, $password);
    if (!$auth->isAuthenticated()) {
      $this->error('username or password is incorrect');
      exit;
    }

    $array = array(
        'responce' => array(
            'result' => 1,
            'message' => '-',
            'data' => array(
                'publickey' => session_id(),
                'expire' => time() + 1440
            )
        )
    );
    echo json_encode($array);
    exit;
  }

  protected function handleWebForm(Amhsoft_System $system, Amhsoft_Api_Package $package) {
    $module = $package->WebForm['module'];
    $controller = $package->WebForm['controller'];
    $event = $package->WebForm['event'];

    Amhsoft_Web_Request::setGet('module', $module);
    Amhsoft_Web_Request::setGet('page', $controller);
    Amhsoft_Web_Request::setGet('event', $event);

    foreach ($package->WebForm['param'] as $param) {
      $rtype = (string) $param['rtype'];
      $name = (string) $param['name'];
      $value = (string) $param['value'];
      if ($rtype == 'post') {
        Amhsoft_Web_Request::setPost($name, $value);
      }

      if ($rtype == 'get') {
        Amhsoft_Web_Request::setGet($name, $value);
      }
    }

    Amhsoft_Navigator::$DEBUG_MODE = true;
    $system->boot();
  }

  protected function handleFetch(Amhsoft_System $system, Amhsoft_Api_Package $package) {
    $array['responce'] = array();
    $class = $package->Class;
    $array['responce']['result'] = 1;
    $array['responce']['message'] = '-';
    $array['responce']['data'] = array();
    $adapter_str = $class . '_Adapter';
    $adapter = new $adapter_str;



    $where = $package->Params['filter']['where'];
    $limit = $package->Params['filter']['limit'];
    $orderby = $package->Params['filter']['orderby'];


    if ($where) {
      $adapter->where($where);
    }
    if ($limit) {
      $adapter->limit($limit);
    }
    if ($orderby) {
      $adapter->orderby($orderby);
    }
    $result = $adapter->fetch();

    $data_array = array();
    while ($item = $result->fetch()) {
      $data_array_item = array();
      $data_array_item['table'] = str_replace('`', '', $adapter->getTable());
       $data_array_item['class'] =  $adapter->getClassName();
      foreach ($item as $key => $val) {

        $key = str_replace('`', '', $key);

        if (is_string($val)) {
          $data_array_item[$key] = $val;
        }

        if (is_object($val)) {
          $data_array_item[$key]['table'] = $key;
          $data_array_item[$key]['class'] =  get_class($val);
          foreach ($val as $subkey => $subval) {
            if (is_string($subval)) {
              $data_array_item[$key][$subkey] = $subval;
            }
          }
        }
        if (is_array($val)) {
          $array['responce']['data']['table'][$key] = array();
          
          foreach ((array) $val as $arrayval) {
            if (is_object($arrayval)) {
              $subclass = get_class($arrayval);
              $subclassAdapter = $subclass . '_Adapter';
              $subclassAdapterObject = new $subclassAdapter();
              $sub_array['table'] = (str_replace('`', '', $subclassAdapterObject->getTable()));
              $sub_array['class'] = get_class($arrayval);
              foreach ($arrayval as $subkey1 => $subval1) {
                if (is_string($subval1)) {
                  $sub_array[$subkey1] =  $subval1;
                }
              }
              $array['responce']['data']['table'][$key][] = $sub_array;
            }
          }
        }
      }
      $data_array[] = $data_array_item;
    }
    $array['responce']['data'] = $data_array;
    echo json_encode($array);
  }

  protected function handleDeleteById(Amhsoft_System $system, Amhsoft_Api_Package $package) {
    $id = $package->Params['id'];
    $class = $package->Class;
    $procedure = $package->Procedure;
    $adapter_str = $class . '_Adapter';
    $adapter = new $adapter_str;
    call_user_func_array(array($adapter, $procedure), array('id' => $id));

    $array = array(
        'responce' => array(
            'result' => 1,
            'message' => 'data deleted',
            'data' => array(
                'id' => $id,
            )
        )
    );
     echo json_encode($array);
  }

  protected function handleSave(Amhsoft_System $system, Amhsoft_Api_Package $package) {
    $class = $package->Class;
    $adapter_str = $class . '_Adapter';
    $adapter = new $adapter_str;
    $object = new $class;

    $id = $package->Params['attr']['id'];

    if ($id > 0) {
      $object = $adapter->fetchById($id);
    } else {
      $object = new $class;
    }
    foreach ($package->Params['attr'] as $attribute => $value) {
      $object->$attribute = (string) $value;
    }
    $adapter->save($object);
  }

}
