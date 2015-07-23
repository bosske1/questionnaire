window.question = {
    Models: {},
    Collections: {},
    Views: {},
    Routers: {},
    js: [
        'app/app.js',
        'app/router.js',
        'app/models/QuestionInput.js',
        'app/collections/QuestionInput.js',
        'app/views/questions/Question.js',
        'app/views/questions/QuestionInput.js',
        'app/views/questions/QuestionRadio.js',
        'app/views/questions/QuestionCheckbox.js',
        'app/views/Home.js',
        'app/views/Login.js',
        'app/views/Registration.js'
    ],
    init: function() {

        Question.start();
    }
};

$(document).ready(function(){
    question.init();
});