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
     * @param url
     * @param additionalFilters
     * @param opts
     */
    get: function(collectionName, url, additionalFilter, opts){
        var me = this,
            collectionClass = this.buildCollectionClass(collectionName);

        if(this.collectionContainer[collectionName]){
            return this.collectionContainer[collectionName];
        }

        var collection = new Question.Collections[collectionClass]();

        if(url != null && url != ''){
            collection.url = url;
        }

        collection.fetch({
            data: additionalFilters,
            success: function(collection){
                //now cache collection for future
                me.collectionContainer[collectionName] = collection;

                //initialize callback if asked
                if(opts.success){
                    return opts.succes;
                }
            },
            failure: function(){

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