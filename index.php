<?php 
require_once("session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <script src="js/vue.js"></script>
</head>
<body v-on:load="checkSession();">
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
                            <a href="#" v-on:click="open_pers_page" class="nav-link px-2 text-white">Личный кабинет</a>
                        </li>
                    </ul>
                    <form class="col-12 col-lg-auto mb-3 mb-lg-0 me-lg-3">
                        <input type="search" class="form-control form-control-dark"
                        placeholder="Найти статью/автора" aria-label="Search">
                    </form>
                    <div class="text-end" v-if="visible_props.auth_block_vis">
                        <a type="button" class="btn btn-outline-light me-2" v-on:click="visible_props.display_login=1;"
                        >Log in</a>
                        <div  v-if="visible_props.display_login" class="modal_frame">
                            <form class="forma forma2">
                                <button class="btn btn-secondary vertical-align-middle" 
                                v-on:click="visible_props.display_login=0;">x</button>
                                <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Email</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="Email" v-model="user_login.login">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Password</label>
                                            <input type="password" class="form-control" id="inputPassword4" placeholder="Password" v-model="user_login.password">
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-primary" v-on:click="visible_props.display_login=0;authorize();">Log in</button>
                            </form>
                        </div>
                        <a type="button" class="btn btn-warning" v-on:click="visible_props.display_signin=1;"
                        >Sign in</a>
                        <div v-if="visible_props.display_signin" class="modal_frame">
                            <form class="forma forma2" id="myform">
                                <button class="btn btn-secondary vertical-align-middle" 
                                v-on:click="visible_props.display_signin=0;">x</button>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputEmail">User Name</label>
                                        <input type="email" class="form-control" id="inputEmail" placeholder="Name" v-model="users.name">
                                        <label for="inputName">Email</label>
                                        <input type="email" class="form-control" id="inputName" placeholder="Email" v-model="users.email">
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="inputPassword4">Password</label>
                                        <input type="password" class="form-control" id="inputPassword4" placeholder="Password" v-model="users.password">
                                    </div>
                                </div>
                                
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <label for="inputCity">City</label>
                                        <input type="text" class="form-control" id="inputCity">
                                    </div>
                                    
                                    
                                <div class="form-group">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="gridCheck">
                                        <label class="form-check-label" for="gridCheck">
                                            I am agree with privacy policy
                                        </label>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary" v-on:click="visible_props.display_signin=0;register();">Sign in</button>
                            </form>
                        </div>
                        
                    </div>
                    
                </div>
                <div v-on:click="log_out();" style = "cursor: pointer;">
                        <h1>{{visible_props.name_user}}</h1>
                    
                    </div>
            </div>
        </header>
        <div class="content">
            <div class="container">
                <div class="card" v-for="item in articles">
                    <h5 class="card-header">{{item.caption}}</h5>
                    <div class="card-body">
                        <h5 class="card-title">Особое обращение с заголовком</h5>
                        <p class="card-text">С вспомогательным текстом ниже в качестве естественного перехода к дополнительному контенту.</p>
                        <a href="#" class="btn btn-primary">Перейти куда-нибудь</a>
                    </div>
                </div>
                <div class="row d-flex justify-content-center">
                    <div class="col-12">
                        <button v-if="visible_props.add_button" v-on:click="visible_props.display_addArticle_form=1;" type="submit" class="btn btn-primary d-flex align-items-center justify-content-center">Add new</button>
                        <div  v-if="visible_props.display_addArticle_form" class="modal_frame">
                            <form class="forma forma2">
                                <button class="btn btn-secondary vertical-align-middle" 
                                v-on:click="visible_props.display_addArticle_form=0;">x</button>
                                <div class="form-row">
                                        <div class="form-group col-md-12">
                                            <label for="inputEmail4">Caption</label>
                                            <input type="email" class="form-control" id="inputEmail4" placeholder="caption" v-model="articles.caption">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="inputPassword4">Content</label>
                                            <input type="password" class="form-control" id="inputPassword4" placeholder="Content" v-model="articles.content">
                                        </div>
                                    </div>
                                <button type="submit" class="btn btn-primary" v-on:click="visible_props.display_addArticle_form=0;add_article();">Post</button>
                            </form>
                        </div>
                    </div>
                </div>
                
            </div>
            
        </div>
        
        

    </div>
    
    <script src="js/script.js?v=<?php echo uniqid(); ?>"></script>
    <script src="js/bootstrap.bundle.min.js" ></script>
    <link rel="stylesheet" href="css/style.css">
</body>
</html>