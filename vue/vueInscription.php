<?php
require 'include/config.php';

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

//Contenu de la page
ob_start();

echo "
<form action='index.php?action=demandeInscription' method='POST'>
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
$contenupage = ob_get_clean();

//Appel de template
require "vue/vueSidebar.php";
require "vue/template2.tpl";
?>