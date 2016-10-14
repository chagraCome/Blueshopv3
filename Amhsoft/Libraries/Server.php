<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Server.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */
class Amhsoft_Server {

  function Amhsoft_Server(){
    	
  }

  function setAllowCallTimePassReference($value){
    ini_set('allow_call_time_pass_reference', $value);
  }

  function getAllowCallTimePassReference(){
    return ini_get('allow_call_time_pass_reference');
  }

  function setAllowUrlFopen($value){
    ini_set('allow_url_fopen', $value);
  }

  function getAllowUrlFopen(){
    return ini_get('allow_url_fopen');
  }

  function setAllowUrlInclude($value){
    ini_set('allow_url_include', $value);
  }

  function getAllowUrlInclude(){
    return ini_get('allow_url_include');
  }

  function setAlwaysPopulateRawPostData($value){
    ini_set('always_populate_raw_post_data', $value);
  }

  function getAlwaysPopulateRawPostData(){
    return ini_get('always_populate_raw_post_data');
  }

  function setAspTags($value){
    ini_set('asp_tags', $value);
  }

  function getAspTags(){
    return ini_get('asp_tags');
  }

  function setAutoAppendFile($value){
    ini_set('auto_append_file', $value);
  }

  function getAutoAppendFile(){
    return ini_get('auto_append_file');
  }

  function setAutoDetectLineEndings($value){
    ini_set('auto_detect_line_endings', $value);
  }

  function getAutoDetectLineEndings(){
    return ini_get('auto_detect_line_endings');
  }

  function setAutoGlobalsJit($value){
    ini_set('auto_globals_jit', $value);
  }

  function getAutoGlobalsJit(){
    return ini_get('auto_globals_jit');
  }

  function setAutoPrependFile($value){
    ini_set('auto_prepend_file', $value);
  }

  function getAutoPrependFile(){
    return ini_get('auto_prepend_file');
  }

  function setBrowscap($value){
    ini_set('browscap', $value);
  }

  function getBrowscap(){
    return ini_get('browscap');
  }

  function setDefaultCharset($value){
    ini_set('default_charset', $value);
  }

  function getDefaultCharset(){
    return ini_get('default_charset');
  }

  function setDefaultMimetype($value){
    ini_set('default_mimetype', $value);
  }

  function getDefaultMimetype(){
    return ini_get('default_mimetype');
  }

  function setDefaultSocketTimeout($value){
    ini_set('default_socket_timeout', $value);
  }

  function getDefaultSocketTimeout(){
    return ini_get('default_socket_timeout');
  }

  function setDefineSyslogVariables($value){
    ini_set('define_syslog_variables', $value);
  }

  function getDefineSyslogVariables(){
    return ini_get('define_syslog_variables');
  }

  function setDisableClasses($value){
    ini_set('disable_classes', $value);
  }

  function getDisableClasses(){
    return ini_get('disable_classes');
  }

  function setDisableFunctions($value){
    ini_set('disable_functions', $value);
  }

  function getDisableFunctions(){
    return ini_get('disable_functions');
  }

  function setDisplayErrors($value){
    ini_set('display_errors', $value);
  }

  function getDisplayErrors(){
    return ini_get('display_errors');
  }

  function setDisplayStartupErrors($value){
    ini_set('display_startup_errors', $value);
  }

  function getDisplayStartupErrors(){
    return ini_get('display_startup_errors');
  }

  function setDocRoot($value){
    ini_set('doc_root', $value);
  }

  function getDocRoot(){
    return ini_get('doc_root');
  }

  function setDocrefExt($value){
    ini_set('docref_ext', $value);
  }

  function getDocrefExt(){
    return ini_get('docref_ext');
  }

  function setDocrefRoot($value){
    ini_set('docref_root', $value);
  }

  function getDocrefRoot(){
    return ini_get('docref_root');
  }

  function setEnableDl($value){
    ini_Set('enable_dl', $value);
  }

  function getEnableDl(){
    return ini_get('enable_dl');
  }

  function setEngine($value){
    ini_Set('engine', $value);
  }

  function getEngine(){
    return ini_get('engine');
  }

