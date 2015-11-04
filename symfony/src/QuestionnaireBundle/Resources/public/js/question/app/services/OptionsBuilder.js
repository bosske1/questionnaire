Question.Services.OptionsBuilder = {

    /**
     * build and return options string <option value="model.get('id')">model.get('name')</option>
     *
     * @param collectionName string
     * @param opts Object
     *
     * @returns string
     */
    getSingleSelectOptionsString: function(collectionName, opts){
        var optionsString = '',
            selectedValue = '';

        if(typeof opts == 'undefined' && typeof opts.success == 'undefined'){
            console.error('opts.success method must be assigned');
            return false;
        }

        if(typeof opts != 'undefined' && opts.value != '' && opts.value != null){
            selectedValue = opts.value;
        }

        Question.getService('CollectionDataContainer').get(collectionName, {
            success: function(collection, response){
                collection.each(function(model){
                    if(model.get('id') == selectedValue){
                        optionsString += '<option selected value='+model.get("id")+'>'+model.get("name")+'</option>';
                    }else{
                        optionsString += '<option value='+model.get("id")+'>'+model.get("name")+'</option>';
                    }
                });

                return opts.success(optionsString);
            },
            failure: function(collection, response){
                if(typeof opts.failure != 'undefined'){
                    return opts.failure(collection, response);
                }
            }
        });
    }
};