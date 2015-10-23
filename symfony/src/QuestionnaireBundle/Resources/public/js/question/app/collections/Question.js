Question.Collections.Question = Backbone.Collection.extend({
    model: Question.Models.Question,
    questionnaireId: null,
    url: '/questions/get',
    getQuestionsUrl : function(questionnaireId){
        return '/questions/get/' + questionnaireId;
    }
});