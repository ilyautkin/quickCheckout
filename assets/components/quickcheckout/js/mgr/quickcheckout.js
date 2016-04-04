var quickCheckout = function (config) {
	config = config || {};
	quickCheckout.superclass.constructor.call(this, config);
};
Ext.extend(quickCheckout, Ext.Component, {
	page: {}, window: {}, grid: {}, tree: {}, panel: {}, combo: {}, config: {}, view: {}, utils: {}
});
Ext.reg('quickcheckout', quickCheckout);

quickCheckout = new quickCheckout();