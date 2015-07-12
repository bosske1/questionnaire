Question.Collections.Question = Backbone.Collection.extend({
    model: Question.Models.Question,
    url: '/question/get'
});