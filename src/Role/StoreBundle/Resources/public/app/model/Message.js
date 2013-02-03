var Message = Backbone.Model.extend({

})

var Messages = Backbone.Collection.extend({
    model: Message,
    createLocalMessage: function(data){
      var message  = new Message(data);
      Offline.localSync("create",message,{success:function(){
        //message saved, you can do callback
        //app.chatView.render();
      }},this.storage);
    },
    initialize: function(models,options){
      if(options){
        this.chat_id = options.chatid;
      }
       this.storage = new Offline.Storage('messages',this)
    },
    url: function(){
      var param = 'api/messenger/messages';
      return server(param);
    }
    ,
sync: function(method, model, options){  
    options.timeout = 10000;  
    options.dataType = "jsonp";  
    options.data = { 'token':window.auth_token, _method:method }
    return Offline.sync(method, model, options);  
  }   
});
