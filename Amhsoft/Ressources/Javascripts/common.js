function popup(location, width, height) {
    mWindow = window.open(location, "window", "width=" + width + ",height=" + height + ",status=no,scrollbars=yes,resizable=no,status=no, toolbar=no, left=200, top=120");
    var container = $('.panel');
    if (container) {
        container.css('min-height', height);
        var sWidth = container.width();
        var sHeight = container.height();
        mWindow.resizeTo(width, sHeight);
    }
}
//tinyMCE.init({
//  // General options
//  mode: "exact",
//  elements: "wysiwyg, editor, rich, editor1, editor2, editor3, editor4",
//  theme: "advanced",
//  plugins: "safari,spellchecker,pagebreak,style,layer,table,advhr,advlink,emotions,iespell,inlinepopups,insertdatetime,preview,media,searchreplace,print,contextmenu,paste,directionality,fullscreen,noneditable,visualchars,nonbreaking,xhtmlxtras,template",
//  // Theme options
//  theme_advanced_buttons1: "bold,italic,underline,strikethrough,|,justifyleft,justifycenter,justifyright,justifyfull,|,styleselect,formatselect,fontselect,fontsizeselect",
//  theme_advanced_buttons2: "cut,copy,paste,pastetext,pasteword,|,search,replace,|,bullist,numlist,|,outdent,indent,blockquote,|,undo,redo,|,link,unlink,anchor,image,cleanup,help,code,|,insertdate,inserttime,preview,|,forecolor,backcolor",
//  theme_advanced_buttons3: "tablecontrols,|,hr,removeformat,visualaid,|,sub,sup,|,charmap,emotions,iespell,media,advhr,|,print,|,ltr,rtl,|,fullscreen",
//  theme_advanced_buttons4: "insertlayer,moveforward,movebackward,absolute,|,styleprops,spellchecker,|,cite,abbr,acronym,del,ins,attribs,|,visualchars,nonbreaking,template,blockquote,pagebreak,|,example",
//  theme_advanced_toolbar_location: "top",
//  theme_advanced_toolbar_align: "left",
//  theme_advanced_statusbar_location: "bottom",
//  file_browser_callback: "tinyBrowser",
//  //external_link_list_url: "index.php?module=cms&page=externalCmsLinks",
//  theme_advanced_resizing: false,
//  convert_urls: false,
//  force_br_newlines: true,
//  force_p_newlines: false,
//
//  style_formats: [
//  {
//    title: 'Codigo fuente', 
//    block: 'div', 
//    classes: 'prettyprint', 
//    wrapper: 1
//  }
//  ],
//    
//  setup : function(ed) {
//    // Register example button
//    ed.addButton('example', {
//      title : 'Insert product',
//      image : 'http://localhost:81/Shop1/Amhsoft/Ressources/Icons/1.gif',
//      onclick : function() {
//       popup('admin.php?module=product&page=product-quicklist&action=producttinymce', 600, 400);
//      }
//    });
//  },
//   
//  
//  entity_encoding: "raw",
//
//  height: 350
//});




function fbrowser(field_name, url, type, win) {

    var cmsURL = '../../../../elfinder/elfinder.html';     // your URL could look like "/scripts/my_file_browser.php"


    tinyMCE.activeEditor.windowManager.open({
        file: cmsURL + "?type=" + type, // PHP session ID is now included if there is one at all
        title: "File Browser",
        width: 420, // Your dimensions may differ - toy around with them!
        height: 400,
        close_previous: "no"
    }, {
        window: win,
        input: field_name,
        resizable: "yes",
        inline: "yes"  // This parameter only has an effect if you use the inlinepopups plugin!

    });
    return false;
}

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


function changeTinyContent(id) {
    changeTinySubject(id);
    $.ajax({
        url: 'index.php?module=WebMail&page=Send&event=getcontent&id=' + id.value,
        success: function(data) {
            tinyMCE.activeEditor.setContent(data);
        }
    })
}

function changeTinySubject(id) {
    $.ajax({
        url: 'index.php?module=WebMail&page=Send&event=getsubject&id=' + id.value,
        success: function(data) {
            $('#email_subject').val(data);
        }
    })
}


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
});