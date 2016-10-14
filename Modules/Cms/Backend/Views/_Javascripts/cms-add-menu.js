$(function() {
  var mainMenu = $('#cms_main_menu_id').val();
  updateParents(mainMenu);
  $('#cms_main_menu_id').change(function() {
    mainMenu = $('#cms_main_menu_id').val();
    updateParents(mainMenu);
  });
});
function updateParents(mainMenu) {
  $.ajax({
    url: 'admin.php?module=cms&page=menu-add&event=parentsajax&mainmenuid=' + mainMenu,
    success: function(data) {
      $('#parent_id').children().remove();
      $('#parent_id').append('<option></option>');
      $('#parent_id').append(data);
      $("#parent_id").val($("#selected_parent").val());
    }
  });
}

