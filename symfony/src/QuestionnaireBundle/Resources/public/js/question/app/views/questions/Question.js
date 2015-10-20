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

        var timeLimit = this.question.tickLength;

        if (isNaN(timeLimit) || timeLimit == 0) {
            timeLimit = this.timeLimit;
        }


        this.startCountdown(timeLimit);

        return this;
    },

    postRender: function() {

    },

    getQuestion: function(){
        var nextQuestionId = this.question.nextQuestionId,
            router = new Question.Router;

        if(this.getTimeLimitReached()){
            //time limit was reached before answering
            this.setErrorMessage('time limit reached before answering').showErrorMessage();
            return false;
        }

        this.submitAnswer();



        if(!this.isValid()){
            this.showErrorMessage();
            return false;
        }

        router.question(nextQuestionId);
    },

    submitAnswer: function() {
        //basically does nothing, should be overwritten in the child classes...
    },

    isValid: function(){
        return true;
    },

    startCountdown: function(duration){
        var me = this,
            timer = duration;

        countdownInterval = setInterval(function () {
            if (--timer < 0) {
                timer = duration;
            }

            var secondsLeft = me.timeLimit - timer;
            var progressBarValue = secondsLeft * 100 / me.timeLimit;
            me.setProgressBarValue(progressBarValue);

            if(timer == 0){
                me.setTimeLimitReached(true);

                clearInterval(countdownInterval);
            }

        }, 1000);
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