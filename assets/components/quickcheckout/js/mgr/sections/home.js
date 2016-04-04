quickCheckout.page.Home = function (config) {
	config = config || {};
	Ext.applyIf(config, {
		components: [{
			xtype: 'quickcheckout-panel-home', renderTo: 'quickcheckout-panel-home-div'
		}]
	});
	quickCheckout.page.Home.superclass.constructor.call(this, config);
};
Ext.extend(quickCheckout.page.Home, MODx.Component);
Ext.reg('quickcheckout-page-home', quickCheckout.page.Home);