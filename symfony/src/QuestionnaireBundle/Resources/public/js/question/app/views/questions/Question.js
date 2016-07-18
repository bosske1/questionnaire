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

    initTimer: function() {
        var tickLength = this.getTickLength();
        setTimeout(function() {
            $('#footer_options_row').show();
            initTimer(tickLength);
        }, 30000);
    },

    enableNext: function() {
        if ($('#nextQuestionBtn').hasClass('disabled_button')) {
            $('#nextQuestionBtn').toggleClass('disabled_button button');
        }
    },

    postRender: function() {

    },

    getQuestion: function(){
        var nextQuestionId = this.getNextQuestionId(),
            router = new Question.Router;

        if(!this.isValid()){
            this.showErrorMessage();
            return false;
        } else {
            this.submitAnswer();

            router.navigate('question/' + nextQuestionId, {trigger: true});
        }
    },

	/**
     *
     */
    submitAnswer: function() {
        if (this.isValid()) {
            var answer = this.getValue();

            $.post('/question/submitAnswer', {questionId: this.question.id, answer: answer, type: this.type});
        }
    },

    getValue: function() {
        return '';
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