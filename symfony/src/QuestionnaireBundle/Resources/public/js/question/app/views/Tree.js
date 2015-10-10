Question.Views.Tree = Backbone.View.extend({

    events: {
        'change .node-checkbox': 'onNodeCheck',

        'click .getSelected': 'getSelected'
    },

    initialize: function() {
        this.template= _.template($('#tpl-tree').html());
    },

    render: function() {
        var me = this,
            templateFn = this.template= _.template($('#tpl-tree').html());

        $(me.el).html(templateFn({items: me.collection, templateFn: me.template}));

        return this;
    },

    onNodeCheck: function(e){
        var element = e.currentTarget,
            mainNodeId = $(element).data('main-node-id'),
            parentNodeId = $(element).data('parent-node-id'),
            nodeId = element.defaultValue,
            checked = element.checked;

        if(mainNodeId == null){
            mainNodeId = nodeId;
        }

        nodeModel = this.collection.findByNodeId(nodeId).set('checked', checked);
    },

    onSelectAll: function(){
        var checkboxes = this.$el.find(':checkbox').not(":disabled");
        checkboxes.prop('checked', true);
        this.collection.selectAll();

        console.log(this.collection);
    },

    onDeselectAll: function(){
        var checkboxes = this.$el.find(':checkbox').not(":disabled");
        checkboxes.prop('checked', false);
        this.collection.deselectAll();
    },

    getSelected: function(){
        this.collection.getSelected();
    }
});