var app = new Vue({
    el: '#app',
    
    data: {
        visible_props:{
            auth_block_vis: 'yes',
            display_login: 0,
            display_signin: 0,
            name_user: '',
            add_button: 0,
            display_addArticle_form: 0
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
            content: 'wvfvwfvcwer',
            author: 'wvwfvcwfvc',
        },
        
        ],
        history:[]
    },
    
    methods:{
        async checkSession() 
        {
            
            let response = await fetch('getSessionVars.php');
            let text = await response.text();
            alert("CheckSession:" + text);
            if (text != "Информация недоступна")
            {
                let sess = JSON.parse(text);
                this.visible_props.name_user = sess.user.name;
                this.visible_props.auth_block_vis = 0;
                this.visible_props.add_button = 1;
            }else{
                
                this.visible_props.name_user ='';
                this.visible_props.auth_block_vis = 1;
                this.visible_props.add_button = 0;
            }

        },
        async authorize()
        {
            
            let data = new FormData();
            data.append("login", this.user_login.login);
            data.append("password", this.user_login.password);
            let url = "author.php";
            let response_post = await fetch(url,{method: 'POST', body: data});
            
            let result_post = await response_post.text();
            
          
            
            
              if(result_post=='done')
              {
                
                this.checkSession();
              }
              else
              {
                alert("no users found");
              }
        },

        async register()
        {
            
            
            
            let data = new FormData();
            data.append("name", this.users.name);
            data.append("email", this.users.email);
            data.append("password", this.users.password);
            let url = "register_script.php";
            let response_post = await fetch(url,{method: 'POST', body: data});
            
            
            let result_post = await response_post.text();
            
          

            if(result_post != '')
            {
                this.checkSession();
            }
            else
            {
                alert("registration failed");
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
            let text = await response.text(); 
            
            if(text == true)
            {
                alert("Session killed sucsefully");

                this.checkSession();
            }
            else
            {
                alert("Ошибка выхода из аккаунта");
            }
        },

        async add_article(){
            let data = new FormData();
            data.append("caption", this.articles.caption);
            data.append("content", this.articles.content);
            let url = "add_article.php";
            let response_post = await fetch(url,{method: 'POST', body: data});

            let result_post = await response_post.text();
            alert(result_post);
        }
    },
    mounted(){
        this.checkSession(); //Когда Vue JS готов к арботе и все загрузил скрабатывает этот хук
    }

})