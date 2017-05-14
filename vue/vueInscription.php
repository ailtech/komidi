<?php
/**
 *Ce fichier affiche le formulaire d'inscription.
 * @copyright ailtech
 * @author Perez Lucas
 * @since 1 premiére version
 * @version 1
 */

//On inclut le fichier de configuration
require_once 'include/config.php';

//Titre onglet
$titretab = "Komidi Inscription";

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

ob_start();
?>
    <div class="container">
        <form method="post" class="well" action="index.php?action=demandeInscription">
            <legend>Formulaire d'inscription</legend>
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" class="form-control" id="nom" placeholder="Ex: Jean" name="nom" onblur="verifNom(this)"/>
            </div>

            <div class="form-group">
                <label for="prenom">Prenom</label>
                <input type="text" class="form-control" id="prenom" placeholder="Ex: Dupon" name="prenom" onblur="verifPrenom(this)"/>
            </div>

            <div class="form-group">
                <label for="pseudo">Pseudo</label>
                <input type="text" class="form-control" id="pseudo" placeholder="Ex: jeanjean" name="pseudo" onblur="verifPseudo(this)"/>
            </div>

            <div class="form-group">
                <label for="mdp">Mot de passe</label>
                <input type="password" class="form-control" id="mdp" placeholder="Ex: 123456" name="mdp" onblur="verifPassword1(this)"/>
            </div>

            <div class="form-group">
                <label for="mdpverif">Retapez le mot de passe</label>
                <input type="password" class="form-control" id="mdpverif" placeholder="Ex: 123456" name="mdpverif" onblur="verifPassword2(this)"/>
            </div>

            <div class="form-group">
                <label for="mail">Email</label>
                <input type="text" class="form-control" id="mail" placeholder="Ex: jeanjean@gmail.com" name="email" onblur="verifMail(this)"/>
            </div>
            <div class='checkbox'>
                <label><input type='checkbox' name='sex' value='h'>Homme</label>
                <label><input type='checkbox' name='sex' value='f'>Femme</label>
            </div>

            <input type="submit" class="btn btn-default" value="Valider"/>
        </form>
    </div>
<?php

$contenupage = ob_get_clean();
//appelle de la 2 éme template
require 'vue/template2.tpl';
?>