  function setErrorAppendString($value){
    ini_Set('error_append_string', $value);
  }

  function getErrorAppendString(){
    return ini_get('error_append_string');
  }

  function setErrorLog($value){
    ini_Set('error_log', $value);
  }

  function getErrorLog(){
    return ini_get('error_log');
  }

  function setErrorPrependString($value){
    ini_Set('error_prepend_string', $value);
  }

  function getErrorPrependString(){
    return ini_get('error_prepend_string');
  }

  function setErrorReporting($value){
    ini_Set('error_reporting', $value);
  }

  function getErrorReporting(){
    return ini_get('error_reporting');
  }

  function setExposePhp($value){
    ini_Set('expose_php', $value);
  }

  function getExposePhp(){
    return ini_get('expose_php');
  }

  function setExtensionDir($value){
    ini_Set('extension_dir', $value);
  }

  function getExtensionDir(){
    return ini_get('extension_dir');
  }

  function setFileUploads($value){
    ini_Set('file_uploads', $value);
  }

  function getFileUploads(){
    return ini_get('file_uploads');
  }

  function setHtmlErrors($value){
    ini_Set('html_errors', $value);
  }

  function getHtmlErrors(){
    return ini_get('html_errors');
  }

  function setIgnoreRepeatedErrors($value){
    ini_Set('ignore_repeated_errors', $value);
  }

  function getIgnoreRepeatedErrors(){
    return ini_get('ignore_repeated_errors');
  }

  function setIgnoreRepeatedSource($value){
    ini_Set('ignore_repeated_source', $value);
  }

  function getIgnoreRepeatedSource(){
    return ini_get('ignore_repeated_source');
  }

  function setIgnoreUserAbort($value){
    ini_Set('ignore_user_abort', $value);
  }

  function getIgnoreUserAbort(){
    return ini_get('ignore_user_abort');
  }

  function setImplicitFlush($value){
    ini_Set('implicit_flush', $value);
  }

  function getImplicitFlush(){
    return ini_get('implicit_flush');
  }

  function setIncludePath($value){
    ini_Set('include_path', $value);
  }

  function getIncludePath(){
    return ini_get('include_path');
  }

  function setLastModified($value){
    ini_Set('last_modified', $value);
  }

  function getLastModified(){
    return ini_get('last_modified');
  }

  function setLogErrors($value){
    ini_Set('log_errors', $value);
  }

  function getLogErrors(){
    return ini_get('log_errors');
  }

  function setLogErrorsMaxLen($value){
    ini_Set('log_errors_max_len', $value);
  }

  function getLogErrorsMaxLen(){
    return ini_get('log_errors_max_len');
  }

  function setMagicQuotesGpc($value){
    ini_Set('magic_quotes_gpc', $value);
  }

  function getMagicQuotesGpc(){
    return ini_get('magic_quotes_gpc');
  }

  function setMagicQuotesRuntime($value){
    ini_Set('magic_quotes_runtime', $value);
  }

  function getMagicQuotesRuntime(){
    return ini_get('magic_quotes_runtime');
  }

  function setMagicQuotesSybase($value){
    ini_Set('magic_quotes_sybase', $value);
  }

  function getMagicQuotesSybase(){
    return ini_get('magic_quotes_sybase');
  }

  function setMaxExecutionTime($value){
    ini_Set('max_execution_time', $value);
  }

  /**
   * return the maximum execution time of a php script (time in Sec)
   * @author Amir Ksiksi
   * @version 1.0
   * @return integer [second]
   */
  function getMaxExecutionTime(){
    return ini_get('max_execution_time');
  }

  function setMaxInputNestingLevel($value){
    ini_Set('max_input_nesting_level', $value);
  }

  function getMaxInputNestingLevel(){
    return ini_get('max_input_nesting_level');
  }

  function setMaxInputTime($value){
    ini_Set('max_input_time', $value);
  }

  function getMaxInputTime(){
    return ini_get('max_input_time');
  }

  function setMemoryLimit($value){
    ini_Set('memory_limit', $value);
  }

  function getMemoryLimit(){
    return ini_get('memory_limit');
  }

}




?>