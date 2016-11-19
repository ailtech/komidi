<?php 
require_once 'include/config.php'; 
//Titre onglet
$titretab = "Komidi Contact";
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
   $titre = "Contactez-nous !";
    $titrecontenu   = "<h2>Formulaire de contact </h2>";
   ob_start();
?>
    <div class="row">
        <div class="col-sm-8 col-sm-offset-2">
            <form id="defaultForm" method="post" name="frmContact" class="form-horizontal" action="#">
                <div class="form-group">
                    <label class="col-sm-3 control-label">Civilit&eacute;</label>
                    <div class="col-sm-5">
                        <select class="form-control" name="civilite" size="0">
                            <option value="1" selected>Monsieur</option>
                            <option value="2">Mademoiselle</option>
                            <option value="3">Madame</option>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label class="col-sm-3 control-label">Nom complet</label>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="nom" name="nom" size="80" placeholder="nom" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" id="pnom" name="prenom" size="80" placeholder="pr&eacute;nom">
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Adresse</label>
                    <div class="col-sm-5">
                        <textarea class="form-control" id="adresse" name="adresse" rows="5" cols="120" placeholder="adresse" required></textarea>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Ville</label>
                    <div class="col-sm-4">
                        <input class="form-control" type="text" name="ville" size="25" placeholder="Ville" required>
                    </div>
                    <div class="col-sm-4">
                        <input type="text" class="form-control" name="codepostal" size="5" placeholder="Code postal" required>
                    </div>
                </div>

                <div class="form-group">
                    <label class="col-sm-3 control-label">Adresse mail</label>
                    <div class="col-sm-5">
                        <input type="email" class="form-control" name="email" required>
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-9 col-sm-offset-3">
                        <button type="submit" class="btn btn-success" name="signup" value="Sign up">valider</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
<?php
    $contenupage = ob_get_clean();
    require "vue/vueSidebar.php";
    require "vue/template.tpl";
?>