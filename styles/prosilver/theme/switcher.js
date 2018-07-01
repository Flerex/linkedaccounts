(function(window, document, undefined) {
	phpbb.addAjaxCallback('flerex.linked_accounts.switch', function(data) {
		if(data.SUCCESS) {
			location.reload(true);
		}
	});
})(this, document);