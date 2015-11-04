/**
 * CollectionDataContainer, cool name :S
 *
 * Mainly used for collections inside select input types
 *
 * First time data will be asked via ajax and then it will be cached for performance purposes
 */
Question.Services.CollectionDataContainer = {

    collectionContainer: {
        //QuestionnaireCategory collection for example
    },

    /**
     *  get and cache collection
     *
     * @param collectionName
     * @param opts
     */
    get: function(collectionName, opts){
        var me = this,
            collectionClass = this.buildCollectionClass(collectionName);

        if(typeof opts == 'undefined' && opts.success == 'undefined'){
            console.error('opts.success method must be assigned');
            return false;
        }

        if(this.collectionContainer[collectionName]){
            return opts.success(this.collectionContainer[collectionName]);
        }

        var collection = new Question.Collections[collectionClass]();

        if(opts.url != null && opts.url != ''){
            collection.url = url;
        }

        collection.fetch({
            data: opts.additionalFilters,
            async: false,
            reset: true,
            success: function(collection, response){
                //now cache collection for future
                me.collectionContainer[collectionName] = collection;

                return opts.success(collection, response);
            },
            failure: function(collection, response){
                //initialize callback if asked
                if(typeof opts.failure != 'undefined'){
                    return opts.failure(collection, response);
                }
            }
        });
    },

    /**
     * clear cached collection
     *
     * @param collectionName
     */
    clear: function(collectionName){
        this.collectionContainer[collectionName] = null;

        return this;
    },

    buildCollectionClass: function(className){
        var collectionClassName = null,
            collectionClassName= this.capitalizeFirstLetter(className);

        return collectionClassName;
    },

    /**
     * well, shouldn't be here but better not touch prototype of the String
     *
     * @param string
     * @returns {string}
     */
    capitalizeFirstLetter: function(string){
        return string.charAt(0).toUpperCase() + string.slice(1);
    }
};