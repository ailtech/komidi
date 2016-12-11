<?php
require('include/config.php');
if(isset($_POST['btn-save']))
{   //parametre pour le fichier envoyer
    if( isset($_FILES['Affiche']) and !empty($_FILES['Affiche']) ){
        //chose a fair si le fichier existe
        if( $_FILES['Affiche']['error'] == 0 ){
            if( $_FILES['Affiche']['size'] <= 2000000 ){
                //on verifie l extension
                $info = pathinfo($_FILES['Affiche']['name']);
                $extension = $info['extension'];
                $tabExt = array('jpg','jpeg','gif','png');
                if( in_array( $extension, $tabExt) ){
                    //si lextension est valide
                    $base = "../../image/".basename($_FILES['Affiche']['name']);
                    //echo "Nom Fichier:".$_FILES['Affiche']['name'];//debug
                    if( move_uploaded_file($_FILES['Affiche']['tmp_name'],$base)){
                        echo "<div class=\"alert alert-info\">
            <strong>Super !</strong> Le Fichier a bien été importer!
        </div>";
                    }
                    else{
                        //erreur
                        echo "<div class=\"alert alert-warning\">
            <strong>Désolé!</strong> Erreur Dans l'envoie de votre fichier !
        </div>";
                    }

                }
                else{
                   //erreur
                    echo "<div class=\"alert alert-warning\">
            <strong>Désolé!</strong> Erreur les extension possible sont: 'jpg','jpeg','gif','png' !
        </div>";
                }
            }
            else{
                //erreur
                echo "<div class=\"alert alert-warning\">
            <strong>Désolé!</strong> Erreur votre fichier depasse 2 MO !
        </div>";
            }
        }
        else{
            //erreur
            echo "<div class=\"alert alert-warning\">
            <strong>Désolé!</strong> Erreur lors de la lecture du fichier !
        </div>";
        }
    }
    else{
        echo "<div class=\"alert alert-warning\">
            <strong>Désolé!</strong> Fichier inexistant !
        </div>";
    }
    $Titre = htmlspecialchars($_POST['Titre'] ,ENT_NOQUOTES);
    //$Annee = $_POST['Annee'];
    $Spe_mes = htmlspecialchars($_POST['mes'] ,ENT_NOQUOTES);
    $Acteurs = htmlspecialchars($_POST['Acteurs'] ,ENT_NOQUOTES);
    $Spe_cie = htmlspecialchars($_POST['cie'] ,ENT_NOQUOTES);
    $Duree = htmlspecialchars($_POST['Duree'] ,ENT_NOQUOTES);
    $Langue = htmlspecialchars($_POST['Langue'] ,ENT_NOQUOTES);
    $Public = htmlspecialchars($_POST['Public'] ,ENT_NOQUOTES);
    $ResumeCourt = htmlspecialchars($_POST['ResumeCourt'] ,ENT_NOQUOTES);
    $ResumeLong = htmlspecialchars($_POST['ResumeLong'] ,ENT_NOQUOTES);
    $Affiche = htmlspecialchars( $_FILES['Affiche']['name'],ENT_NOQUOTES);
    $Genre = htmlspecialchars($_POST['Genre'] ,ENT_NOQUOTES);
    if($spectacles->createSpectacle($Titre,$Affiche,$Spe_mes,$Acteurs,$Spe_cie,$Duree,$Langue,$Public,$Affiche,$ResumeCourt,$ResumeLong,$Genre))
    {
        header("Location: index.php?action=ajout&inserted");
    }
    else
    {
        header("Location: index.php?action=ajout&failure");
    }
}
?>

<div class="clearfix"></div>

<?php
if(isset($_GET['inserted']))
{
    ?>
    <div class="container">
        <div class="alert alert-info">
            <strong>Super !</strong> Le spectacle a bien été ajouté <a href="index.php">Accueil</a>!
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>Désolé!</strong> Erreur lors de l'insertion du spectacle !
        </div>
    </div>
    <?php
}
?>


<h1>Ajouter d'un spectacle</h1>
<div class="row">
    <div class="panel panel-default user-add-edit">
        <div class="panel-heading">


        </div>
        <div class="panel-body">
            <form method='post' class="form-horizontal" role="form" enctype="multipart/form-data">
                <table class='table table-bordered'>
                    <tr>
                        <td>Titre du spectacle</td>
                        <td><input type='text' name='Titre' class='form-control' required></td>
                    </tr>
<!--
                    <tr>
                        <td>Année </td>
                        <td><input type='number' name='Annee' class='form-control'></td>
                    </tr>
-->
                    <tr>
                        <td>Metteur en scène</td>
                        <td><input type='text' name='mes' class='form-control' required></td>
                    </tr>

                    <tr>
                        <td>Acteurs</td>
                        <td><textarea name='Acteurs' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Compagnie</td>
                        <td><textarea name='cie' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Durée du spectacle</td>
                        <td><input type="number" name='Duree' class='form-control'></td>
                    </tr>
                    <tr>
                        <td>Langue</td>
                        <td><input type="text" name='Langue' class='form-control'></td>
                    </tr>
                    <tr>
                        <td>Public</td>
                        <td>
                            <select name="Public" class='form-control'>
                                <option value="Scolaire">Scolaire</option>
                                <option value="tout">Tout</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Affiche</td>
                        <td><input type="file" name='Affiche' class='form-control'></td>
                    </tr>
                    <tr>
                        <td>Resume court</td>
                        <td><textarea name='ResumeCourt' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Resume long</td>
                        <td><textarea name='ResumeLong' class='form-control'></textarea></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>
                            <input  type="text" name='Genre' class='form-control'>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-save">
                                <span class="glyphicon glyphicon-plus"></span> Ajouté un nouveau spectacle
                            </button>
                            <a href="index.php" class="btn btn-large btn-success"><i  color="red" class="glyphicon glyphicon-backward"></i> &nbsp; Retour à l'accueil</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>



