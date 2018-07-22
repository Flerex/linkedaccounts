(function(window, document, undefined) {
	phpbb.addAjaxCallback('flerex.linked_accounts.switch', function(data) {
		if(!data.SUCCESS) {
			return;
		}
		
		if(data.REDIRECT) {
			location.href = data.REDIRECT;
		} else {
			location.reload(true);
		}
	});
})(this, document);