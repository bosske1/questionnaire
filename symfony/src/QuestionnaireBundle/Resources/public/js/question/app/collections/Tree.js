Question.Collections.Tree = Backbone.Collection.extend({
    model: Question.Models.Tree,
    url: '/question/getTree',

    selected: [],

    /**
     * recursive function used to get model from collection based on 'id'
     *
     * @param nodeId
     * @param _mainNodeId
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
     * set every record to checked
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
        //still brainstorming
    }
});