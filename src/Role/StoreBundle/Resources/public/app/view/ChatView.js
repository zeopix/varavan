var ChatView = Jr.View.extend({
	initialize: function(options){
		//buscamos un chat con el id target y lo cargamos de la bd.
		this.socket = options.socket;
		if(this.options.userId>0){
			this.chats = new Chats();
			var chat = this.chats.where({'user':this.options.userId})

        	this.contacts = new Contacts();
        	this.contacts.fetch();
			this.contacts.on('add reset', this.render, this);
			
			

			if(chat.length>0){
				chatRow = chat[0];
			}else{
				//create new chat an push to the server
				chatRow = new Chat();
				chatRow.set({user: this.options.userId});
				//this.chats.push(chatRow);
			
				Backbone.emulateJSON = true
				Backbone.emulateHTTP = true
				var self = this;
				
				//sync chat with svr, creates if not exists
				this.chats.sync("create",chatRow,{ success: function(model, resp, options){
				//init messages
				self.socket.emit('register', { token: window.auth_token ,chat: model.id });
				self.chats.updateChat(model.id,self.messages,function(){ });
				
				//useful info
				window.chatId = model.id;
				window.chatTargetId = model.targetId;

    			}});
			//bindings
			var self = this;

		}

		}else{
			alert("Wrong user id");
		}
	},
	onMessageSent: function(data){
		message = new Message(data[0]);
		app.messages.add(message);
		Offline.localSync("create",message,{success:function(){
			//message saved, you can reload page
			console.log("msg saved");
		}},app.messages.storage);
	},
	events: {
		'click form a' : 'onMessageSend',
		'keypress form input' : 'onKeyPress',
	},
	onKeyPress: function(event){
		if(event.keyCode==13){
			//aqui habría que añadir una columna al textarea que haga de input,
			//para mensajes largos
		}
	},
	writeMessage: function(data){
		//escribir mensaje en html
	}
	,
	onMessageSend: function(){
		var msg = this.$el.find("form input").val();
		if(msg.length > 0){
			if(this.socket){
				data = {
					message : msg,
					chat : window.chatId,
					token: window.auth_token
				}
				success = function(data){
					//var mensaje = new Message(data);	
				}
				this.socket.emit("message send",data,success);

			}else{
				alert("Se ha perdido la conexión con el servidor de mensajería.");
			}
		}
	},
	onSocketRegister: function(data){
		console.log("Registered!");
	}
	,

    render: function(){
    	var contactq = this.contacts.where({sid:this.options.userId});
   		if((contactq == undefined) || (contactq.length == 0)){ 	
       		var params = { contact: {
       			name : '...',
       			surname: ''
       		} }
    	}else{
	        var params = {
	        	contact: contactq[0].attributes
        	}
    	}
      	var template = _.template(tpl.get('Chat'));
      	this.$el.html(template(params));

	    var self = this;
    	if(app.messages){
      		app.messages.each(function(message){
        		self.$el.find("ul.list").append(new ChatMessageView({model:message}).render().el);  
      		});
      		_.defer(function(){
      			$("div.content").scrollTop(9999999999);
      		});
			$("div.content").scrollTop(9999999999);

  		}
      	return this;
    }

});

var ChatMessageView = Jr.View.extend({
    tagName:"li",
    render:function () {
    	templ = _.template(tpl.get('ChatMessage'));
        var attributes = {
        	message : this.model.attributes,
        	user : window.user_id
        }
        this.$el.html(templ(attributes));
        return this;
    }

});
