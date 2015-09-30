Question.Models.Questionnaire = Backbone.Model.extend({
    defaults: {
        id: null,
        name: null,
        description: null,
        categoryId: null,
        category: null
    },

    initialize: function() {

    }
});