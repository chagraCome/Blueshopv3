<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AmhsoftFrameWork
 * AmhsoftFrameWork is a commercial software
 *
 * $Id: Paginate.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    offer
 * @copyright  2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    Amhsoft FrameWork is a commercial software
 * $Date:
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Paginate {

    var $TotalItems = 0;
    var $ItemProPage = 0;
    var $ArrayLength = 0;
    var $CurrentPage = 0;

    /**
     * Setup pageer
     * @param type $TotalItems
     * @param type $ItemProPage
     * @param type $ArrayLength
     */
    function Pager($TotalItems, $ItemProPage = 12, $ArrayLength = 8) {
        $this->TotalItems = $TotalItems;
        $this->ItemProPage = $ItemProPage;
        $this->ArrayLength = $ArrayLength;
    }

    function CalculatePageCount() {
        if ($this->ItemProPage > 0) {
            if (($this->TotalItems % $this->ItemProPage) > 0) {
                return intval(($this->TotalItems / $this->ItemProPage) + 1);
            } else {
                return intval($this->TotalItems / $this->ItemProPage);
            }
        }
    }

    function MakeArray() {
        $myarray = array();
        $totalPageCount = $this->CalculatePageCount();
        for ($i = 1; $i <= $totalPageCount; $i++) {
            $myarray[$i] = $i;
        }
        return $myarray;
    }

    function BeginIndex($length, $current, $min) {
        $current = abs(intval($current));
        if ($current == 0) {
            return 1;
        } else {
            return (($current - ($length / 2)) < $min) ? $min : ceil($current - ($length / 2));
        }
    }

    function LastIndex($length, $current, $max) {
        if ($current < 0) {
            return count($this->MakeArray());
        } else {
            $x = (($current + ($length / 2)) < $length) ? $length : ceil($current + ($length / 2));
        }
        if ($x > $max) {
            return $max;
        }
        return $x;
    }

    function GetLastPage() {
        return count($this->MakeArray());
    }

    function SelectSubArray() {
        $wholeArray = $this->MakeArray();
        $selectedArray = array();
        $j = 0;
        for ($i = $this->BeginIndex($this->ArrayLength, $this->CurrentPage, 1); $i < $this->LastIndex($this->ArrayLength, $this->CurrentPage, count($wholeArray) + 1); $i++) {
            $selectedArray[] = $wholeArray[$i];
        }
        return $selectedArray;
    }

    function getLimit($currentPage = null) {
        if ($currentPage == null) {
            $req = new Amhsoft_Web_Request();
            $currentPage = $req->getCurrentPage();
        }
        $this->CurrentPage = $currentPage;
        $limit = ($currentPage == 0) ? " LIMIT " . ($this->ItemProPage) : " LIMIT " . ($currentPage * $this->ItemProPage ) . ", " . $this->ItemProPage;
        return $limit;
    }

    function toHTML($linkUrl = 'admin.php', $urlFriendly = false, $css_class = '') {
        $query = $linkUrl . '?' . Amhsoft_Common::GetQueryString($_GET, array('p'), true);

        if ($urlFriendly == false) {
            $url = Amhsoft_Common::AddParamToQueryString($query, 'p', 0, true);
        } else {
            $url = Amhsoft_Navigator::url($linkUrl . $query, $urlFriendly) . '?p=0';
        }
        $html = '<ul id="pagination" class="' . $css_class . '">';
        $html .= '<li' . (($this->CurrentPage == 0) ? ' class="current"' : '') . '><a href="' . $url . '">' . _t('First Page') . '</a></li>';

        if (count($this->SelectSubArray()) < 2) {
            return null;
        }


        $lastPage = $this->GetLastPage();
        foreach ($this->SelectSubArray() as $index => $page) {
            if ($page <= $lastPage) {
                $query = $linkUrl . '?' . Amhsoft_Common::GetQueryString($_GET, array('p'), true);
                if ($urlFriendly == false) {
                    $url = Amhsoft_Common::AddParamToQueryString($query, 'p', ($page - 1), true);
                } else {
                    $url = Amhsoft_Navigator::url($linkUrl . $query, $urlFriendly) . '?p=' . $page;
                }
                if ($this->CurrentPage == ($page - 1)) {
                    $html .= '<li class="current"><a href="' . $url . '">' . ($page) . '</a></li>';
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
        $html .= '<li' . (($this->CurrentPage == $lastPage) ? ' class="current"' : '') . '><a href="' . $url . '">' . _t('Last page') . '</a></li>';
        $html .= '</ul>';

        return $html;
    }

}
