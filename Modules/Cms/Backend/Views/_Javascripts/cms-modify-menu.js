$(function() {
  var mainMenu = $('#cms_main_menu_id').val();
  var parent = $('#parent_id').val();
  updateParents(mainMenu, parent);
  $('#cms_main_menu_id').change(function() {
    mainMenu = $('#cms_main_menu_id').val();
    updateParents(mainMenu, parent);
  });
});
function updateParents(mainMenu, parent) {

  $.ajax({
    url: 'admin.php?module=cms&page=menu-add&event=parentsajaxformodify&mainmenuid=' + mainMenu+'&parent_id=' + parent,
    success: function(data) {
      
      $('#parent_id').children().remove();
      $('#parent_id').append('<option></option>');
      $('#parent_id').append(data);
     /* $("#parent_id").val($("#parent_id").val());*/
    }
  });
}

