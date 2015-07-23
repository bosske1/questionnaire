Question.Models.Attachment = Backbone.Model.extend({
    defaults: {
        id: null,
        questionId: null,
        title: null,
        description: null,
        path: null
    },

    initialize: function() {
    }
});