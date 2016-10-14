$(function() {
    $( ".column" ).sortable({
        connectWith: ".column",
        update: function(event, ui) {
            var result = $(this).sortable('serialize');
            var type = ($(this).attr('id'));
            $.post('admin.php?module=product&page=attributeset-detail&event=order&type='+type+"&id="+$('#id').val(),result);
        }
    });
		
    $( ".portlet-header .ui-icon" ).click(function() {
        $( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
        $( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
    });

    $( ".column" ).disableSelection();
});

