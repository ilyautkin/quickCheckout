quickCheckout.window.CreateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'quickcheckout-item-window-create';
	}
	Ext.applyIf(config, {
		title: _('quickcheckout_item_create'),
		width: 550,
		autoHeight: true,
		url: quickCheckout.config.connector_url,
		action: 'mgr/item/create',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	quickCheckout.window.CreateItem.superclass.constructor.call(this, config);
};
Ext.extend(quickCheckout.window.CreateItem, MODx.Window, {

	getFields: function (config) {
		return [{
    		xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: true,
		}, {
    		xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_phone'),
			name: 'phone',
			id: config.id + '-phone',
			anchor: '99%',
			allowBlank: true,
		}, {
    		xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_address'),
			name: 'address',
			id: config.id + '-address',
			anchor: '99%',
			allowBlank: true,
		}, {
			xtype: 'textarea',
			fieldLabel: _('quickcheckout_item_description'),
			name: 'description',
			id: config.id + '-description',
			height: 150,
			anchor: '99%'
		}, {
            xtype: 'quickcheckout-combo-status',
            name: 'status',
            id: config.id + '-status',
            fieldLabel: _('quickcheckout_item_status'),
            anchor: '100%',
            order_id: 0
        }/*, {
			xtype: 'xcheckbox',
			boxLabel: _('quickcheckout_item_active'),
			name: 'active',
			id: config.id + '-active',
			checked: true,
		}*/];
	},

	loadDropZones: function() {
	}

});
Ext.reg('quickcheckout-item-window-create', quickCheckout.window.CreateItem);

quickCheckout.window.UpdateItem = function (config) {
	config = config || {};
	if (!config.id) {
		config.id = 'quickcheckout-item-window-update';
	}
	Ext.applyIf(config, {
		title: _('quickcheckout_item_update'),
		width: 550,
		autoHeight: true,
		url: quickCheckout.config.connector_url,
		action: 'mgr/item/update',
		fields: this.getFields(config),
		keys: [{
			key: Ext.EventObject.ENTER, shift: true, fn: function () {
				this.submit()
			}, scope: this
		}]
	});
	quickCheckout.window.UpdateItem.superclass.constructor.call(this, config);
    
};
Ext.extend(quickCheckout.window.UpdateItem, MODx.Window, {

	getFields: function (config) {
		return [{
			xtype: 'hidden',
			name: 'id',
			id: config.id + '-id',
		}, {
			xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_name'),
			name: 'name',
			id: config.id + '-name',
			anchor: '99%',
			allowBlank: true,
		}, {
        	xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_phone'),
			name: 'phone',
			id: config.id + '-phone',
			anchor: '99%',
			allowBlank: true,
		}, {
    		xtype: 'textfield',
			fieldLabel: _('quickcheckout_item_address'),
			name: 'address',
			id: config.id + '-address',
			anchor: '99%',
			allowBlank: true,
		}, {
			xtype: 'textarea',
			fieldLabel: _('quickcheckout_item_description'),
			name: 'description',
			id: config.id + '-description',
			anchor: '99%',
			height: 150,
		}, {
            xtype: 'quickcheckout-combo-status',
            name: 'status',
            id: config.id + '-status',
            fieldLabel: _('quickcheckout_item_status'),
            anchor: '100%',
            order_id: config.record.id
        }/*, {
			xtype: 'xcheckbox',
			boxLabel: _('quickcheckout_item_active'),
			name: 'active',
			id: config.id + '-active',
		}*/];
	},

	loadDropZones: function() {
	}

});
Ext.reg('quickcheckout-item-window-update', quickCheckout.window.UpdateItem);