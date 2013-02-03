var SettingsView = Jr.View.extend({
    render: function(){
      var template = _.template(tpl.get('Settings'));
      if(!localStorage.me){
      	user = {
      		name: "Error retriving data..."
      	}
      }else{
      	var user = JSON.parse(localStorage.me);	
      }
      
      var content = template({me:user});
      this.$el.html(_.template(content));
      return this;
    },
    goLogout: function(){
    	window.localStorage.clear();
    	window.location="/";
    }
    ,
    events: {
	    "click a.logout"      : "goLogout",
	    "click .bar-tab li.chats"      : "goChats",
	    "click .bar-tab li.contacts"   : "goContacts",
	    "click .bar-tab li.settings"   : "goSettings",
	},
	goChats : function() {
		Jr.Navigator.navigate('chats',{trigger: true});
	},
	goContacts : function() {
		Jr.Navigator.navigate('contacts',{trigger: true});
	},
	goSettings : function() {
		Jr.Navigator.navigate('settings',{trigger: true});
	}
});
