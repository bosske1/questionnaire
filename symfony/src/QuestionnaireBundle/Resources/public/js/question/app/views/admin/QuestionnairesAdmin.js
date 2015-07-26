Question.Views.QuestionnairesAdmin = Backbone.View.extend({

    question     : {},
    errorMessage : null,
    timeLimit    : 30,
    timeLimitReached : false,

    events: {
        'click #nextQuestionBtn' : 'getQuestion'
    },

    render: function(question) {
        var html = this.template({question:question.question});
        this.$el.html(html);

        this.startCountdown(this.timeLimit);

        return this;
    },

    getQuestion: function(){
        var nextQuestionId = this.question.nextQuestionId,
            router = new Question.Router;

        if(!this.isValid()){
            console.log(this.errorMessage); // alert or something
            return false;
        }

        if(this.timeLimitReached){
            //time limit was reached before answering
        }

        router.question(nextQuestionId);
    },

    isValid: function(){
        return true;
    },

    startCountdown: function(duration){
        var timer = duration;

        countdownInterval = setInterval(function () {
            if (--timer < 0) {
                timer = duration;
            }

            if(timer == 0){
                this.timeLimitReached = true;

                clearInterval(countdownInterval);
            }

        }, 1000);
    }
});