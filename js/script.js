var app = new Vue({
    el: '#app',
    
    data: {
        visible_props:{
            auth_block_vis: 'yes',
            display_login: 0,
            display_signin: 0,
            name_user: ''
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
        {
            caption: 'efgverfvwfvw',
            date: 'wfvwerf',
            text: 'wvfvwfvcwer',
            author: 'wvwfvcwfvc',
        },
        
        ],
        history:[]
    },
    
    methods:{
        async checkSession() // Метод на
        {
            
            let response = await fetch('getSessionVars.php');
            let text = await response.text();
            alert("CheckSession:" + text);
            if (text != "Информация недоступна")
            {
                let sess = JSON.parse(text);
                this.visible_props.name_user = sess.user.name;
                this.visible_props.auth_block_vis = 0;
            }else{
                /* Параметры по умолчанию */
                this.visible_props.name_user ='';
                this.visible_props.auth_block_vis = 1;
            }

        },
        async authorize()
        {
            
            /*let user = { login: this.user_login.login, password: this.user_login.password };
              
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
              }*/



            let data = new FormData();
            data.append("login", this.user_login.login);
            data.append("password", this.user_login.password);
            let url = "author.php";
            let response_post = await fetch(url,{method: 'POST', body: data});
            
            let result_post = await response_post.text();
            alert("Ответ "+result_post);
          
            result_json = JSON.parse(result_post);
            
              if(result_json.author=="yes")
              {
                this.visible_props.auth_block_vis = 'no';
                
              }
              else
              {
                alert("no users found");
              }
        },

        async register()
        {
            
            let user = {
                name: this.users.name,
                email: this.users.email,
                password: this.users.password
            };
            let response = await fetch('register_script.php?name=' + user.name + '&email='+user.email + '&password=' + user.password );
            
            let text = await response.text(); // Сделали текст из responce
            sessionStorage.setItem('myData', JSON.stringify(text));

            if(text !== '')
            {
                /*
                alert(text);
                let sessData = JSON.parse(text);

            //    this.$session.start();
            //    this.$session.set("jwt", token);
                this.visible_props.name_user = sessData.name;
                this.visible_props.auth_block_vis = 0;*/
                this.checkSession();
            }
            else
            {
                alert("no users found");
            }
        },

        async open_pers_page()
        {
            let response = await fetch("pers_page.php");
            let html = await response.text();
            let block = document.querySelector(".content");
            this.history.push(block.innerHTML);
            block.innerHTML = html;
        },

        async log_out(){
            let response = await fetch("kill_session.php");
            let text = await response.text(); // Сделали текст из responce
            
            if(text == true)
            {
                alert("Session killed sucsefully");
                //this.visible_props.auth_block_vis = 1;
                //this.name_user = '';
                this.checkSession();
            }
            else
            {
                alert("Ошибка выхода из аккаунта");
            }
        }
    },
    mounted(){
        this.checkSession(); //Когда Vue JS готов к арботе и все загрузил скрабатывает этот хук
    }

})