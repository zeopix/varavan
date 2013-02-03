var Chat = Backbone.Model.extend({
    urlRoot: function() {
    return server('api/messenger/chats');
    },
})

var Chats = Backbone.Collection.extend({
    model: Chat,
    url: function() {
    return server('api/messenger/chats');
    },
    initialize: function(){
        this.storage = new Offline.Storage('chats',this)
    },
    updateChat: function(id,callback){
        var total = app.messages.length;
        last= app.messages.at(total-1);
        console.log(last);
        if(!last){
            lastId = 0;
        }else{
            lastId = last.attributes.created_at;
        }
        options = {
            timeout : 10000,
            type : "GET",
            dataType: "JSONP",
            url: server('api/messenger/chats'),
            contentType : "application/json",
            data : { 'token': window.auth_token, _method:"sync", chat:id, last: lastId},
            success : function(response){
                console.log(response);
                _.each(response,function(data){
                  app.messages.createLocalMessage(data);  
                })
            }
        };
        $.ajax(options);
    },
  sync: function(method, model, options){  
    options.timeout = 10000;  
    options.dataType = "jsonp";  
    options.type="GET";
    options.contentType="application/json";
    options.data = { 'token': window.auth_token, _method:method, _model: model.toJSON()};
    return Offline.sync(method, model, options);  
  }  
});
