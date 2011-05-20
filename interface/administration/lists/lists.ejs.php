<?php 
//******************************************************************************
// list.ejs.php
// List Options Panel
// v0.0.2
// 
// Author: Ernest Rodriguez
// Modified: Gino Rivera
// 
// MitosEHR (Eletronic Health Records) 2011
//******************************************************************************

session_name ( "MitosEHR" );
session_start();
session_cache_limiter('private');

include_once("../../../library/I18n/I18n.inc.php");

//**********************************************************************************
// Reset session count 10 secs = 1 Flop
//**********************************************************************************
$_SESSION['site']['flops'] = 0;

?>

<script type="text/javascript">
// *************************************************************************************
// Sencha trying to be like a language
// using requiered to load diferent components
// *************************************************************************************
Ext.Loader.setConfig({enabled: true});
Ext.Loader.setPath('Ext.ux', '<?php echo $_SESSION['dir']['ux']; ?>');
Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.util.*',
    'Ext.state.*',
    'Ext.toolbar.Paging',
    'Ext.ux.SlidingPager'
]);

Ext.onReady(function(){
	
	//******************************************************************************
	// ExtJS Global variables 
	//******************************************************************************
	var rowPos; // Stores the current Grid Row Position (int)
	var currList; // Stores the current List Option (string)
	var currRec; // Store the current record (Object)
	
	//******************************************************************************
	// Sanitizing Objects!
	// Destroy them, if already exists in the browser memory.
	// This destructions must be called for all the objects that
	// are rendered on the document.body 
	//******************************************************************************
	if ( Ext.getCmp('winList') ){ Ext.getCmp('winList').destroy(); }
	
	// *************************************************************************************
	// Structure of the message record
	// creates a subclass of Ext.data.Record
	//
	// This should be the structure of the database table
	// 
	// *************************************************************************************
	var ListRecord = Ext.define("ListRecord", {extend: "Ext.data.Model", fields: [
		{name: 'id',			type: 'int',		mapping: 'id'},
		{name: 'list_id', 		type: 'string',		mapping: 'list_id'},
		{name: 'option_id', 	type: 'string',		mapping: 'option_id'},
		{name: 'title', 		type: 'string',		mapping: 'title'},
		{name: 'seq', 			type: 'int', 		mapping: 'seq'},
		{name: 'is_default', 	type: 'boolean',	mapping: 'is_default'},
		{name: 'option_value', 	type: 'string',		mapping: 'option_value'},
		{name: 'mapping', 		type: 'string',		mapping: 'mapping'},
		{name: 'notes', 		type: 'string',		mapping: 'notes'}
	],
		idProperty: 'id',
	});
	var storeListsOption = new Ext.data.Store({
		model		: 'ListRecord',
		proxy 		: {
			type	: 'ajax',
			api		: {
				read	: 'interface/administration/lists/data_read.ejs.php',
				create	: 'interface/administration/lists/data_create.ejs.php',
				update	: 'interface/administration/lists/data_update.ejs.php',
				destroy : 'interface/administration/lists/data_destroy.ejs.php'
			},
	        reader: {
	            type			: 'json',
	            idProperty		: 'id',
	            totalProperty	: 'totals',
	            root			: 'row'
	    	},
	    	writer: {
				type	 		: 'json',
				writeAllFields	: true,
				allowSingle	 	: true,
				encode	 		: true,
				root	 		: 'row'
			}
		},
		autoLoad: false
	});
	
	// ****************************************************************************
	// Structure, data for List Select list
	// AJAX -> component_data.ejs.php
	// ****************************************************************************
	var editListModel = Ext.define("editListModel", {extend: "Ext.data.Model", fields: [
		{name: 'option_id', type: 'string'},
	    {name: 'title', type: 'string'}
	],
		idProperty: 'option_id',
	});
	var storeEditList = new Ext.data.Store({
		model		: 'editListModel',
		proxy		: {
			type	: 'ajax',
			api		: {
				read	: 'interface/administration/lists/component_data.ejs.php?task=editlist',
				create	: 'interface/administration/lists/component_data.ejs.php?task=editlist',
				update	: 'interface/administration/lists/component_data.ejs.php?task=editlist',
				destroy	: 'interface/administration/lists/component_data.ejs.php?task=editlist',
			},
	        reader: {
	            type			: 'json',
	            idProperty		: 'option_id',
	            totalProperty	: 'totals',
	            root			: 'row'
	    	},
	    	writer: {
				type	 		: 'json',
				writeAllFields	: true,
				allowSingle	 	: true,
				encode	 		: true,
				root	 		: 'row'
			}
		},
		autoLoad: true
	});
	//--------------------------
	// When the data is loaded
	// Select the first record
	//--------------------------
	storeEditList.on('load',function(ds,records,o){
		if (!currList){
			Ext.getCmp('cmbList').setValue(records[0].data.option_id);
			currList = records[0].data.option_id; 					// Get first result for first grid data
			storeListsOption.load({params:{list_id: currList}}); 	// Filter the data store from the currList value
		} else {
			Ext.getCmp('cmbList').setValue( currList );
			storeListsOption.load({params:{list_id: currList }});
		}
	});
	
	// *************************************************************************************
	// List Create Form
	// Create or Closse purpose
	// *************************************************************************************
	var frmLists = Ext.create('Ext.form.Panel', {
		id			: 'frmLists',
		autoWidth	: true,
		border		: false,
		bodyStyle	: 'padding: 5px',
		defaults	: { labelWidth: 100, anchor: '100%' },
		items:[
			{ 
				xtype: 'textfield', 
				width: 200, 
				id: 'option_id', 
				name: 'option_id', 
				allowBlank: false,
				fieldLabel: '<?php i18n('Unique name'); ?>' 
			},
			{ 
				xtype: 'textfield', 
				width: 200, 
				id: 'list_name', 
				name: 'list_name',
				allowBlank: false, 
				fieldLabel: '<?php i18n('List Name'); ?>' 
			}
	    ]
	});
	
	// *************************************************************************************
	// Create list Window Dialog
	// *************************************************************************************
	var winLists = Ext.create('widget.window', {
		id			: 'winList',
		width		: 400,
		autoHeight	: true,
		modal		: true,
		resizable	: false,
		autoScroll	: false,
		title		: '<?php i18n('Create List'); ?>',
		closeAction	: 'hide',
		renderTo	: document.body,
		items: [ frmLists ],
		// -----------------------------------------
		// Window Bottom Bar
		// -----------------------------------------
		bbar:[{
			text		:'<?php i18n('Create'); ?>',
			name		: 'cmdSave',
			id			: 'cmdSave',
			iconCls		: 'save',
			handler		: function() { 
            	var form = Ext.getCmp('frmLists').getForm();
            	if(form.isValid()){
                	form.submit({
                    	url: 'interface/administration/lists/component_data.ejs.php?task=c_list',
                    	timeout: 1800000, // 30 minutes to timeout.
	                    waitMsg: '<?php i18n("Saving new list..."); ?>',
	                    waitTitle: '<?php i18n("Processing..."); ?>',
						failure: function(form, action){
							obj = Ext.JSON.decode(action.response.responseText); 
        	                Ext.Msg.alert('<?php i18n("Failed"); ?>', obj.errors.reason);
        	                Ext.getCmp('frmLists').getForm().reset();
						},
    	                success: function(form, action) {
    	                	storeEditList.sync();
    	                	storeEditList.load();
    	                	currList = Ext.getCmp('option_id').getValue();
    	                	Ext.getCmp('frmLists').getForm().reset();
            	        }
                	});
            	}
				winLists.hide(); 
			} 
		},'-',{
			text		: '<?php i18n('Close'); ?>',
			name		: 'cmdClose',
			id			: 'cmdClose',
			iconCls		: 'delete',
			handler		: function(){ winLists.hide(); }
		}]
	}); // END WINDOW
	
	// *************************************************************************************
	// RowEditor Class
	// *************************************************************************************
	var editor = Ext.create('Ext.grid.plugin.RowEditing', {
		autoCancel: false,
		errorSummary: false,
		listeners:{
			afteredit: function(){
				storeListsOption.sync();
				storeListsOption.load();
			}
		}
	});
	
	// *************************************************************************************
	// Create the GridPanel
	// *************************************************************************************
	var listGrid = new Ext.create('Ext.grid.Panel', {
		id			: 'listGrid',
		store		: storeListsOption,
		layout		: 'fit',
        columnLines	: true,
		border		: false, 
		frame	  	: false,
		height		: Ext.getCmp('MainApp').getHeight(),
		plugins		: [editor],
		columns: [{ 	
			width: 100, 
			text: 'ID', 
			sortable: true, 
			dataIndex: 'option_id',
            field: {
                xtype: 'textfield',
                allowBlank: false
            }
		},{ 
			width: 175, 
			text: '<?php i18n('Title'); ?>', 
			sortable: true, 
			dataIndex: 'title',
            field: {
                xtype: 'textfield',
                allowBlank: false
            }
		},{ 
			text: '<?php i18n('Order'); ?>', 
			sortable: true, 
			dataIndex: 'seq',
			field: {
                xtype: 'textfield',
                allowBlank: false
            }
		},{ 
			text: '<?php i18n('Default'); ?>', 
			sortable: true, 
			dataIndex: 'is_default',
            field: {
                xtype: 'checkbox',
                allowBlank: false
            } 
		},{ 
			text: '<?php i18n('Notes'); ?>', 
			sortable: true, 
			dataIndex: 'notes',
			flex: 1,
            field: {
                xtype: 'textfield',
                allowBlank: true
            } 
		}],
		listeners:{
			itemclick: function(DataView, record, item, rowIndex, e){ 
				currRec = storeListsOption.getAt(rowIndex); // Copy the record to the global variable
			}
		},
		// -----------------------------------------
		// Grid Top Menu
		// -----------------------------------------
		dockedItems: [{
			xtype	: 'toolbar',
			dock	: 'top',
			items: [{
				xtype	:'button',
				id		: 'addList',
				text	: '<?php i18n('Create a list'); ?>',
				iconCls	: 'icoListOptions',
				handler: function(){
					editor.cancelEdit();
					Ext.getCmp('frmLists').getForm().reset(); // Clear the form
					winLists.show();
				}
			},'-',{
				id			  	: 'delList',
				text		  	: '<?php i18n('Delete list'); ?>',
				iconCls			: 'delete',
				handler: function(){
					editor.cancelEdit();
					
				}
			},'-','<?php i18n('Select list'); ?>: ',{
				name			: 'cmbList', 
				width			: 250,
				xtype			: 'combo',
				displayField	: 'title',
				id				: 'cmbList',
				mode			: 'local',
				triggerAction	: 'all', 
				hiddenName		: 'option_id',
				valueField		: 'option_id',
				iconCls			: 'icoListOptions',
				editable		: false,
				store			: storeEditList,
				handler: function(){
					editor.cancelEdit();
				},
				listeners: {
					select: function(combo, record){
						// Reload the data store to reflect the new selected list filter
						storeListsOption.load({params:{list_id: record[0].data.option_id }});
					}
				}
			}]
		},{
			xtype	: 'toolbar',
			dock	: 'bottom',
			items:[{
				// Add a new record.
				text		:'<?php i18n('Add record'); ?>',
				iconCls		: 'icoAddRecord',
				handler: function() {
					editor.cancelEdit();
					var rec = new ListRecord();
					rec.set('list_id', Ext.getCmp('cmbList').value);
					storeListsOption.add( rec );
					editor.startEditing( storeListsOption.getTotalCount() );
				}
			},'-',{
				// Delete the selected record.
				text:'<?php i18n('Delete record'); ?>',
				iconCls: 'delete',
				handler: function(){ 
					Ext.Msg.show({
						title: '<?php i18n('Please confirm...'); ?>', 
						icon: Ext.MessageBox.QUESTION,
						msg:'<?php i18n('Are you sure to delete this record?<br>From: '); ?>',
						buttons: Ext.Msg.YESNO,
						fn:function(btn,msgGrid){
							if(btn=='yes'){
								editor.cancelEdit();
								storeListsOption.remove( currRec );
								storeListsOption.sync();
								storeListsOption.load();
				    	    }
						}
					});
				}
			}]
		}], // END GRID TOP MENU
	}); // END GRID


	//******************************************************************************
	// Render panel
	//******************************************************************************
	var topRenderPanel = Ext.create('Ext.panel.Panel', {
		title		: '<?php i18n('List Options'); ?>',
		renderTo	: Ext.getCmp('MainApp').body,
		layout		: 'fit',
		height		: Ext.getCmp('MainApp').getHeight(),
	  	frame 		: false,
		border 		: false,
		id			: 'topRenderPanel',
		items		: [	listGrid ]
	});

}); // End ExtJS

</script>