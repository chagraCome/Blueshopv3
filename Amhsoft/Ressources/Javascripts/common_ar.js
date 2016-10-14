function popup(location, width, height) {
  mWindow = window.open(location, "window", "width=" + width + ",height=" + height + ",status=no,scrollbars=yes,resizable=no,status=no, toolbar=no, left=200, top=120");

  mWindow.resizeTo(width, height + 200);

}

//function fbrowser(field_name, url, type, win) {
//
//    var cmsURL = '../../../../elfinder/elfinder.html';     // your URL could look like "/scripts/my_file_browser.php"
//
//
//    tinyMCE.activeEditor.windowManager.open({
//        file: cmsURL + "?type=" + type, // PHP session ID is now included if there is one at all
//        title: "File Browser",
//        width: 420, // Your dimensions may differ - toy around with them!
//        height: 400,
//        close_previous: "no"
//    }, {
//        window: win,
//        input: field_name,
//        resizable: "yes",
//        inline: "yes"  // This parameter only has an effect if you use the inlinepopups plugin!
//
//    });
//    return false;
//}

$(function() { // this line makes sure this code runs on page load
  $('#checkall').click(function() {
    $(this).parents('table:eq(0)').find(':checkbox').attr('checked', this.checked);
  });
  //$( ".datepicker" ).datepicker();

  var dates = $("#datefrom, #dateto").datepicker({
    dateFormat: 'yy-mm-dd',
    changeMonth: true,
    numberOfMonths: 3,
    onSelect: function(selectedDate) {
      var option = this.id == "datefrom" ? "minDate" : "maxDate",
	      instance = $(this).data("datepicker");
      date = $.datepicker.parseDate(
	      instance.settings.dateFormat ||
	      $.datepicker._defaults.dateFormat,
	      selectedDate, instance.settings);
      dates.not(this).datepicker("option", option, date);
    }
  });

  $(".datepicker").datepicker({
    dateFormat: 'yy-mm-dd',
    showOtherMonths: true
  });

  $('.datetimepicker').datetimepicker({
    numberOfMonths: 1,
    timeFormat: 'hh:mm:ss',
    dateFormat: 'yy-mm-dd',
    stepMinute: 15,
    hourMin: 6,
    hourMax: 19,
    hourGrid: 2,
    minuteGrid: 15,
    showSecond: false,
    controlType: 'select'

  });

  $('.timepicker').timepicker({
    timeFormat: 'hh:mm:ss',
    stepMinute: 15,
    hourMin: 6,
    hourMax: 19,
    hourGrid: 2,
    minuteGrid: 15,
    showSecond: false,
    controlType: 'select'

  });
     $('.timedurationpicker').timepicker({
        
        timeFormat: 'hh:mm',
        stepMinute: 15,
        hourMin: 0,
        hourMax: 4,
        hourGrid: 2,
        minuteGrid: 15,
        showSecond: false,
        controlType: 'select'

    });


});
$(document.body).ready(function() {
  //$("<div>Write less do more</div>").floatingMessage();

});



function runCron() {
  $.ajax({
    url: 'cron.php',
    success: function(data) {
      if (data != '')
	$("<div>" + data + "</div>").floatingMessage();
    }
  })
}


//function appendToTinyMce(text) {
//  tinyMCE.activeEditor.focus();
//  tinyMCE.activeEditor.selection.setContent(text);
//
//}

function appendToTinyMce(text) {
  CKEDITOR.instances['wysiwyg'].insertText(text);
}

function confirmDelete(info) {
  if (info == null)
    info = "هل تريد فعلا اتمام العملية؟";
  return  window.confirm(info);
}

$(document).ready(function() {
  $('#wysiwyg').ckeditor();
  CKEDITOR.config.language = 'ar';

});