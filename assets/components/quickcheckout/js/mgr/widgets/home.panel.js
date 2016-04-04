quickCheckout.panel.Home = function (config) {
	config = config || {};
	Ext.apply(config, {
		baseCls: 'modx-formpanel',
		layout: 'anchor',
		/*
		 stateful: true,
		 stateId: 'quickcheckout-panel-home',
		 stateEvents: ['tabchange'],
		 getState:function() {return {activeTab:this.items.indexOf(this.getActiveTab())};},
		 */
		hideMode: 'offsets',
		items: [{
			html: '<h2>' + _('quickcheckout') + '</h2>',
			cls: '',
			style: {margin: '15px 0'}
		}, {
			xtype: 'modx-tabs',
			defaults: {border: false, autoHeight: true},
			border: true,
			hideMode: 'offsets',
			items: [{
				title: _('quickcheckout_items'),
				layout: 'anchor',
				items: [{
					html: _('quickcheckout_intro_msg'),
					cls: 'panel-desc',
				}, {
					xtype: 'quickcheckout-grid-items',
					cls: 'main-wrapper',
				}]
			}]
		}]
	});
	quickCheckout.panel.Home.superclass.constructor.call(this, config);
};
Ext.extend(quickCheckout.panel.Home, MODx.Panel);
Ext.reg('quickcheckout-panel-home', quickCheckout.panel.Home);
