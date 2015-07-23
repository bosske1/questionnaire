Question.Collections.Attachment = Backbone.Collection.extend({
    model: Question.Models.Attachment,
    url: '/question/getAttachments'
});