Question.Views.Question = Backbone.View.extend({

    question     : {},
    errorMessage : null,
    timeLimit    : 30,
    timeLimitReached : false,

    events: {
        'click #nextQuestionBtn' : 'getQuestion'
    },

    render: function(question) {
        this.question = question.question;
        var html = this.template({question:question.question});

        this.$el.html(html);

        return this;
    },

    getTickLength: function() {
        var timeLimit = this.question.tickLength;

        if (isNaN(timeLimit) || timeLimit == 0) {
            timeLimit = this.timeLimit;
        }

        return timeLimit;
    },

    postRender: function() {

    },

    getQuestion: function(){
        var nextQuestionId = this.getNextQuestionId(),
            router = new Question.Router;

        this.submitAnswer();



        if(!this.isValid()){
            this.showErrorMessage();
            return false;
        }

        router.navigate('question/' + nextQuestionId, {trigger: true});

        //router.question(nextQuestionId);
    },

    submitAnswer: function() {
        //basically does nothing, should be overwritten in the child classes...
    },

    getNextQuestionId: function() {
        // Can be overwritten if needed:
        return this.question.nextQuestionId;
    },

    isValid: function(){
        return true;
    },

    setTimeLimitReached: function(isReached){
        this.timeLimitReached = isReached;

        return this;
    },

    getTimeLimitReached: function(){
        return this.timeLimitReached;
    },

    setErrorMessage: function(message){
        this.errorMessage = message;

        return this;
    },

    getErrorMessage: function(){
        return this.errorMessage;
    },

    showErrorMessage: function(){
        this.getErrorMessageContainer().text(this.getErrorMessage());

        return this;
    },

    getErrorMessageContainer: function(){
        return this.$('#error-message-container');
    },

    getProgressBar: function(){
        return this.$('#progress-bar');
    },

    setProgressBarValue: function(val){
        this.getProgressBar().css('width', val + '%');
    }
});