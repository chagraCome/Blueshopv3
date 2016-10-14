<?php
/**
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: Ftp.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    Core
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.Amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 */

class Amhsoft_Ftp {

  var $hostname	= '';
  var $username	= '';
  var $password	= '';
  var $port		= 21;
  var $passive	= TRUE;
  var $debug		= FALSE;
  var $conn_id	= FALSE;

  function Amhsoft_Ftp($config = array())
  {
    if (count($config) > 0)
    {
      $this->initialize($config);
    }
  }

  function initialize($config = array())
  {
    foreach ($config as $key => $val)
    {
      if (isset($this->$key))
      {
        $this->$key = $val;
      }
    }

    // Prep the hostname
    $this->hostname = preg_replace('|.+?://|', '', $this->hostname);
  }


  function connect($config = array())
  {
    if (count($config) > 0)
    {
      $this->initialize($config);
    }

    if (FALSE === ($this->conn_id = @Amhsoft_Ftp_connect($this->hostname, $this->port)))
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_connect');
      }
      return FALSE;
    }

    if ( ! $this->_login())
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_login');
      }
      return FALSE;
    }

    if ($this->passive == TRUE)
    {
      Amhsoft_Ftp_pasv($this->conn_id, TRUE);
    }

    return TRUE;
  }


  function _login()
  {
    return @Amhsoft_Ftp_login($this->conn_id, $this->username, $this->password);
  }


  function _is_conn()
  {
    if ( ! is_resource($this->conn_id))
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_no_connection');
      }
      return FALSE;
    }
    return TRUE;
  }


  function changedir($path = '', $supress_debug = FALSE)
  {
    if ($path == '' OR ! $this->_is_conn())
    {
      return FALSE;
    }

    $result = @Amhsoft_Ftp_chdir($this->conn_id, $path);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE AND $supress_debug == FALSE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_changedir');
      }
      return FALSE;
    }

    return TRUE;
  }


  function mkdir($path = '', $permissions = NULL)
  {
    if ($path == '' OR ! $this->_is_conn())
    {
      return FALSE;
    }

    $result = @Amhsoft_Ftp_mkdir($this->conn_id, $path);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_makdir');
      }
      return FALSE;
    }


    if ( ! is_null($permissions))
    {
      $this->chmod($path, (int)$permissions);
    }

    return TRUE;
  }


  function upload($locpath, $rempath, $mode = 'auto', $permissions = NULL)
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    if ( ! file_exists($locpath))
    {
      $this->_error('Amhsoft_Ftp_no_source_file');
      return FALSE;
    }


    if ($mode == 'auto')
    {

      $ext = $this->_getext($locpath);
      $mode = $this->_settype($ext);
    }

    $mode = ($mode == 'ascii') ? FTP_ASCII : FTP_BINARY;

    $result = @Amhsoft_Ftp_put($this->conn_id, $rempath, $locpath, $mode);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_upload');
      }
      return FALSE;
    }

    // Set file permissions if needed
    if ( ! is_null($permissions))
    {
      $this->chmod($rempath, (int)$permissions);
    }

    return TRUE;
  }


  function rename($old_file, $new_file, $move = FALSE)
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    $result = @Amhsoft_Ftp_rename($this->conn_id, $old_file, $new_file);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $msg = ($move == FALSE) ? 'Amhsoft_Ftp_unable_to_rename' : 'Amhsoft_Ftp_unable_to_move';

        $this->_error($msg);
      }
      return FALSE;
    }

    return TRUE;
  }


  function move($old_file, $new_file)
  {
    return $this->rename($old_file, $new_file, TRUE);
  }

  // --------------------------------------------------------------------


  function delete_file($filepath)
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    $result = @Amhsoft_Ftp_delete($this->conn_id, $filepath);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_delete');
      }
      return FALSE;
    }

    return TRUE;
  }

  // --------------------------------------------------------------------


  function delete_dir($filepath)
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    // Add a trailing slash to the file path if needed
    $filepath = preg_replace("/(.+?)\/*$/", "\\1/",  $filepath);

    $list = $this->list_files($filepath);

    if ($list !== FALSE AND count($list) > 0)
    {
      foreach ($list as $item)
      {
        // If we can't delete the item it's probaly a folder so
        // we'll recursively call delete_dir()
        if ( ! @Amhsoft_Ftp_delete($this->conn_id, $filepath.$item))
        {
          $this->delete_dir($filepath.$item);
        }
      }
    }

    $result = @Amhsoft_Ftp_rmdir($this->conn_id, $filepath);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_delete');
      }
      return FALSE;
    }

    return TRUE;
  }


  function chmod($path, $perm)
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    // Permissions can only be set when running PHP 5
    if ( ! function_exists('Amhsoft_Ftp_chmod'))
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_chmod');
      }
      return FALSE;
    }

    $result = @Amhsoft_Ftp_chmod($this->conn_id, $perm, $path);

    if ($result === FALSE)
    {
      if ($this->debug == TRUE)
      {
        $this->_error('Amhsoft_Ftp_unable_to_chmod');
      }
      return FALSE;
    }

    return TRUE;
  }


  function list_files($path = '.')
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    return Amhsoft_Ftp_nlist($this->conn_id, $path);
  }


  function mirror($locpath, $rempath)
  {

    if ( ! $this->_is_conn()){
      return FALSE;
    }

    // Open the local file path
    if ($fp = @opendir($locpath)){
      	
      // Attempt to open the remote file path.
      if ( ! $this->changedir($rempath, TRUE)){

        // If it doesn't exist we'll attempt to create the direcotory
        if ( ! $this->mkdir($rempath)){
          return FALSE;
        }

        if (!$this->changedir($rempath)){
          return FALSE;
        }

      }

      // Recursively read the local directory
      while (FALSE !== ($file = readdir($fp)))
      {
        	

        if (@is_dir($locpath.$file) && substr($file, 0, 1) != '.')
        {
          $this->mirror($locpath.$file."/", $file);
        }
        elseif (substr($file, 0, 1) != ".")
        {
          // Get the file extension so we can se the upload type
          $ext = $this->_getext($file);
          $mode = $this->_settype($ext);
          $this->upload($locpath.$file, $rempath.$file, $mode);
        }

      }

      return TRUE;
      	
    }

    return FALSE;
  }


  // --------------------------------------------------------------------



  function _getext($filename)
  {
    if (FALSE === strpos($filename, '.'))
    {
      return 'txt';
    }

    $x = explode('.', $filename);
    return end($x);
  }


  // --------------------------------------------------------------------

  function _settype($ext)
  {
    $text_types = array(
							'txt',
							'text',
							'php',
							'phps',
							'php4',
							'js',
							'css',
							'htm',
							'html',
							'phtml',
							'shtml',
							'log',
							'xml'
							);


							return (in_array($ext, $text_types)) ? 'ascii' : 'binary';
  }

  // ------------------------------------------------------------------------


  function close()
  {
    if ( ! $this->_is_conn())
    {
      return FALSE;
    }

    @Amhsoft_Ftp_close($this->conn_id);
  }

  // ------------------------------------------------------------------------

  function _error($line)
  {
    echo "Error: ".$line."<br>";
  }


}

?>