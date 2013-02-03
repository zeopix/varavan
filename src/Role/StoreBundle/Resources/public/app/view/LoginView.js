var LoginView = Jr.View.extend({
    render: function(){
      var template = tpl.get('Login');
      this.$el.html(_.template(template));
      return this;
    },

    events: {
      'click .login-submit' : 'loginSubmit'
    },

    loginSubmit: function(){
      //make_base_auth('')
        //do the request and track result
        var email = this.$("form.login input[type=text]").val();
        var password = this.$("form.login input[type=password]").val();

        jQuery.getJSON(server('/login')+"?callback=?", 
        {
          email: email,
          pass: password,
          devicetoken: window.deviceToken,
          type: _device_type
        },
        function(data) {
          if(data.login == true){
            window.auth_token = data.user.auth_token;
            window.user_id = data.user.id;
            localStorage.me = JSON.stringify(data.user);
            localStorage.auth_token = data.user.auth_token;
            localStorage.user_id = data.user.id;
            Jr.Navigator.navigate('chats',{
              trigger: true,
              animation: {
                type: Jr.Navigator.animations.SLIDE_STACK,
                direction: Jr.Navigator.directions.RIGHT
              }
            });
          }else{
            alert("Login Fail")
          }
        });

    }
});
