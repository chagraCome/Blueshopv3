<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: DataGridView.php 102 2016-01-25 21:55:57Z a.cherif $
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
 * Amhsoft_Bootstrap_DataGridView_Component class
 * @author Montasser Smida
 */
class Amhsoft_Widget_Bootstrap_DataGridView implements Amhsoft_Widget_Interface {

    /** @var Amhsoft_Data_Source datasource */
    public $DataSource;
    public $Name;

    /** @var boolean True, if Amhsoft_DataGridView_Component is sortable, false otherwise */
    public $Sortable = false;

    /** @var string class attribute value for stylesheets */
    private $Class = 'grid';

    /** @var string width attribute value of the datagridview */
    private $Width = '100%';

    /** @var integer count/number of columns */
    private $columnsCount = 0;

    /** @var integer count/number of rows/lines */
    private $rowsCount = 0;

    /** @var array 2-dimensional list of table cells */
    private $columns = array();

    /** @var integer count/number of rows/lines per page */
    private $rowProPage = 50;

    /** @var integer offset index */
    private $offset = 0;

    /** @var array List of checked/selected values in list */
    private $checked = array();
    /* @var Amhsoft_Widget_Event $onRowDraw */
    public $onRowDraw;
    /* @var Amhsoft_Widget_Event onHeaderColumnDraw */
    public $onHeaderColumnDraw;
    /* @var Amhsoft_Widget_Event onButtonOkClicked */

    /** @var Amhsoft_Widget_Event $onSearchColumn */
    public $onSearchColumn;

    /** @var Amhsoft_Widget_Event $onSortColumn */
    public $onSortColumn;
    public $Draggable = false;
    public $DragUrl = null;
    public $Style = null;

    /** @var boolean True, if datagrid has pagination, false otherwise. */
    private $withPagination = false;
    protected $asc = 'ASC';
    protected $searchKeys = array();
    public $Searchable = false;
    protected $pagination;
    public $LinkUrl = 'admin.php';
    //version 1.2
    protected $headerRender;
    public $WithActions = false;
    public $actions = array();
    public $Id = 'grid';

    public function getLabel() {
        
    }

    /**
     * Gets Columns
     * @since 1.1
     * @return array columns
     */
    public function getColumns() {
        return $this->columns;
    }

    /**
     * Gets search keys.
     * @since 1.1
     * @return array $search keys
     */
    public function getSearchColumns() {
        return $this->searchKeys;
    }

    public function setApplyEvent($sender, $callBack) {
        $this->onButtonOkClicked->registerEvent($sender, $callBack);
        $this->onButtonOkClicked->dispatchEvent();
    }

    public function setSearchable($Searchable) {
        $this->Searchable = $Searchable;
    }

    public function removeColumnAt($index) {
        if ($index < 0) {
            $index = count($this->columns) + $index;
            //echo $index; exit;
        }
        unset($this->columns[$index]);
        $this->columns = array_values($this->columns);

        unset($this->searchKeys[$index]);
        $this->searchKeys = array_values($this->searchKeys);
    }

    public function findByName($name) {
        for ($i = 0; $i < count($this->columns); $i++) {
            if ($this->columns[$i]->Name == $name) {
                return $this->columns[$i];
            }
        }
    }

    public function setPagination($pagination) {
        $this->pagination = $pagination;
        $this->pagination->CurrentPage = intval(@$_GET['p']);
        $this->offset = $this->pagination->CurrentPage * $this->pagination->ItemProPage + 1;
        //$this->rowProPage = $this->pagination->ItemProPage;
        $this->rowsCount = $this->pagination->TotalItems;
    }

