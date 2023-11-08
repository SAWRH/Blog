<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <script src="js/vue.js"></script>
</head>
<body>
    <div id="app">
        <header class="p-3 bg-dark text-white ">
            <div class="container">
                <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                    <a href="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <img src="" alt="">
                    </a>
                    <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
                        <li>
                            <a href="#" class="nav-link px-2 text-secondary">Главная</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 text-white">Статьи</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 text-white">Авторы</a>
                        </li>
                        <li>
                            <a href="#" class="nav-link px-2 text-white">Личный кабинет</a>
                        </li>
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" class="form-control form-control-dark"
                        placeholder="Найти статью/автора" aria-label="Search">
                    </form>
                    <div class="text-end" v-if="visible_props.auth_block_vis">
                        <a type="button" class="btn btn-outline-light me-2" v-on:click="visible_props.display_login=1;"
                        >Log in</a>
                        <form v-if="visible_props.display_login" style="position:absolute;background-color:white;z-index:10;">
                            <input type = "text" placeholder="Введите логин" v-model="user_login.login">
                            <input type = "password" placeholder="Введите пароль" v-model="user_login.password">
                            <button class="btn btn-outline-light me-2" v-on:click="visible_props.display_login=0;authorize();">Send</button>
                        </form>
                        <a type="button" class="btn btn-warning" v-on:click="visible_props.display_signin=1;"
                        >Sign in</a>
                        <form v-if="visible_props.display_signin" style="position:absolute;background-color:white;z-index:10;">
                            <input type = "text" placeholder="Введите имя" v-model="users.name">
                            <input type = "text" placeholder="Введите email" v-model="users.email">
                            <input type = "password" placeholder="Введите пароль" v-model="users.password">
                           
                            <button class="btn btn-outline-light me-2" v-on:click="visible_props.display_signin=0;register();">Send</button>
                        </form>
                    </div>
                </div>
            </div>
        </header>
        <section class="cards">
            <div class="container">
                <div class="card" v-for="item in articles">
                    <h5 class="card-header">{{item.caption}}</h5>
                    <div class="card-body">
                        <h5 class="card-title">Особое обращение с заголовком</h5>
                        <p class="card-text">С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту.</p>
                        <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    
    <script src="js/script.js?v=<?php echo uniqid(); ?>"></script>
    <script src="js/bootstrap.bundle.min.js" ></script>
</body>
</html>