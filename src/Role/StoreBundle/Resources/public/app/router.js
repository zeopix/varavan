var AppRouter = Jr.Router.extend({
    routes: {
      '': 'login',
      'login': 'login',
      'chats': 'chats',
      'chat/:user': 'chat',
      'contacts': 'contacts',
      'settings': 'settings',
    },

    login: function(){
      var loginView = new LoginView();
      this.renderView(loginView);
    },

    chats: function(){
      var chatsView = new ChatsView();
      this.renderView(chatsView);
    },

    contacts: function(){
      var contactsView = new ContactsView();
      this.renderView(contactsView);
    },

    settings: function(){
      var settingsView = new SettingsView();
      this.renderView(settingsView);
    },
    chat: function(user){
        //bufff... hacky
        //para q el socket nos oiga, hacemos este pequeño codigo
        //(deberia ser un controlador independiente)
        this.socket = io.connect(_socket_server);
        var chatView = new ChatView({userId:user,socket:this.socket});
        this.chatView = chatView;
        this.messages = new Messages();
        this.messages.on('add reset',chatView.render,chatView);
        this.socket.on('registered', chatView.onSocketRegister);
        this.socket.on('message sent', chatView.onMessageSent);
        chatView.messages = this.messages;
        chatView.messages.fetch({local:true});

        this.renderView(chatView);
    }

});
   

$(document).ready(function () {
    //cargamos las templates
    tpl.loadTemplates(["Login","Chats","ChatsListItem","Chat","ChatMessage","Contacts","Settings","ContactsListItem"],
        function () {
            app = new AppRouter();
            Backbone.history.start();
            
        });

        //TODO:notificar errores, redirigir a la autentificación
        //preparamos un mini "firewall" para gestionar las peticiones =/ 200
        $.ajaxSetup({
          statusCode: {
            401: function(){
            // Redirec the to the login page.
            alert("you have to login")
              window.location.replace('/');
         
          },
          403: function() {
            // 403 -- Access denied
            window.location.replace('/#denied');
        }
    }
});
    //para restaurar el token del storage
    if(localStorage.auth_token){
      window.auth_token = localStorage.auth_token;
      window.user_id = localStorage.user_id;
    }

    //dejo este metodo por si hiciera falta algo parecido
    var resizeFrames = function(){
      totalHeight = $(window).height();
      headerHeight = $("header.bar-title").height();
      footerHeight = $("nav.bar-tab").height();
      $("div.content").css("height",(totalHeight-headerHeight-footerHeight)+"px");

    }
                  
                  
    //resizeFrames();
    //$(window).resize(resizeFrames);

});

