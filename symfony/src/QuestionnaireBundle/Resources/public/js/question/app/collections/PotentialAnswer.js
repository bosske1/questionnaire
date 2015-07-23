Question.Collections.PotentialAnswer = Backbone.Collection.extend({
    model: Question.Models.PotentialAnswer,
    url: '/question/getPotentialAnswers'
});