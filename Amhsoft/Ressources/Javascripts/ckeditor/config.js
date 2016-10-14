/**
 * @license Copyright (c) 2003-2013, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see LICENSE.html or http://ckeditor.com/license
 */

CKEDITOR.editorConfig = function(config) {
  // Define changes to default configuration here. For example:
  // config.language = 'fr';
  // config.uiColor = '#AADC6E';
  config.filebrowserBrowseUrl = 'Amhsoft/Ressources/Javascripts/ckeditor/plugins/filemanager/index.php';
  //config.filebrowserBrowseUrl = 'filemanager/index.php';
 // config.filebrowserImageBrowseUrl = "Amhsoft/Ressources/Javascripts/ckeditor/plugins/filemanager/index.html?Type=Images";
  //config.filebrowserUploadUrl = 'Amhsoft/Ressources/Javascripts/ckeditor/plugins/filemanager/connectors/php/filemanager.php';
  //config.filebrowserImageUploadUrl ='Amhsoft/Ressources/Javascripts/ckeditor/plugins/filemanager/connectors/php/filemanager.php?command=QuickUpload&type=Images';
  
  config.enterMode = CKEDITOR.ENTER_BR;
  config.contentsCss = 'Design/Frontend/Souldrops/Layout/Default/style.css';

  
};



