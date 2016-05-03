Question.Models.PotentialAnswer = Backbone.Model.extend({
    defaults: {
        id: null,
        questionId: null,
        answer: null,
        realAnswer: null
    },

    initialize: function() {
    }
});