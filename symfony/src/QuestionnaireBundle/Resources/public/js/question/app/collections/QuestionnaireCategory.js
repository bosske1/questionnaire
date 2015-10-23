Question.Collections.QuestionnaireCategory = Backbone.Collection.extend({
    model: Question.Models.QuestionnaireCategory,
    url: '/questionnaire_categories/getQuestionnaireCategories'
});