<?php
/**
 * Ce fichier permet d'inscrire une personne .
 * @copyright ailtech
 * @author Lefevre Alexandre
 * @since 1 Premiéres version
 * @since 2 Traitement de la prise en compte de l'enregistrement du membres.
 * @version 2
 */

//on inclus le fchier de configuration.
require 'include/config.php';

//Titre onglet
$titretab = "Komidi Accueil";

// Menu de la page
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

//Contenu de la page
ob_start();
echo "<div class='row affiches'>";



if( !isset( $_POST['nom'] ) or empty( $_POST['nom'] ) or strlen( $_POST['nom'] ) > 50 )
{//verifie si le nom est bien envoyer,remplie et ne depasse pas 50 caractére, sinon on affiche un message d'erreur et remet le formulaire
    $err= "<div class='alert alert-danger'><strong>Attention!</strong> Le nom ne doit pas depasser 50 caractére et ne pas être inférieur à 1 caractére.</div>";//on traite l'erreur
}
else
{

    $nom = htmlspecialchars(htmlentities($_POST['nom']));//on échape le texte

    if( !isset( $_POST['prenom'] ) or empty( $_POST['prenom'] ) or strlen( $_POST['prenom'] ) > 100 )
    {//verifie si le prenom est bien envoyer,remplie et ne depasse pas 100 caractére sinon on affiche un message d'erreur et remet le formulaire
        $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le prénom ne doit pas dépasser 100 caractére et ne pas  être inférieur à 1 caractére.</div>";//on traite l'erreur
    }
    else
    {

        $prenom = htmlspecialchars(htmlentities($_POST['prenom'])); //on échape le texte

        if( !isset( $_POST['mdp'] ) or empty( $_POST['mdp'] ) or strlen( $_POST['mdp'] ) > 500 )
        {//verifie si le mdp est bien envoyer,remplie et ne depasse pas 500 caractére sinon on affiche un message d'erreur et remet le formulaire
            $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le mot de passe doit être supérieur à 1 caractére et ne peux dépasser 500 carctere.</div>";//on traite l'erreur
        }
        else
        {

            $mdp = md5(htmlspecialchars(htmlentities( $_POST['mdp'] ))); //on échape le texte

            if( !isset( $_POST['sex'] ) or empty( $_POST['sex'] ) or strlen( $_POST['sex'] ) > 1 )
            {//verifie si le sex est bien envoyer,remplie et ne depasse pas 1 caractére sinon on affiche un message d'erreur et remet le formulaire
                $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le sex doit être renseigner.</div>";//on traite l'erreur
            }
            else
            {
                $sex = htmlspecialchars(htmlentities( $_POST['sex'] )); //on échape le texte

                if( !isset( $_POST['email'] ) or empty( $_POST['email'] ) or strlen( $_POST['email'] ) > 200 )
                {//verifie si l'email' est bien envoyer,remplie et ne depasse pas 200 caractére sinon on affiche un message d'erreur et remet le formulaire
                    $err = "<div class='alert alert-danger'><strong>Attention!</strong> L'email doit être renseigner, vérifier votre email.</div>";//on traite l'erreur
                }
                else
                {

                    if( !filter_var( $_POST['email'] , FILTER_VALIDATE_EMAIL) )
                    {//verifie si l'email est valide sinon on affiche un message d'erreur et remet le formulaire
                        $err = "<div class='alert alert-danger'><strong>Attention!</strong> L'email doit être valide, vérifier votre email.</div>";//on traite l'erreur
                    }
                    else//cas ou toutes les informations demander pour l'inscrition sont envoyée
                    {

                        $email = htmlspecialchars(htmlentities( $_POST['email'] ));//on échape le texte
                        //On écrit la requête
                        $strSql = "INSERT INTO menbres VALUES('','$email','$mdp','$nom','$prenom',0,NOW(),'$sex')";
                        //on l'execute
                        if( $spectacles->setMembre($strSql) )
                        {
                            //On affiche un message de réussite.
                            $err = "<div class='alert alert-success'><strong>Réussi!</strong> Vous ete désormais enregistrer votre login est votre adresse e-mail.<a href='#'>noter un spectacle</a></a></div>";
                        }
                        else
                        {
                            //On affiche un message de non-réussite.
                            $err = "<div class='alert alert-warning'><strong>Erreur!</strong> Service momentanément indisponible.</div>";
                        }

                    }
                }
            }
        }
    }
}
$corp = "<div class='container'>
        <form method=\"post\" class=\"well\" action=\"index.php?action=demandeInscription\">
        $err
            <legend>Formulaire d'inscription</legend>
            <div class=\"form-group\">
                <label for=\"nom\">Nom</label>
                <input type=\"text\" class=\"form-control\" id=\"nom\" placeholder=\"Ex: Jean\" name=\"nom\" onblur=\"verifNom(this)\"/>
            </div>

            <div class=\"form-group\">
                <label for=\"prenom\">Prenom</label>
                <input type=\"text\" class=\"form-control\" id=\"prenom\" placeholder=\"Ex: Dupon\" name=\"prenom\" onblur=\"verifPrenom(this)\"/>
            </div>

            <div class=\"form-group\">
                <label for=\"pseudo\">Pseudo</label>
                <input type=\"text\" class=\"form-control\" id=\"pseudo\" placeholder=\"Ex: jeanjean\" name=\"pseudo\" onblur=\"verifPseudo(this)\"/>
            </div>

            <div class=\"form-group\">
                <label for=\"mdp\">Mot de passe</label>
                <input type=\"password\" class=\"form-control\" id=\"mdp\" placeholder=\"Ex: 123456\" name=\"mdp\" onblur=\"verifPassword1(this)\"/>
            </div>

            <div class=\"form-group\">
                <label for=\"mdpverif\">Retapez le mot de passe</label>
                <input type=\"password\" class=\"form-control\" id=\"mdpverif\" placeholder=\"Ex: 123456\" name=\"mdpverif\" onblur=\"verifPassword2(this)\"/>
            </div>

            <div class=\"form-group\">
                <label for=\"mail\">Email</label>
                <input type=\"text\" class=\"form-control\" id=\"mail\" placeholder=\"Ex: jeanjean@gmail.com\" name=\"email\" onblur=\"verifMail(this)\"/>
            </div>
            <div class='checkbox'>
                <label><input type='checkbox' name='sex' value='h'>Homme</label>
                <label><input type='checkbox' name='sex' value='f'>Femme</label>
            </div>

            <input type=\"submit\" class=\"btn btn-default\" value=\"Valider\"/>
        </form>
        </div>
    ";

//on afiche le formulaire dans tout les cas
echo $corp;

$contenupage = ob_get_clean();

//require "vue/vueSidebar.php";
$sidebarpage = "";//initialise un sidebar vide
//Appel de template
require "vue/template2.tpl";
?>