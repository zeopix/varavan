var Contact = Backbone.Model.extend({
    idAttribute: "id"
})

var Contacts = Backbone.Collection.extend({
    model: Contact,
    url: server('api/messenger/contacts'),
    initialize: function(){
       this.storage = new Offline.Storage('contacts',this)
    },

  sync: function(method, model, options){  
    options.timeout = 10000;  
    options.dataType = "jsonp";  
    options.data = { 'token':window.auth_token }
    return Offline.sync(method, model, options);  
  }  
});