    /**
     * Construct Amhsoft_DataGridView_Component table
     *
     * <code>
     * <?php
     * $headers = array('id' => '#', 'name' => 'Name', 'birthday' => 'Birth Day');
     * $dataGridView = new Amhsoft_DataGridView_Component($headers);
     * ?>
     * </code>
     *
     * @param array $headers header titles of table/Amhsoft_DataGridView_Component
     */
    public function __construct($headers = array()) {
        foreach ((array) $headers as $key => $val) {
            if ($val == 'c') {
                $checkBox = new Amhsoft_CheckBox_Control($key, 'id');
                $checkBox->DataBinding = new Amhsoft_Data_Binding('id');
                $checkBox->DataBinding->Index = null;
                $this->columns[] = $checkBox;
                $this->addSearcField(null);
            } else {
                if (preg_match("/price/i", $key) || preg_match("/amount/i", $key)) {
                    $this->columns[] = new Amhsoft_Currency_Label_Control($val, new Amhsoft_Data_Binding($key));
                } else {
                    $label = new Amhsoft_Label_Control($val, new Amhsoft_Data_Binding($key));
                    $label->setValue($val);
                    $label->setLabel($val);
                    $this->columns[] = $label;
                }
            }
        }
        $this->onRowDraw = new Amhsoft_Widget_Event();
        $this->onHeaderColumnDraw = new Amhsoft_Widget_Event();
        $this->onButtonOkClicked = new Amhsoft_Widget_Event();
        $this->onSearchColumn = new Amhsoft_Widget_Event();
        $this->onSortColumn = new Amhsoft_Widget_Event();

        if (intval(@$_GET['maxpp']) > 0) {
            $_SESSION['maxpp'] = intval($_GET['maxpp']);
        }
        $this->rowProPage = isset($_SESSION['maxpp']) ? $_SESSION['maxpp'] : 50;
    }

    /**
     * add a checked line by given index
     * @param integer $id index of checked line
     */
    public function addCheckedLine($id) {
        $this->checked[] = $id;
    }

    /**
     * sets checked lines by given indizes
     * @param array $ids list of indizes of checked lines
     */
    public function setCheckedLines(array $ids) {
        $this->checked = $ids;
    }

    /**
     * set header titles
     * <code>
     * <?php
     * $headers = array('id' => '#', 'name' => 'Name', 'birthday' => 'Birth Day');
     * $dataGridView->setHeaders($headers);
     * ?>
     * </code>
     *
     * @param array $headers list of new header titles
     */
    public function setHeaders($headers = array()) {

        foreach ($headers as $key => $val) {
            if ($val == 'c') {
                $checkBox = new Amhsoft_CheckBox_Control('id', '#');
                $checkBox->DataBinding = new DataBinding('id');
                $this->columns[] = $checkBox;
            } else {
                if (preg_match("/price/i", $key)) {
                    $this->columns[] = new CurrencyLabel($val, new DataBinding($key));
                } else {
                    $this->columns[] = new Label($val, new DataBinding($key));
                }
            }
        }
    }

    /**
     * Add new Column to Amhsoft_DataGridView_Component
     *
     * <code>
     * <?php
     * $dataGridView = new Amhsoft_DataGridView_Component();
     * $nameColumn = new Label('customer_name');
     * $nameColumn->DataBinding = new DataBinding('customer_name');
     * $dataGridView->AddColumn($nameColumn);
     * ?>
     * </code>
     *
     * @param Amhsoft_Widget_Interface $column Column object
     * @return Amhsoft_DataGridView_Component whole Amhsoft_DataGridView_Component
     * @deprecated since version 1.1
     */
    public function AddColumn(Amhsoft_Widget_Interface $column, $identName = null) {
        $column->IdentName = $identName;
        $this->columns[] = $column;
        return $this;
    }

    /**
     *
     * @param Amhsoft_Widget_Interface $column
     * @return Amhsoft_DataGridView_Component
     */
    public function addColum(Amhsoft_Widget_Interface $column, $identName = null) {
        return $this->AddColumn($column, $identName);
    }

    public function findByIdentName($identName) {
        for ($i = 0; $i < count($this->columns); $i++) {
            if (isset($this->columns[$i]->IdentName) && $this->columns[$i]->IdentName == $identName) {
                return $this->columns[$i];
            }
        }
    }

    public function removeByIdentName($identName) {
        $i = 0;
        foreach ($this->columns as $col) {
            if (isset($col->IdentName) && $col->IdentName == $identName) {
                unset($this->columns[$i]);
                $this->columns = array_values($this->columns);

                unset($this->searchKeys[$i]);
                $this->searchKeys = array_values($this->searchKeys);
                return;
            }
            $i++;
        }
    }

