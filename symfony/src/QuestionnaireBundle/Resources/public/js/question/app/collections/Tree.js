Question.Collections.Tree = Backbone.Collection.extend({
    model: Question.Models.Tree,
    url: '/question/getTree',

    selected: [],
    selectedIds: [],

    /**
     * recursive function used to get model from collection based on 'id'
     *
     * @param nodeId
     * @param _collection
     */
    findByNodeId: function(nodeId, _collection){
        var me = this,
            result = null;

        if(_collection == null){
            collection = me;
        } else {
            collection = _collection;
        }

        collection.find(function(model){
            if(model.get('id') == nodeId){
                result = model;

                return model;
            }
        });

        if(result == null){
            collection.find(function(childModel){
                result = collection.findByNodeId(nodeId, childModel.get('items'));

                if(result != null){
                    return result;
                }
            });
        }

        return result;
    },

    /**
     * set every record to checked except disabled ones
     *
     * @param _collection
     */
    selectAll: function(_collection){
        var me = this,
            result = null;

        if(_collection == null){
            collection = me;
        } else {
            collection = _collection;
        }

        collection.find(function(model){
            if(!model.get('disabled')){
                model.set('checked', true);
            }

            me.selectAll(model.get('items'));
        });
    },

    /**
     * set every record to unchecked except disabled ones
     *
     * @param _collection
     */
    deselectAll: function(_collection){
        var me = this,
            result = null;

        if(_collection == null){
            collection = me;
        } else {
            collection = _collection;
        }

        collection.find(function(model){
            if(!model.get('disabled')){
                model.set('checked', false);
            }

            me.deselectAll(model.get('items'));
        });
    },

    getSelected: function(_collection){
        //i am so smart, i am so smart... S-M-R-T, i mean S-M-A-R-T
        this.selected = [];
        this.selectedIds = [];
        this._getSelected();

        return this.selected;
    },

    _getSelected: function(_collection){
        var me = this,
            result = null;

        if(_collection == null){
            collection = me;
        } else {
            collection = _collection;
        }

        collection.find(function(model){
            if($.inArray(model.get('id'), me.selectedIds) == -1 && model.get('checked')){
                me.selected.push(model);
                me.selectedIds.push(model.get('id'));
            }

            if(model.get('items') != null){
                me._getSelected(model.get('items'));
            }
        });
    },

    getSelection: function(){
        this.selected = [];
        this.selectedIds = [];

        return this;
    },

    /**
     * get all nodes, subnodes, subsubnodes checked models
     *
     * @param model.get('items') collection
     */
    getSelectedChildren: function(collection){
        return this.getSelected(collection);
    }
});