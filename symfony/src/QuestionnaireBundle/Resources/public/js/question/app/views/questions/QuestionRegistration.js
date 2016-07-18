Question.Views.QuestionRegistration = Question.Views.Question.extend({

    type: 'registration',
    errorMessage: null,

    initialize: function() {
        this.template= _.template($('#tpl-question-registration').html());
    },

    isValid: function(){
        // Let's run a mandatory check:

        var emptyFields = $('.mandatory').filter(function() {
            return $(this).val() == "" || $(this).val() == null;
        });

        return emptyFields;
    },

    postRender: function() {
        initRegistration();
    },

    getQuestion: function(){
        var nextQuestionId = this.getNextQuestionId(),
            router = new Question.Router;

        if (this.submitAnswer()) {
            router.navigate('question/' + nextQuestionId, {trigger: true});
        }
    },

    submitAnswer: function() {
        var me = this;
        var invalidFields = this.isValid();
        if (invalidFields.length == 0) {
            //basically does nothing, should be overwritten in the child classes...
            var data = {
                email: this.$('#email').val(),
                mobile: this.$('#mobile').val(),
                phone: this.$('#phone').val(),
                country: this.$('#country').val(),
                postal_code: this.$('#postal_code').val(),
                town: this.$('#town').val(),
                address: this.$('#address').val(),
                birthday: this.$('#birthday').val(),
                lastname: this.$('#lastname').val(),
                further_name: this.$('#further_name').val(),
                firstname: this.$('#firstname').val(),
                title: this.$('#title').val(),
                salutation: this.$('#salutation').val(),
                order_analysis: this.$("input:radio[name ='order_analysis']:checked").val(),
                results_use: this.$('#results_use').is(':checked') ? 1 : 0,
                costs_onme: this.$('#costs_onme').is(':checked') ? 1 : 0
            };

            $.post('/registration/submitRegistration', {questionId: this.question.id, answer: data, type: this.type});

            return true;
        } else {
            $.each(invalidFields, function(index, field) {
                me.$("label[for ='" + field.id + "']").css('color', 'red');
            });

            return false;
        }

    }
});