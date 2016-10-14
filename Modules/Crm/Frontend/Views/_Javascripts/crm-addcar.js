/**
 * NOTICE OF LICENSE
 * 
 * This source file is part of AmhsoftFrameWork AmhsoftFrameWork is a commercial
 * software
 * 
 * $Id: crm-addcar.js 112 2016-01-26 13:50:57Z a.cherif $ $Rev: 112 $
 * 
 * @package offer
 * @copyright 2005-2010 (c) AMHSOFT e.K. (Web & Software Solutions) Germany
 *            (http://www.amhsoft.com)
 * @license Amhsoft FrameWork is a commercial software $Date: 2016-01-26 14:50:57 +0100 (mar., 26 janv. 2016) $LastChangedDate: $
 *          $Author: a.cherif $
 */
$(function() {
  var selectedModel = $('#model_id').val();
  updateModel(selectedModel);
  $('#make').change(function() {
    updateModel(selectedModel);
  });
});

function updateModel(selectedModel) {
  var make = $('#make').val();
  $.ajax({
    url : 'index.php?module=crm&page=addcar&event=getmodels&make='
    + make + '&ajax=true&model=' + selectedModel,
    success : function(data) {
      $('#model').children().remove();
      $('#model').append(data);
    }
  });
}