    /**
     * Set count/number of rows per page
     *
     * <code>
     * <?php
     * $dataGridView->setRowCountProPage(30);
     * ?>
     * </code>
     *
     * @param integer $count count/cumber of raws per page
     */
    public function setRowCountProPage($count) {
        $this->rowProPage = $count;
    }

    /**
     * set offset index for Amhsoft_DataGridView_Component table
     * @param integer $offset offset index for Amhsoft_DataGridView_Component table
     */
    public function setOffset($offset) {
        $this->offset = $offset;
    }

    /**
     * Get current page number
     * @return integer current page number
     */
    private function getPageNumber() {
        return ceil($this->offset / $this->rowProPage());
    }

    /**
     * Get total number of pages (page count)
     * @return integer total number of pages (page count)
     */
    private function pageCount() {
        return ceil($this->getTotal() / $this->rowProPage());
    }

    /**
     * get count/number of rows/lines per page
     * @return integer count/number of rows/lines per page
     */
    private function rowProPage() {
        return $this->rowProPage;
    }

    /**
     * get total number of data source values
     * @return integer total number of data source values
     */
    private function getTotal() {
        return count($this->DataSource);
    }

    /**
     * get submit button
     * @return SubmitButton submit button
     */
    private function getButtonPerPage() {
        $button = new Amhsoft_Button_Submit_Control('gridapply', _t('Apply'));
        $button->Class = 'Button Ok button_blue';
        $button->onClick = $this->onButtonOkClicked;
        return $button;
    }

    /**
     * get HTML/output of pagination
     * @return string HTML/output of pagination
     */
    private function buildPagination() {
        if ($this->withPagination == false) {
            return;
        }
        $selectBox = new Amhsoft_ListBox_Control('maxpp');
        $selectBox->DataSource = new Amhsoft_Data_Set(array(10, 20, 30, 40, 50, 100));
        $selectBox->Value = $this->rowProPage;
        $dir = (Amhsoft_System::getCurrentLang('lang') == 'Arabic') ? 'dir="rtl"' : 'dir="ltr"';
        $margin = (Amhsoft_System::getCurrentLang('lang') == 'ar') ? 'margin-right: 250px;float:left;direction:rtl' : 'float:left';
        $align = (Amhsoft_System::getCurrentLang('lang') == 'ar') ? 'left' : 'right';
        if ($this->WithActions == true) {
            $action = _t('Action') . ': <select name="select_action" onchange="document.task_form.submit();">
            <option value=""></option>
            ';
            foreach ($this->actions as $value => $label) {
                $action .= '<option value="' . $value . '">' . $label . '</option>';
            }

            $action .= '</select>';
        }
        return $action . '<h4 ' . $dir . ' align="' . $align . '" style="padding-bottom:10px;' . $margin . '">&nbsp;&nbsp;&nbsp;&nbsp;' . _t('Total Records') . ': ' . $this->getTotal() . '
            ' . $selectBox->Render() . '
             ' . $this->getButtonPerPage()->Render() . '</h4><div style="clear:both"></div>';
    }

    /**
     * get HTML/output of table opener tag
     * @return string HTML/output of table opener tag
     */
    private function init() {
        $div = "<div class='row'><div class='col-xs-12'><div class='box'><div class='box-header'><h3 class='box-title'></h3></div><div class='box-body table-responsive'><div clas='dataTables_wrapper form-inline' role='grid'><div class='row'><div class='col-xs-6'></div><div class='col-xs-6'></div></div>";
        $table = $div;
        if ($this->withPagination == true) {
            $table .= '<form id="task_form" class="forms" action="" method="get" name="task_form">';
            $table .= '<input type="hidden" name="module" value="' . Amhsoft_Web_Request::get('module') . '"/>';
            $table .= '<input type="hidden" name="page" value="' . Amhsoft_Web_Request::get('page') . '"/>';
            $table .= '<input type="hidden" name="event" value="' . Amhsoft_Web_Request::get('event') . '"/>';
            $table .= '<input type="hidden" name="refresh" value="' . Amhsoft_Web_Request::get('refresh') . '"/>';
            $currentId = Amhsoft_Web_Request::getInt('id');
            if ($currentId > 0) {
                $table .= '<input type="hidden" name="id" value="' . $currentId . '"/>';
            }
        }
        $table .= $this->buildPagination();

        $table .= '<table  id="' . $this->Id . '"  class="table table-bordered table-hover dataTable ' . $this->Class . '" ' . $this->Style . ' >';
        return $table;
    }

