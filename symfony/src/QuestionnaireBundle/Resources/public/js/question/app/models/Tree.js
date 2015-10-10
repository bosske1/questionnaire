Question.Models.Tree = Backbone.Model.extend({
    defaults: {
        id: null,
        name: null,
        _parent_id: null,
        _main_node_id: null,
        checked: false,
        expanded: true,
        disabled: false,
        items: []
    },

    mainParentId: null,

    initialize: function() {
        var me = this;
        if (Array.isArray(this.get('items'))) {
            var nestedCollection = new Question.Collections.Tree(this.get('items'));
            this.set({items: nestedCollection});

            this.get('items').each(function(nestedModel){
                nestedModel.set('_parent_id', me.get('id'));
            });
        }
    },

    getParent: function(){
        return this.collection.findByNodeId(this.get('_parent_id'));
    },

    getChildren: function(){
        return this.get('items');
    }
});