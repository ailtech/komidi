<?php
require('include/config.php');

if(isset($_POST['btn-save']))
{
    $Titre = $_POST['Titre'];
    $Annee = $_POST['Annee'];
    $Spe_mes = $_POST['mes'];
    $Acteurs = $_POST['Acteurs'];
    $Spe_cie = $_POST['cie'];
    $Duree = $_POST['Duree'];
    $Langue = $_POST['Langue'];
    $Public = $_POST['Public'];
    $ResumeCourt = $_POST['ResumeCourt'];
    $ResumeLong = $_POST['ResumeLong'];
    $Affiche = $_POST['Affiche'];
    $Genre = $_POST['Genre'];
    if($spectacles->createSpectacle($Titre,$Annee,$Spe_mes,$Acteurs,$Spe_cie,$Duree,$Langue,$Public,$Affiche,$ResumeCourt,$ResumeLong,$Genre))
    {
        header("Location: add-spectacle.php?inserted");
    }
    else
    {
        header("Location: add-spectacle.php?failure");
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

                    <tr>
                        <td>Année </td>
                        <td><input type='number' name='Annee' class='form-control'></td>
                    </tr>

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