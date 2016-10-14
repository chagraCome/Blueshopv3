window.addEvent('domready', function(){
	$('box_border').onclick = function()
	{
		if($('box_border').getProperty('checked') == true)
		$('box_name').setProperty('disabled', '');
		else
		$('box_name').setProperty('disabled', 'disabled');
	}
});