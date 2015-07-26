Question.Collections.Question = Backbone.Collection.extend({
    model: Question.Models.Question,
    questionnaireId: null,
    url: '/question/getQuestionnaire',
    setQuestionnaireId: function(questionnaireId) {
        this.questionnaireId = questionnaireId;

        this.url += "/" + questionnaireId;
    }
});