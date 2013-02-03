var ChatsView = Jr.View.extend({
	initialize: function(){
        //inicializamos el modelo y sincronizamos.
        this.chats = new Chats();
        this.chats.fetch();
        this.contacts = new Contacts();
        this.contacts.fetch();
        this.chats.on('add reset', this.render, this);
        this.contacts.on('add reset', this.render, this);
	},
     render: function(){
      //template
      var template = tpl.get('Chats');
      this.$el.html(_.template(template));
      var self = this;

      //renderizamos cada fila
      this.chats.each(function(chat){
        var contacts = self.contacts.where({sid:chat.attributes.targetId});
        if((contacts == undefined) || (contacts.length == 0)){
          var contact = new Contact({
            id:chat.attributes.targetId
          });
        }else{
          contact = contacts[0];
        }
        var params = {
          chat: chat,
          contact: contact
        }
        $(self.el).find("ul.list").append(new ChatsListItemView(params).render().el);
        
      });
        
      return this;
    }
});

var ChatsListItemView = Jr.View.extend({
    tagName:"li",
    initialize:function (options) {
      this.chat = options.chat;
      this.contact = options.contact;
        //si cambia el chat, renderizamos otra vez
        this.chat.bind("change", this.render, this);
    },
  
    render:function () {
    	templ = _.template(tpl.get('ChatsListItem'));
        var attributes = {
          chat: this.chat.attributes,
          contact: this.contact.attributes,
        }
        this.$el.html(templ(attributes));
        return this;
    }

});