    /**
     * get HTML/output of table head container
     * @return string HTML/output of table head container
     */
    private function buildHeaderColumns() {
        $i = 0;
        $str = '<thead><tr role="row">';
        while ($i < count($this->columns)) {
            $str .= $this->getHeaderColumnHtml($this->columns[$i], $i);
            $i++;
        }
        $str .= '</tr></thead>';
        if ($this->Searchable == true) {
            $str .= $this->buildSearchFields();
        }
        return $str;
    }

    /**
     * build/get HTML/output of cell/column/td by given data value
     * @param mixed $data data for table cell/column/td
     * @return string HTML/output of cell/column/td
     */
    private function getColumnHtml($data, $index = null, $datasource = null) {

        $column = null;

        if ($this->columns[$this->columnsCount] instanceof Amhsoft_Currency_Label_Control) {
            $this->columns[$this->columnsCount]->Value = $data;
            $column = $this->columns[$this->columnsCount];
        } elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_Label_Control) {
            $this->columns[$this->columnsCount]->Value = $data;
            $column = $this->columns[$this->columnsCount];
        } elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_ListBox_Control) {

            $this->columns[$this->columnsCount]->Value = $data;
            $in = clone $this->columns[$this->columnsCount];

            if ($index == null) {
                $in->Name .= '[]';
            } else {
                $in->Name .= '[' . $index . ']';
            }


            $column = $in;
        } elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_CheckBox_Control) {
            if ($data == 1) {
                $this->columns[$this->columnsCount]->Checked = true;
            } else {
                $this->columns[$this->columnsCount]->Checked = false;
            }
            $this->columns[$this->columnsCount]->Value = $data;

            if (@in_array($data, $this->checked)) {
                $this->columns[$this->columnsCount]->Checked = true;
            } else {
                $this->columns[$this->columnsCount]->Checked = false;
            }
            $ck = clone $this->columns[$this->columnsCount];

            if ($index == null) {
                $ck->Name .= '[]';
            } else {
                $ck->Name = $this->columns[$this->columnsCount]->Name . '[' . $index . ']';
            }
            $column = $ck;
        } elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_RadioBox_Control) {

            if (empty($this->checked)) {
                $this->columns[$this->columnsCount]->Checked = true;
            } else {
                if (@in_array($data, $this->checked)) {
                    $this->columns[$this->columnsCount]->Checked = true;
                } else {
                    $this->columns[$this->columnsCount]->Checked = false;
                }
            }
            $this->columns[$this->columnsCount]->Value = $data;
            $column = $this->columns[$this->columnsCount];
        }

