<?php
require 'include/config.php';
session_destroy();

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
echo "<p>vous ete desormais deconecter</p>";

$contenupage = ob_get_clean();

require "vue/vueSidebar.php";
require 'template2.tpl';
?>