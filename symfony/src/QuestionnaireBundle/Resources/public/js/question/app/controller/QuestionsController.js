function QuestionsController() {
    this.eventManager = window.Question.eventManager;
};

QuestionsController.prototype.bindEvents = function() {
    window.Question.eventManager.on('question:edit', this.openEditView);
};

QuestionsController.prototype.openEditView = function(model) {
    var editView = new Question.Views.AddView();
    $('#question').html(editView.render().$el);
};