quickCheckout.grid.Status = function(config) {
    config = config || {};

	this.exp = new Ext.grid.RowExpander({
		expandOnDblClick: false
		,tpl : new Ext.Template('<p class="desc">{description}</p>')
		,renderer : function(v, p, record){return record.data.description != '' && record.data.description != null ? '<div class="x-grid3-row-expander">&#160;</div>' : '&#160;';}
	});
	this.dd = function(grid) {
		this.dropTarget = new Ext.dd.DropTarget(grid.container, {
			ddGroup : 'dd',
			copy:false,
			notifyDrop : function(dd, e, data) {
				var store = grid.store.data.items;
				var target = store[dd.getDragData(e).rowIndex].id;
				var source = store[data.rowIndex].id;
				if (target != source) {
					dd.el.mask(_('loading'),'x-mask-loading');
					MODx.Ajax.request({
						url: quickCheckout.config.connector_url
						,params: {
							action: config.action || 'mgr/status/sort'
							,source: source
							,target: target
						}
						,listeners: {
							success: {fn:function(r) {dd.el.unmask();grid.refresh();},scope:grid}
							,failure: {fn:function(r) {dd.el.unmask();},scope:grid}
						}
					});
				}
			}
		});
	};

	Ext.applyIf(config,{
		id: 'quickcheckout-grid-status'
		,url: quickCheckout.config.connector_url
		,baseParams: {
			action: 'mgr/status/getlist'
		}
		,fields: ['id','name','description','color','active','rank']
		,autoHeight: true
		,paging: true
		,remoteSort: true
		,save_action: 'mgr/status/updatefromgrid'
		,autosave: true
		,plugins: this.exp
		,columns: [this.exp
			,{header: 'ID',dataIndex: 'id',width: 50}
			,{header: _('quickcheckout_item_name'),dataIndex: 'name',width: 150, editor: {xtype: 'textfield', allowBlank: false}}
			,{header: _('quickcheckout_item_color'),dataIndex: 'color',renderer: this.renderColor, width: 50}
			,{header: _('quickcheckout_item_active'),dataIndex: 'active',width: 50, editor: {xtype: 'combo-boolean', renderer: 'boolean'}}
		]
		,tbar: [{
			text: _('quickcheckout_item_create')
			,handler: this.createStatus
			,scope: this
		}]
		,ddGroup: 'dd'
		,enableDragDrop: true
		,listeners: {render: {fn: this.dd, scope: this}}
	});
	quickCheckout.grid.Status.superclass.constructor.call(this,config);
};
Ext.extend(quickCheckout.grid.Status,MODx.grid.Grid,{
	windows: {}

	,getMenu: function() {
		var m = [];
		m.push({
			text: _('quickcheckout_item_update')
			,handler: this.updateStatus
		});
		if (this.menu.record.editable) {
			m.push('-');
			m.push({
				text: _('quickcheckout_item_remove')
				,handler: this.removeStatus
			});
		}
		this.addContextMenuItem(m);
	}

	,renderColor: function(value) {
		return '<div style="width: 30px; height: 20px; border-radius: 3px; background: #' + value + '">&nbsp;</div>'
	}

	,renderBoolean: function(value) {
		if (value == 1) {return _('yes');}
		else {return _('no');}
	}

	,createStatus: function(btn,e) {
		if (!this.windows.createStatus) {
			this.windows.createStatus = MODx.load({
				xtype: 'quickcheckout-window-status-create'
				,fields: this.getStatusFields('create')
				,listeners: {
					success: {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.createStatus.fp.getForm().reset();
		this.windows.createStatus.fp.getForm().setValues({color:'000000'});
		this.windows.createStatus.show(e.target);
	}

	,updateStatus: function(btn,e) {
		if (!this.menu.record || !this.menu.record.id) return false;
		var r = this.menu.record;

		if (!this.windows.updateStatus) {
			this.windows.updateStatus = MODx.load({
				xtype: 'quickcheckout-window-status-update'
				,record: r
				,fields: this.getStatusFields('update')
				,listeners: {
					success: {fn:function() { this.refresh(); },scope:this}
				}
			});
		}
		this.windows.updateStatus.fp.getForm().reset();
		this.windows.updateStatus.show(e.target);
		this.windows.updateStatus.fp.getForm().setValues(r);
	}

	,removeStatus: function(btn,e) {
		if (!this.menu.record) return false;

		MODx.msg.confirm({
			title: _('quickcheckout_item_remove')
			,text: _('quickcheckout_item_remove_confirm')
			,url: this.config.url
			,params: {
				action: 'mgr/status/remove'
				,id: this.menu.record.id
			}
			,listeners: {
				success: {fn:function(r) {this.refresh();}, scope:this}
			}
		});
	}

	,getStatusFields: function(type) {
		return [
			{xtype: 'hidden',name: 'id', id: 'quickcheckout-status-id-'+type}
			,{xtype: 'hidden',name: 'color',id: 'quickcheckout-newstatus-color-'+type}
			,{xtype: 'textfield',fieldLabel: _('quickcheckout_item_name'), name: 'name', allowBlank: false, anchor: '99%', id: 'quickcheckout-status-name-'+type}
			,{xtype: 'colorpalette', fieldLabel: _('quickcheckout_item_color'), id: 'quickcheckout-status-colorpalette-'+type
				,listeners: {
					select: function(palette, setColor) {
						Ext.getCmp('quickcheckout-newstatus-color-'+type).setValue(setColor)
					}
					,beforerender: function(palette) {
						var color = Ext.getCmp('quickcheckout-newstatus-color-'+type).value;
						if (color != 'undefined') {
							palette.value = color;
						}
					}
				}
			}
			,{xtype: 'textarea', fieldLabel: _('quickcheckout_item_description'), name: 'description', anchor: '99%', id: 'quickcheckout-status-description-'+type}
			,{xtype: 'checkboxgroup'
				,fieldLabel: _('quickcheckout_item_options')
				,columns: 1
				,items: [
					{xtype: 'xcheckbox', boxLabel: _('quickcheckout_item_active'), name: 'active', id: 'quickcheckout-status-active-'+type}
				]
			}
		];
	}

	,handleStatusFields: function(v) {
		var el = Ext.getCmp('quickcheckout-status-email_'+v);
		var subject = Ext.getCmp('quickcheckout-status-subject_'+v);
		var body = Ext.getCmp('quickcheckout-status-body_'+v);
		if (el.checked) {
			subject.allowBlank = false;
			body.allowBlank = false;
			subject.enable().show();
			body.enable().show();
		}
		else {
			subject.allowBlank = true;
			body.allowBlank = true;
			subject.hide().disable();
			body.hide().disable();
		}
	}

	,beforeDestroy: function() {
		if (this.rendered) {
			this.dropTarget.destroy();
		}
		quickCheckout.grid.Status.superclass.beforeDestroy.call(this);
	}
});
Ext.reg('quickcheckout-grid-status',quickCheckout.grid.Status);




quickCheckout.window.CreateStatus = function(config) {
	config = config || {};
	this.ident = config.ident || 'mecitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('quickcheckout_item_create')
		,id: this.ident
		,width: 600
		,autoHeight: true
		,labelAlign: 'left'
		,labelWidth: 180
		,url: quickCheckout.config.connector_url
		,action: 'mgr/status/create'
		,fields: config.fields
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	quickCheckout.window.CreateStatus.superclass.constructor.call(this,config);
};
Ext.extend(quickCheckout.window.CreateStatus,MODx.Window);
Ext.reg('quickcheckout-window-status-create',quickCheckout.window.CreateStatus);


quickCheckout.window.UpdateStatus = function(config) {
	config = config || {};
	this.ident = config.ident || 'meuitem'+Ext.id();
	Ext.applyIf(config,{
		title: _('quickcheckout_item_update')
		,id: this.ident
		,width: 600
		,autoHeight: true
		,labelAlign: 'left'
		,labelWidth: 180
		,url: quickCheckout.config.connector_url
		,action: 'mgr/status/update'
		,fields: config.fields
		,keys: [{key: Ext.EventObject.ENTER,shift: true,fn: function() {this.submit() },scope: this}]
	});
	quickCheckout.window.UpdateStatus.superclass.constructor.call(this,config);
};
Ext.extend(quickCheckout.window.UpdateStatus,MODx.Window);
Ext.reg('quickcheckout-window-status-update',quickCheckout.window.UpdateStatus);