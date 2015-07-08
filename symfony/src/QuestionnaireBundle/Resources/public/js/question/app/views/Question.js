Question.Views.Question = Backbone.View.extend({

    initialize: function() {
        console.log('flsd');
        this.template= _.template($('#tpl-question').html());
    },

    render: function() {
        var html = this.template();
        this.$el.html(html);

        return this;
    }
});