<?php

class Crm_Address_Model_Adapter extends Amhsoft_Data_Db_Model_Adapter {

    public function __construct() {
        $this->table = 'address';
        $this->className = 'Crm_Address_Model';
        $this->map = array(
            'id' => 'id',
            'name' => 'name',
            'street' => 'street',
            'zipcode' => 'zipcode',
            'city' => 'city',
            'province' => 'province',
            'country' => 'country',
			'neighborhood'=>'neighborhood',
            'account_id' => 'account_id',);
        parent::__construct();
    }

}

?>
