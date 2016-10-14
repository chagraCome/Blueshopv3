$(function() {
		$( ".column" ).sortable({
			connectWith: ".column",
			update: function(event, ui) {
			  var result = $(this).sortable('serialize');
			  var view_id = ($(this).attr('id'));
                          $.post('admin.php?module=cms&page=page-design&event=order&ajax=true&view='+view_id+"&pageid="+$('#pageid').val(),result);
			}
		});
		
		$( ".portlet-header .ui-icon" ).click(function() {
			$( this ).toggleClass( "ui-icon-minusthick" ).toggleClass( "ui-icon-plusthick" );
			$( this ).parents( ".portlet:first" ).find( ".portlet-content" ).toggle();
		});

		$( ".column" ).disableSelection();
	});

