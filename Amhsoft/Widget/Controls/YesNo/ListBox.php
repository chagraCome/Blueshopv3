<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: ListBox.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Revision: 102 $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedBy: a.cherif $
 * @package    defaultPackage
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSOFT FrameWork is a commercial software
 * @author     AMHSOFT Dev Team
 * @created    <unknown>
 */

/**
 * Amhsoft_YesNo_ListBox_Control component
 * @author Amir Cherif
 */
class Amhsoft_YesNo_ListBox_Control extends Amhsoft_ListBox_Control implements Amhsoft_Widget_Interface {

    /**
     * Construct component
     * @param string $name id-name of component
     * @param string $label label text of component
     * @param string $databindStringValue Data binding as normal String for this list box
     * @param boolean $selectedValue True, if yes selected, false outherwise
     */
    public function __construct($name, $label, $databindStringValue, $selectedValue = false, $withNullOptions = false) {
        parent::__construct($name, $label);
        $data = array(
            array('id' => '0', 'name' => _t('No')),
            array('id' => '1', 'name' => _t('Yes'))
        );
        $this->DataSource = new Amhsoft_Data_Set($data);
        $this->DataBinding = new Amhsoft_Data_Binding($databindStringValue, 'id', 'name', $selectedValue);
        $this->WithNullOption = false;
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {
        return parent::Render();
    }

}

