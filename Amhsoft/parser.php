<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: parser.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of parser
 *
 * @author cherif
 */
$arguments = getopt("d:f:");
$format = 'php';
if (isset($arguments['f'])) {
  $format = $arguments['f'];
}


$diretory = $arguments['d'];

$diretory = rtrim($diretory, '/');
$diretory = rtrim($diretory, '\\');

if (!is_dir($diretory)) {
  die('directory: ' . $diretory . ' not found.');
}




$files = array();

get_files_from_dir($diretory);

function get_files_from_dir($_dir) {
  global $files;
  $directoryIterator = new DirectoryIterator($_dir . '/');
  foreach ($directoryIterator as $path) {
    if ($path->isDir() && !$path->isDot() && $path->getBasename() != '.svn') {
      get_files_from_dir($path->getPathname());
    } else {
      if (preg_match("/html$/", $path->getPathname())) {
        $files[] = $path->getPathname();
      }
    }
  }
}

if (trim($format) == 'php') {
  $str = "";
  $str .= '<?php' . PHP_EOL;
  foreach ($files as $file) {
    $str .= '//' . $file . PHP_EOL;
    $exp = "/\{'(.*)'\|tr/i";
    $content = file_get_contents($file);
    preg_match_all("/['\{]([a-zA-Z\s])*'\|tr/U", $content, $output, PREG_OFFSET_CAPTURE);
    $words = $output[0];

    foreach ($words as $w) {
      $str .= '_t(' . str_replace('|tr', '', $w[0]) . ');' . PHP_EOL;
    }
  }


  @file_put_contents($diretory . '/key_words_html.php', $str);
  exit;
}

if (trim($format) == 'ini') {
  $str = "";
  foreach ($files as $file) {
    $str .= ';' . $file;
    $exp = "/\{'(.*)'\|tr/i";
    $content = file_get_contents($file);
    preg_match_all("/['\{]([a-zA-Z\s])*'\|tr/U", $content, $output, PREG_OFFSET_CAPTURE);
    $words = $output[0];

    foreach ($words as $w) {
      $str .= str_replace(array("'", '|tr'), '', $w[0]) . ' = ' . str_replace(array("'", '|tr'), '', $w[0]) . PHP_EOL;
    }
  }


  @file_put_contents($diretory . '/lang.ini', $str);
}
exit;
?>
