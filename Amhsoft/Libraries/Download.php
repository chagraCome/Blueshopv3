<?php

/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Download.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
function force_download($filename = '', $data = '', $mime = 'application/octet-stream') {
  if ($filename == '' OR $data == '') {
    return FALSE;
  }

  // Try to determine if the filename includes a file extension.
  // We need it in order to set the MIME type
  if (FALSE === strpos($filename, '.')) {
    return FALSE;
  }

  // Grab the file extension
  $x = explode('.', $filename);
  $extension = end($x);

  if (strstr($_SERVER['HTTP_USER_AGENT'], "MSIE")) {
    header('Content-Type: "' . $mime . '"');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header("Content-Transfer-Encoding: binary");
    header('Pragma: public');
    header("Content-Length: " . strlen($data));
  } else {
    header('Content-Type: "' . $mime . '"');
    header('Content-Disposition: attachment; filename="' . $filename . '"');
    header("Content-Transfer-Encoding: binary");
    header('Expires: 0');
    header('Pragma: no-cache');
    header("Content-Length: " . strlen($data));
  }

  echo $data;
}

?>