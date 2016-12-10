<?php
require 'include/config.php';  
  
    $titre = "Connexion utilisateur";
    $titrecontenu   = "<h2>Connexion </h2>";
ob_start(); 
foreach($menupage as $page_name => $page_url) 
{
    $class = '';
    if ($current_page == $page_url) {
        $class = 'active';
    }
    echo "<li class='$class'>
        <a href='$page_url'>".$page_name ."</a>".
     "</li>";
}
$menupage = ob_get_clean();

ob_start();
$records_per_page=6;
echo '<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <form  id="loginForm" class="form-horizontal" action="index.php?action=connexion" method="post">
               <div class="form-group">
                    <label class="col-sm-3 control-label">Login</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" id="email" placeholder="Entrer votre Email" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="mdp" id="mdp" placeholder=" Entrer votre Mot de passe" >

                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">

                        <button type="submit" class="btn btn-warning" name="signup" value="Sign up">Connexion</button> <p><a href="index.php?action=inscription">Créer un compte </a></p>


                    </div>
                </div>
        </form>
    </div>
</div>';

    $contenupage = ob_get_clean();

    require "vue/vueSidebar.php";
    require 'template2.tpl';
?>