//    elseif ($this->columns[$this->columnsCount] instanceof Input) {
//
//      $this->columns[$this->columnsCount]->Value = $data;
//      $column = $this->columns[$this->columnsCount];
//
//    }
        elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_Input_Control) {

            $this->columns[$this->columnsCount]->Value = $data;
            $in = clone $this->columns[$this->columnsCount];
            if ($index == null) {
                $in->Name .= '[]';
            } else {
                $in->Name = $this->columns[$this->columnsCount]->Name . '[' . $index . ']';
            }


            $column = $in;
        } elseif ($this->columns[$this->columnsCount] instanceof Amhsoft_Link_Control) {

            $li = clone $this->columns[$this->columnsCount];
            if (!isset($this->columns[$this->columnsCount]->Value)) {
                $li->Value = $data;
                $li->ValueToDisplay = $index;
            }
            if ($li->Href == '') {
                $linking = '';
            } else {

                $linking = (substr($li->Href, -1) == '?' OR substr($li->Href, -1) == '/') ? '' : '&';
            }
            if ($li->Alias) {
                if ($linking == '') {
                    $li->Href .= $data;
                } else {
                    $li->Href .= $linking . $this->columns[$this->columnsCount]->Alias . '=' . $data;
                }
            } else {
                $li->Href .= $linking . $this->columns[$this->columnsCount]->DataBinding->Value . '=' . $data;
            }

            $column = $li;
        } else {
            $this->columns[$this->columnsCount]->Label = $data;
            $this->columns[$this->columnsCount]->Value = $data;
            $column = $this->columns[$this->columnsCount];
        }
        $column->bind($datasource);
        $this->onRowDraw->dispatchEvent($this->columnsCount, $column, $datasource->current());
        if ($column instanceof Amhsoft_Widget_Interface) {
            return '<td>' . $column->Render() . '</td>';
        } else {
            return '<td></td>';
        }
    }

    /**
     * add/get cell/column/th for table head
     * @param mixed $data data for cell/column/th for table head
     * @return string HTML/output of cell/column/th for table head
     */
    private function getHeaderColumnHtml($data, $index = null) {
        $this->onHeaderColumnDraw->dispatchEvent($index, $data);
        if (is_string($data)) {
            return '<th class="sorting_asc" role="columnhedaer">' . $data . '</th>';
        }
        if ($data instanceof Amhsoft_CheckBox_Control && !isset($data->notCheck)) {
            $checkAll = new Amhsoft_CheckBox_Control('checkall');
            return '<th class="sorting" role="columnhedaer" width="40">' . $checkAll->Render() . '</th>';
        }



        $width = null;
        if ($data->Width) {
            $width = 'width="' . $data->Width . '"';
        }
        if ($this->Sortable == true) {
            if ($data->DataBinding->Value != $data->DataBinding->Index) {
                return '<th class="sorting" role="columnhedaer" ' . $width . '><a href="' . $this->getSortUrl($data->DataBinding->Index) . '">' . $data->Label . '</a></th>';
            }
            return '<th class="sorting" role="columnhedaer" ' . $width . '><a href="' . $this->getSortUrl($data->DataBinding->Value) . '">' . $data->Label . '</a></th>';
        }

        return '<th class="sorting" role="columnhedaer" ' . $width . '>' . $data->Label . '</th>';
    }

    protected function getSortUrl($element) {
        if ($this->Sortable == false) {
            return "#";
        }
        $query = $this->LinkUrl . '?' . Amhsoft_Common::GetQueryString($_GET, array('sortby', 'ord'), true);
        $this->asc = @$_GET['ord'];
        $query .= '&sortby=' . $element;
        if ($this->asc == 'ASC') {
            $query .='&ord=DESC';
        } else {
            $query .='&ord=ASC';
        }
        return $query;
    }

    /**
     * add/get row/line/tr for table
     * @param string $data row/line/tr for table
     * @return string HTML/output of row/line/tr for table
     */
    public function getRowHtml($data, $id) {
        $idstring = ($this->Draggable && $id) ? 'id="' . $id . '"' : null;
        return '<tr ' . $idstring . ' >' . $data . '</tr>';
    }

    /**
     * get number/count of rows
     * @return integer number/count of rows
     */
    public function RowCount() {
        return $this->rowsCount;
    }

    /**
     * get number/count of columns
     * @return integer number/count of columns
     */
    public function ColumnCount() {
        return $this->columnsCount;
    }

    public function RenderExcel() {

        $data = array();
        //$this->DataSource = new PDOAmhsoft_Data_Set();
        foreach ($this->columns as $col) {
            $data[0][] = $col->Label;
        }
        if ($this->DataSource instanceof Amhsoft_Data_Set) {
            $i = 1;
            for ($this->DataSource->rewind(); $this->DataSource->valid(); $this->DataSource->next()) {

                $this->columnsCount = 0;
                while ($this->columnsCount < count($this->columns)) {
                    if (isset($this->DataSource[$this->columns[$this->columnsCount]->DataBinding->Value])) {
                        $data[$i][] = ($this->DataSource[$this->columns[$this->columnsCount]->DataBinding->Value]);
                    }
                    $this->columnsCount++;
                }
                $i++;
            }
        }




        $xls = new Amhsoft_Excel('UTF-8', false, 'Report');
        $xls->addArray($data);
        return $xls->generateXML('report', false);
    }

    /**
     * Draw/Render components
     * @return string output like HTML
     */
    public function Render() {


        $str = $this->init();
        $str .= $this->buildHeaderColumns();
        //$str .= '<tbody>' . PHP_EOL;
        $str .= PHP_EOL;

        if ($this->pagination == null && $this->DataSource && $this->DataSource->count() > 0) {
            $this->pagination = new Amhsoft_Paginate();
            $this->rowsCount = $this->DataSource->count();
            $this->pagination->Pager($this->rowsCount, $this->rowProPage, 10);
            $this->pagination->CurrentPage = intval(@$_GET['p']);
            $this->offset = $this->pagination->CurrentPage * $this->pagination->ItemProPage;
            $dataSource = new LimitIterator($this->DataSource, $this->offset, $this->rowProPage);
        } else {
            $dataSource = $this->DataSource;
        }

        if ($this->DataSource instanceof Amhsoft_Data_Set) {
            //$dataSource = new LimitIterator($this->DataSource, $this->offset, $this->rowProPage);
            $r = 0;
            if ($this->DataSource->Count() == 0) {
                $str .= "<tr><td style='text-align:center' colspan='" . count($this->columns) . "'>" . _t('No Records') . "</td></tr>";
            }

            for ($dataSource->rewind(); $dataSource->valid(); $dataSource->next()) {
                if ($dataSource->current() == null) {
                    continue;
                }
                $i = 0;
                $this->columnsCount = 0;
                $columns = null;
                while ($this->columnsCount < count($this->columns)) {

                    if ($this->columns[$this->columnsCount]->DataBinding->Value) {
                        $index = null;
                        if ($this->columns[$this->columnsCount]->DataBinding->Index) {
                            $index = $this->DataSource->GetString($this->columns[$this->columnsCount]->DataBinding->Index);
                        }
                        $columns .= $this->getColumnHtml($this->DataSource->GetString($this->columns[$this->columnsCount]->DataBinding->Value), $index, $dataSource) . PHP_EOL;
                    } else {
                        $columns .= '<td>---</td>';
                    }
                    $this->columnsCount++;
                }

                $id = isset($this->DataSource['id']) ? $this->DataSource['id'] : null;
                $str .= $this->getRowHtml($columns . PHP_EOL, $id);
            }
        }

        $str = $str . '</tbody></table></div>' . PHP_EOL;
        if ($this->withPagination == true) {
            $str .= '</form>';
        }

        if ($this->pagination) {
            $pagination_str = "<div class='row'><div class='col-xs-6'><div class='dataTables_paginate paging_bootstrap'>";
            $pagination_str .= $this->toHTML($this->LinkUrl, false, 'pagination');
            $pagination_str .="</div></div></div>";
            $str .= $pagination_str;
        }

        if ($this->Draggable) {

            $str.= '
                <script type="text/javascript" src="Amhsoft/Ressources/Javascripts/JQuery/jquery.tablednd.js"></script>
                <script type="text/javascript">
                $(document).ready(function() {
                    $(".grid").tableDnD({
                        onDragClass: "myDragClass",
                        onDrop: function(table, row) {
                        $.post("' . $this->DragUrl . '", $.tableDnD.serialize());
                           // alert($.tableDnD.serialize());
                        }
                    });
                });
            </script>';
        }
        return $str;
    }

    public function toHTML($linkUrl = 'admin.php', $urlFriendly = false, $css_class) {
        $query = $linkUrl . '?' . Amhsoft_Common::GetQueryString($_GET, array('p'), true);

        if ($urlFriendly == false) {
            $url = Amhsoft_Common::AddParamToQueryString($query, 'p', 0, true);
        } else {
            $url = Amhsoft_Navigator::url($linkUrl . $query, $urlFriendly) . '?p=0';
        }
        $html = '<ul id="pagination" class="' . $css_class . '">';
        $html .= '<li' . (($this->pagination->CurrentPage == 0) ? ' class="current disabled"' : '') . '><a href="' . $url . '">' . _t('First Page') . '</a></li>';

        if (count($this->pagination->SelectSubArray()) < 2) {
            return null;
        }


        $lastPage = $this->pagination->GetLastPage();
        foreach ($this->pagination->SelectSubArray() as $index => $page) {
            if ($page <= $lastPage) {
                $query = $linkUrl . '?' . Amhsoft_Common::GetQueryString($_GET, array('p'), true);
                if ($urlFriendly == false) {
                    $url = Amhsoft_Common::AddParamToQueryString($query, 'p', ($page - 1), true);
                } else {
                    $url = Amhsoft_Navigator::url($linkUrl . $query, $urlFriendly) . '?p=' . $page;
                }
                if ($this->pagination->CurrentPage == ($page - 1)) {
                    $html .= '<li class="active"><a href="' . $url . '">' . ($page) . '</a></li>';
                } else {
                    $html .= '<li><a href="' . $url . '">' . ($page) . '</a></li>';
                }
            }
        }
        $lastPage = $lastPage - 1;
        if ($urlFriendly == false) {
            $url = Amhsoft_Common::AddParamToQueryString($query, 'p', $lastPage, true);
        } else {
            $url = Amhsoft_Navigator::url($linkUrl . $query, $urlFriendly) . '?p=' . $lastPage;
        }
        $html .= '<li' . (($this->pagination->CurrentPage == $lastPage) ? ' class="current disabled"' : '') . '><a href="' . $url . '">' . _t('Last page') . '</a></li>';
        $html .= '</ul>';

        return $html;
    }

    /**
     * Get true if Amhsoft_DataGridView_Component is sortable, false otherwise
     * @return boolean True, if Amhsoft_DataGridView_Component is sortable
     */
    public function getSortable() {
        return $this->Sortable;
    }

    /**
     * set to true if Amhsoft_DataGridView_Component should be sortable, false otherwise
     * @param boolean $Sortable True, if Amhsoft_DataGridView_Component is sortable
     */
    public function setSortable($Sortable) {
        $this->Sortable = $Sortable;
    }

    /**
     * get class attribute value
     * @return string class attribute value
     */
    public function getClass() {
        return $this->Class;
    }

    /**
     * set class attribute value
     * @param string $Class class attribute value
     */
    public function setClass($Class) {
        $this->Class = $Class;
    }

    /**
     * get width attribute value
     * @return string width attribute value
     */
    public function getWidth() {
        return $this->Width;
    }

    /**
     * set width attribute value
     * @param string $Width width attribute value
     */
    public function setWidth($Width) {
        $this->Width = $Width;
    }

    /**
     * Get true, if datagrid has pagination, false otherwise.
     * @return boolean True, if datagrid has pagination, false otherwise.
     */
    public function isWithPagination() {
        return $this->withPagination;
    }

    /**
     * Set to true, if datagrid has pagination, false otherwise.
     * @param boolean $withPagination True, if datagrid has pagination, false otherwise.
     */
    public function setWithPagination($withPagination) {
        $this->withPagination = $withPagination;
        if ($withPagination == false) {
            return;
        }
    }

    public function addSearcField($field) {
        $this->searchKeys[] = $field;
    }

    public function allowSearch() {
        $this->Searchable = true;
    }

    public function performSort(Amhsoft_Web_Request $req, Amhsoft_Data_Db_Model_Adapter $adapter) {
        $orderBy = $req->get('sortby');
        if (!$orderBy) {
            return;
        }
        $asc = ($req->get('ord') == "DESC") ? " DESC" : " ASC";
        $i = 0;
        while ($i < count($this->columns)) {
            $sortCol = ($this->columns[$i]->DataBinding->Index) ? $this->columns[$i]->DataBinding->Index : $this->columns[$i]->DataBinding->Value;
            if ($sortCol == $orderBy) {
                $e = $this->onSortColumn->dispatchEvent($orderBy, $adapter, $asc);
                if ($e == false) {
                    $adapter->orderBy($adapter->qualify($orderBy) . $asc);
                }
                break;
            }
            $i++;
        }
    }

    public function performSearch(Amhsoft_Web_Request $req, Amhsoft_Data_Db_Model_Adapter $adapter) {
        $i = 0;



        if (!$req->isGet('gridapply') || $this->Searchable == false) {
            return;
        }
        $this->buildSearchFields();


        while ($i < count($this->searchKeys)) {

            if (!isset($this->searchKeys[$i])) {

                $i++;
                continue;
            }
            $name = is_array($this->searchKeys[$i]) ? $this->searchKeys[$i][0]->Identification : @$this->searchKeys[$i]->Name;
            if (!$name) {
                $i++;
                continue;
            }

            $e = $this->onSearchColumn->dispatchEvent($name, $adapter, $req);
            if ($e == true) {
                $i++;
                continue;
            }

            if ($this->searchKeys[$i] instanceof Amhsoft_ListBox_Control) {
                $val = $req->get($this->searchKeys[$i]->Name);
                if ($val) {
                    $this->searchKeys[$i]->selectedValues = array($val);
                    $adapter->where($adapter->qualify($this->searchKeys[$i]->Name) . ' = ?', $val, PDO::PARAM_STR);
                }
                $i++;
                continue;
            }

            if (is_array($this->searchKeys[$i])) {
                if ($req->get($this->searchKeys[$i][0]->Name)) {
                    $adapter->where($adapter->qualify($this->searchKeys[$i][0]->Identification) . ' >= ?', $req->get($this->searchKeys[$i][0]->Name), PDO::PARAM_STR);
                }
                if ($req->get($this->searchKeys[$i][1]->Name)) {
                    $adapter->where($adapter->qualify($this->searchKeys[$i][1]->Identification) . ' <= ?', $req->get($this->searchKeys[$i][1]->Name), PDO::PARAM_STR);
                }
                $i++;
                continue;
            }
            $adapter->where($adapter->qualify($this->searchKeys[$i]->Name) . ' LIKE ?', '%' . $req->get($this->searchKeys[$i]->Name) . '%', PDO::PARAM_STR);

            $i++;
        }
    }

    public function buildSearchFields() {

        $str = '<tbody role="alert"><tr class="table_search">';
        $i = 0;
        while ($i < count($this->columns)) {

            if (!isset($this->searchKeys[$i])) {
                $str .= '<td>&nbsp;</td>';
                $i++;
                continue;
            }


            if (is_array($this->searchKeys[$i])) {
                $str .= '<td>' . $this->searchKeys[$i][0]->Render() . $this->searchKeys[$i][1]->Render() . '</td>';
            } elseif ($this->searchKeys[$i] instanceof Amhsoft_Abstract_Control) {
                if ($this->searchKeys[$i] instanceof Amhsoft_ListBox_Control) {
                    $this->searchKeys[$i]->Value = @$_REQUEST[$this->searchKeys[$i]->DataBinding->Value];
                } else {
                    $this->searchKeys[$i]->Value = @$_REQUEST[$this->columns[$i]->DataBinding->Index];
                }
                $str .= '<td>' . $this->searchKeys[$i]->Render() . '</td>';
            } elseif ($this->searchKeys[$i] == 'text') {
                if ($this->columns[$i] instanceof Amhsoft_Link_Control) {
                    $this->searchKeys[$i] = new Amhsoft_Input_Control($this->columns[$i]->DataBinding->Index, null, null);
                    $this->searchKeys[$i]->Value = @$_REQUEST[$this->columns[$i]->DataBinding->Index];
                } else {
                    $this->searchKeys[$i] = new Amhsoft_Input_Control($this->columns[$i]->DataBinding->Value, null, null);
                    $this->searchKeys[$i]->Value = @$_REQUEST[$this->columns[$i]->DataBinding->Value];
                }


                $this->searchKeys[$i]->setClass('searchinp');
                $this->searchKeys[$i]->JavaScript = "this.value=''";
                $str .= '<td>' . $this->searchKeys[$i]->Render() . '</td>';
            } elseif ($this->searchKeys[$i] == 'date') {

                $date = new Amhsoft_Date_Input_Control('_datefrom');
                $date->setId("datefrom");
                $date->setClass(null);
                $date->Identification = $this->columns[$i]->DataBinding->Value;
                $date->setSize(10);
                $date->setValue(@$_REQUEST['_datefrom']);
                $date->JavaScript = "this.value == ''";
                $date2 = new Amhsoft_Date_Input_Control('_dateto');
                $date2->setId('dateto');
                $date2->setValue(@$_REQUEST['_dateto']);
                $date2->setClass(null);
                $date2->setSize(10);
                $date2->Identification = $this->columns[$i]->DataBinding->Value;
                $this->searchKeys[$i] = array($date, $date2);
                $str .= '<td>' . $date->Render() . $date2->Render() . '</td>';
            }


            $i++;
        }


        $str .= '</tr>';

        return $str;
    }

}
