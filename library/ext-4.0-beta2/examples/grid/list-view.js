Ext.require([
    'Ext.grid.*',
    'Ext.data.*',
    'Ext.panel.*'
]);
Ext.onReady(function(){
    Ext.regModel('Image_', { // window.Image is protected in ie6 !!!
        fields: ['name', 'url', {name:'size', type: 'float'}, {name:'lastmod', type:'date', dateFormat:'timestamp'}]
    });    
    var store = new Ext.data.JsonStore({
        model: 'Image_',
        proxy: {
            type: 'ajax',
            url: 'get-images.php',
            reader: {
                type: 'json',
                root: 'images'
            }
        }
    });
    store.load();

    var listView = new Ext.grid.GridPanel({
        width:425,
        height:250,
        collapsible:true,
        title:'Simple ListView <i>(0 items selected)</i>',
        renderTo: Ext.getBody(),

        store: store,
        multiSelect: true,
        viewConfig: {
            emptyText: 'No images to display'
        },

        columns: [{
            text: 'File',
            flex: 50,
            dataIndex: 'name'
        },{
            text: 'Last Modified',
            xtype: 'datecolumn',
            format: 'm-d h:i a',
            flex: 35, 
            dataIndex: 'lastmod'
        },{
            text: 'Size',
            dataIndex: 'size',
            tpl: '{size:fileSize}',
            align: 'right',
            flex: 15,
            cls: 'listview-filesize'
        }]
    });
    
    // little bit of feedback
    listView.on('selectionchange', function(view, nodes){
        var l = nodes.length;
        var s = l != 1 ? 's' : '';
        listView.setTitle('Simple ListView <i>('+l+' item'+s+' selected)</i>');
    });
});