<?php

/* * *********************************************************************************************
 * NOTICE OF LICENSE
 *
 * This source file is part of AMHSHOP (E-Commerce Solution)
 * AMHSHOP is a commercial software
 *
 * $Id: AjaxMultiUpload.php 102 2016-01-25 21:55:57Z a.cherif $
 * $Rev: 102 $
 * @package    AMHSHOP
 * @copyright  2006-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany (http://www.amhsoft.com)
 * @license    AMHSHOP is a commercial software
 * $Date: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $LastChangedDate: 2016-01-25 22:55:57 +0100 (lun., 25 janv. 2016) $
 * $Author: a.cherif $
 * *********************************************************************************************** */

/**
 * Description of Amhsoft_AjaxMultiUpload_Control
 *
 * @author cherif
 */
class Amhsoft_AjaxMultiUpload_Control extends Amhsoft_Abstract_Control implements Amhsoft_Widget_Interface {

    private $destination;
    private $allowedTypes = array();
    private $callBackUrl;
    private $rename = true;
    private $bodyName;
    private $destinationName;

    public function setBodyName($bodyName) {
        $this->bodyName = $bodyName;
    }

    /**
     * upload folder
     * @param string $folder
     */
    public function setDestination($folder) {
        $this->destination = $folder;
    }

    /**
     * add 
     * @param mixed $type
     */
    public function setAllowType($type) {
        if (is_array($type)) {
            $this->allowedTypes = $type;
        } else {
            $this->allowedTypes[] = (string) $type;
        }
    }

    public function __construct($name, $destination, $callBackUrl, $bodyName=null) {
        parent::__construct($name, null);
        $this->bodyName = $bodyName;
        $this->callBackUrl = ($callBackUrl);
        if (preg_match('/\?/', $this->callBackUrl)) {
            $this->callBackUrl.='&';
        } else {
            $this->callBackUrl.='?';
        }

        $this->setDestination($destination);
        if (@$_GET['ajaxcall_image_upload']) {
            $this->doUpload();
        }
    }

//    private function doUpload() {
//        $uploaddir = rtrim($this->destination, '/') . '/';
//        $file = $uploaddir . basename($_FILES['uploadfile']['name']);
//        if (move_uploaded_file($_FILES['uploadfile']['tmp_name'], $file)) {
//            echo "success";
//        } else {
//            echo "error";
//        }
//        exit;
//    }

    private function doUpload() {
        $uploaddir = rtrim($this->destination, '/') . '/';
        $uploader = new Amhsoft_Upload();
        $uploader->doUpload($_FILES['uploadfile']);
        if ($uploader->uploaded) {
            $uploader->file_new_name_body = $this->bodyName;
            $uploader->allowed = array('image/*');
            $uploader->file_new_name_ext = 'jpg';
            $uploader->file_overwrite = true;
            $uploader->image_resize = true;
            $uploader->image_ratio = true;
            $uploader->image_y = 480;
            $uploader->image_x = 640;
            $uploader->process($uploaddir);
            $uploader->file_new_name_body = $this->bodyName. '_thumb';
            $uploader->allowed = array('image/*');
            $uploader->file_new_name_ext = 'jpg';
            $uploader->file_overwrite = true;
            $uploader->image_resize = true;
            $uploader->image_ratio = true;
            $uploader->image_y = 160;
            $uploader->image_x = 213;
            $uploader->process($uploaddir . "thumb/");
            echo str_replace('\\', '', $uploader->file_dst_pathname);
            
        }else{
             echo "error";
        }
        exit;
    }




        function Draw() {
            $dir = 'Amhsoft/Ressources/Javascripts/uploader';
            $str = '<script type="text/javascript" src="' . $dir . '/ajaxupload.3.5.js" ></script>
                <link rel="stylesheet" type="text/css" href="' . $dir . '/ajaxupload.3.5.css" />';

            $str .="<script type=\"text/javascript\" >
                $(function(){
                        var btnUpload=$('#upload');
                        var status=$('#status');
                        new AjaxUpload(btnUpload, {
                                action: '" . $this->callBackUrl . "ajaxcall_image_upload=true',
                                name: 'uploadfile',
                                onSubmit: function(file, ext){
                                         if (! (ext && /^(" . implode($this->allowedTypes, '|') . ")$/.test(ext))){ 
                            // extension is not allowed 
                                                status.text('" . implode($this->allowedTypes, ', ') . "');
                                                return false;
                                        }
                                        status.text('" . _t('Uploading...') . "');
                                },
                                onComplete: function(file, response){
                                //alert(response);
                                
                                        //On completion clear the status
                                        status.text('');
                                        //Add uploaded file to list
                                        if(response===\"error\"){
                                                $('<li></li>').appendTo('#files').text(file).addClass('error');
                                        } else{
                                                $('<li></li>').appendTo('#files').html('<img src=\"'+response+'\" alt=\"\" /><br />'+file).addClass('success');
                                        }
                                }
                        });

                });
        </script>";
            $str .= '<div id="mainbody" >
		<div id="upload" ><span>' . _t("Upload File") . '<span></div><span id="status" ></span>
		<!--<ul id="files" ></ul>
                </div>-->';
            return $str;
        }

    }

?>
