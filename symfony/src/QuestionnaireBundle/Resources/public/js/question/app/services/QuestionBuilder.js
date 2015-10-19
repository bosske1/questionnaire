Question.Services.QuestionBuilder = {

    defaultViewType : 'Input',

    /**
     * build and return Question View class based on type
     *
     * @param classType
     * @returns {Question.Views.Question[viewType]}
     */
    get: function(classType){
        viewClass = this.buildViewClass(classType);

        return new Question.Views[viewClass]();
    },

    buildViewClass: function(classType){
        var viewClass = null;

        if(typeof classType != 'undefined' && classType != '' && classType != null){
            viewClass = 'Question' + this.capitalizeFirstLetter(classType);
        }else{
            viewClass = 'Question' + this.defaultViewType;
        }

        return viewClass;
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