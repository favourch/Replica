<?php
if(!defined('REPLICA')) {die('Sorry direct access to this file not allowed');}

Replica::inc_part('top','header',[
    'title' => $title,
    'meta_description'  => $meta_description,
    'meta_keywords'     => $meta_keywords,
    'css'               => Replica::assets_load('css',['css/login.css']),
]);

if(Replica::input_exists())
{
     $login=Replica::user('login',['username'=>Replica::in('username'),'password'=>Replica::in('password')]);
}


?>



<div class="justify-text">

    <?php
        if(!Replica::session('exists',['name'=>'id'])):
    ?>
    <div class="login">
        <?php if(isset($login)): ?>
            <p class="error"><?=$login;?></p>
        <?php endif;?>

        <h2> Login to your account</h2>

        <form action="" method="post">

            <p class="error" id="username-error"></p>
            <label for="username"> Username</label>
            <input type="text" name="username" id="username" placeholder="Enter your username">
            <br>
            <p class="error" id="password-error"></p>
            <label for="password">Password</label>
            <input type="password" name="password" id="password" placeholder="Enter your password">

            <button type="submit" class="submit-btn">Login</button>
            <div class="clearfix"></div>
        </form>
    </div>
    <?php endif;

    if(Replica::session('exists', ['name'=>'id'])):
    ?>

        <h2> Hello <?=Replica::session('get',['name'=>'username']);?>, welcome to your profile</h2>
        <a href="?logout=true">Logout</a>

        <?php


        if(Replica::in('logout','get')=='true' )
            {
                Replica::user('logout',['redirect_to'=>'http://google.com']);

            }

        ?>


    <?php endif;?>

</div>



<?php

Replica::inc_part('footer','footer',['footer-widgets'=>false,
'script'=>'
<script>
    $("form").submit(function(e){
        e.preventDefault();

        var username = $("#username").val();
        var password = $("#password").val();

        if(username==""){
            $("#username-error").html("Please enter username").fadeIn();
        }else{
            $("#username-error").html("");
        }

        if(password==""){
            $("#password-error").html("Please enter password").fadeIn();
        }else{
            $("#password-error").html("");
        }


        if(username !="" && password !="")
        {
            return true;
        }
    });
</script>

'
]);

?>

