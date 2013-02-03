var ContactsView = Jr.View.extend({
    initialize:function () {
        this.contacts = new Contacts();
        this.contacts.fetch();
        this.contacts.on('add reset', this.render, this);
    },
     render: function(){
      var template = tpl.get('Contacts');
      this.$el.html(_.template(template));
      var self = this;
      this.contacts.each(function(contact){
        $(self.el).find("ul.list").append(new ContactsListItemView({model:contact}).render().el);
        
      });
        
      return this;
    }
});

var ContactsListItemView = Jr.View.extend({
    tagName:"li",
    initialize:function () {
        //console.log(this.model)
        this.model.bind("change", this.render, this);
       // this.model.bind("destroy", this.close, this);
    },
    render:function () {
    	templ = _.template(tpl.get('ContactsListItem'));
      this.$el.html(templ(this.model.attributes));
      return this;
    }

});