<?php
require 'include/config.php';
//Titre onglet
$titretab = "Komidi Accueil";
//corp de la page

//echo $corp;
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
//Formulaire pour ajouter un membres


if( !isset( $_POST['nom'] ) or empty( $_POST['nom'] ) or strlen( $_POST['nom'] ) > 50 ){//verifie si le nom est bien envoyer,remplie et ne depasse pas 50 caractére
    $err= "<div class='alert alert-danger'><strong>Attention!</strong> Le nom ne doit pas depasser 50 caractére et ne pas être inférieur à 1 caractére.</div>";//on traite l'erreur
}
else{

    $nom = htmlspecialchars(htmlentities($_POST['nom']));//on échape le texte

    if( !isset( $_POST['prenom'] ) or empty( $_POST['prenom'] ) or strlen( $_POST['prenom'] ) > 100 ){//verifie si le prenom est bien envoyer,remplie et ne depasse pas 100 caractére
        $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le prénom ne doit pas dépasser 100 caractére et ne pas  être inférieur à 1 caractére.</div>";//on traite l'erreur
    }
    else{

        $prenom = htmlspecialchars(htmlentities($_POST['prenom'])); //on échape le texte

        if( !isset( $_POST['mdp'] ) or empty( $_POST['mdp'] ) or strlen( $_POST['mdp'] ) > 500 ){//verifie si le mdp est bien envoyer,remplie et ne depasse pas 500 caractére
            $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le mot de passe doit être supérieur à 1 caractére et ne peux dépasser 500 carctere.</div>";//on traite l'erreur
        }
        else{

            $mdp = md5(htmlspecialchars(htmlentities( $_POST['mdp'] ))); //on échape le texte

            if( !isset( $_POST['sex'] ) or empty( $_POST['sex'] ) or strlen( $_POST['sex'] ) > 1 ){//verifie si le sex est bien envoyer,remplie et ne depasse pas 1 caractére
                $err = "<div class='alert alert-danger'><strong>Attention!</strong> Le sex doit être renseigner.</div>";//on traite l'erreur
            }
            else{
                $sex = htmlspecialchars(htmlentities( $_POST['sex'] )); //on échape le texte

                if( !isset( $_POST['email'] ) or empty( $_POST['email'] ) or strlen( $_POST['email'] ) > 200 ){//verifie si l'email' est bien envoyer,remplie et ne depasse pas 200 caractére
                    $err = "<div class='alert alert-danger'><strong>Attention!</strong> L'email doit être renseigner, vérifier votre email.</div>";//on traite l'erreur
                }
                else{

                    if( !filter_var( $_POST['email'] , FILTER_VALIDATE_EMAIL) ){//verifie si l'email est valide
                        $err = "<div class='alert alert-danger'><strong>Attention!</strong> L'email doit être valide, vérifier votre email.</div>";//on traite l'erreur
                    }
                    else{

                        $email = htmlspecialchars(htmlentities( $_POST['email'] ));//on échape le texte
                        $strSql = "INSERT INTO menbres VALUES('','$email','$mdp','$nom','$prenom',0,NOW(),'$sex')";
                        $spectacles->setMembre($strSql);
                        $err = "<div class='alert alert-success'><strong>Réussi!</strong> Vous ete désormais enregistrer votre login est votre adresse e-mail.<a href='#'>noter un spectacle</a></a></div>";
                    }
                }
            }
        }
    }
}
$corp = $err."<form action='index.php?action=demandeInscription' method='POST'>
        <div class='form-group'>
            <label for='nom'>Nom:</label>
            <input type='text' class='form-control' id='nom' name='nom'>
        </div>
        <div class='form-group'>
            <label for='prenom'>Prenom:</label>
            <input type='text' class='form-control' id='prenom' name='prenom'>
        </div>
        <div class='form-group'>
            <label for='email'>email:</label>
            <input type='email' class='form-control' id='email' name='email'>
        </div>
        <div class='form-group'>
            <label for='c_email'>Confirmation email:</label>
            <input type='email' class='form-control' id='c_email'>
        </div>
        <div class='form-group'>
            <label for='mdp'>Mot de passe:</label>
            <input type='password' class='form-control' id='mdp' name='mdp'>
        </div>
        <div class='form-group'>
            <label for='c_mdp'>Confirmation mot de passe:</label>
            <input type='password' class='form-control' id='c_md'>
        </div>
        <div class='checkbox'>
            <label><input type='checkbox' name='sex' value='h'>Homme</label>
            <label><input type='checkbox' name='sex' value='f'>Femme</label>
        </div>
        <button type='submit' class='btn btn-default' name='envoyeInscription' value='inscription'>Submit</button>
    </form>";

echo $corp;

$contenupage = ob_get_clean();


//Appel de template
require "vue/vueSidebar.php";
require "vue/template2.tpl";
?>