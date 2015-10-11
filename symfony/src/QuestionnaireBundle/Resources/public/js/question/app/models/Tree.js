Question.Models.Tree = Backbone.Model.extend({
    defaults: {
        id: null,
        name: null,
        _parent_id: null,
        _parent_collection: null,
        _main_node_id: null,
        checked: false,
        expanded: true,
        disabled: false,
        items: []
    },

    initialize: function() {
        var me = this;
        if (Array.isArray(this.get('items'))) {
            var nestedCollection = new Question.Collections.Tree(this.get('items'));
            this.set({items: nestedCollection});

            this.get('items').each(function(nestedModel){
                nestedModel.set('_parent_id', me.get('id'));
                nestedModel.set('_parent_collection', me.collection);
                nestedModel.set('_parent_model', me);
            });
        }
    },

    getParent: function(){
        if(this.get('_parent_model')){
            return this.get('_parent_model');
        }
    },

    getChildren: function(){
        return this.get('items');
    },

    getSelectedChildren: function(){
        if(this.get('items')){
            return this.collection.getSelectedChildren(this.get('items'));
        }
    }
});