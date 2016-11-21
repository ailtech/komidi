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
 if( !isset( $_POST['email'] ) or empty( $_POST['email'] ) or !isset( $_POST['mdp'] ) or empty( $_POST['mdp'] ) ){

 }
 else{
    $email = htmlspecialchars(htmlentities($_POST['email']));
     $mdp = htmlspecialchars(htmlentities($_POST['mdp']));
     $veriter = $spectacles->verifConnection($email,md5($mdp));
     //echo "le retour est $veriter<br>";//debug
     if( $veriter == "a"){
         //c'est l'admin
         echo "je suis admin";
         //header('Location: index.php?action=admin');//on le redirige vers page admin avec les session initialiser
     }
     else if( $veriter == "u"){
         //c'est un utilisateur simple
         //echo "je suis utilisateur";//debug
         $user = $spectacles->getUtilisateur($email,md5($mdp));
         $_SESSION['idUser'] = $user['mem_id'];
         $_SESSION['nomUser'] = $user['mem_nom'];
         $_SESSION['prenomUser'] = $user['mem_prenom'];
         $_SESSION['emailUser'] = $user['mem_email'];
         header('Location: index.php?action=Accueil');//on fait retourner a l index avec les session initialiser
     }
     else if( $veriter == "e"){
         //une erreur est survenue
         //echo "je suis une erreur";//debug
         echo '<div class="alert alert-danger" role="alert">Une erreur est survenu.</div>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <form  id="loginForm" class="form-horizontal" action="index.php?action=connexion" method="post">
               <div class="form-group">
                    <label class="col-sm-3 control-label">Login</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" id="email"placeholder="Entrer votre Email" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="mdp" id="mdp"placeholder=" Entrer votre Mot de passe" >

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
     }
     else{
         //dernier inexistant erreur
         //echo "je suis une erreur";//debug
         echo '<div class="alert alert-danger" role="alert">Une erreur est survenu.</div>
<div class="row">
    <div class="col-sm-8 col-sm-offset-2">

        <form  id="loginForm" class="form-horizontal" action="index.php?action=connexion" method="post">
               <div class="form-group">
                    <label class="col-sm-3 control-label">Login</label>
                    <div class="col-sm-5">
                        <input type="text" class="form-control" name="email" id="email"placeholder="Entrer votre Email" >
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Mot de passe</label>
                    <div class="col-sm-5">
                        <input type="password" class="form-control" name="mdp" id="mdp"placeholder=" Entrer votre Mot de passe" >

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
     }

 }

$contenupage = ob_get_clean();

require "vue/vueSidebar.php";
require 'template2.tpl';
?>