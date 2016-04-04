Ext.onReady(function() {
	quickCheckout.config.connector_url = OfficeConfig.actionUrl;

	var grid = new quickCheckout.panel.Home();
	grid.render('office-quickcheckout-wrapper');

	var preloader = document.getElementById('office-preloader');
	if (preloader) {
		preloader.parentNode.removeChild(preloader);
	}
});