quickCheckout.combo.Status = function (config) {
    config = config || {};

    Ext.applyIf(config, {
        name: 'status',
        id: 'quickcheckout-combo-status',
        hiddenName: 'status',
        displayField: 'name',
        valueField: 'id',
        fields: ['id', 'name'],
        pageSize: 10,
        emptyText: _('quickcheckout_item_status'),
        url: quickCheckout.config['connector_url'],
        baseParams: {
            action: 'mgr/status/getlist',
            combo: true,
            addall: config.addall || 0,
            order_id: config.order_id || 0
        },
        listeners: quickCheckout.combo.listeners_disable
    });
    quickCheckout.combo.Status.superclass.constructor.call(this, config);
};
Ext.extend(quickCheckout.combo.Status, MODx.combo.ComboBox);
Ext.reg('quickcheckout-combo-status', quickCheckout.combo.Status);