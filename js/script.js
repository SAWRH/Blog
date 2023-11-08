var app = new Vue({
    el: '#app',
    data: {
        visible_props:{
            auth_block_vis: 1,
            display_login: 0,
            display_signin: 0,
        },
        user_login:{
            login:"",
            password:"",
        },
        users:{
            name:"",
            email:"",
            password:""
        },
        articles: [
        {   caption: 'efgverfvwfvw',
            date: 'wfvwerf',
            text: 'wvfvwfvcwer',
            author: 'wvwfvcwfvc',
        },
        ]
    },
    methods:{
        async authorize()
        {
            
            let user = { login: this.user_login.login, password: this.user_login.password };
              
              let response = await fetch('author.php?login=' + user.login + '&password=' + user.password);
              let json = await response.text();
              
              result = JSON.parse(json);
              if(result.author=="yes")
              {
                this.visible_props.auth_block_vis = 0;
              }
              else
              {
                alert("no users found");
              }
        },

        async register()
        {
            alert("script started");
            let user = {
                name: this.users.name,
                email: this.users.email,
                password: this.users.password
            };
            let response = await fetch('register_script.php?name=' + user.name + '&email='+user.email + '&password=' + user.password );
            alert("fetch started");
            
            alert(response)
            if(response == true)
            {
                this.visible_props.auth_block_vis = 0;
            }
            else
            {
                alert("no users found");
            }
        }
    }


})