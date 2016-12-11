<?php
require('include/config.php');
//On recupere l'id pour mettre les info du spectacle
if( isset($_GET['action']) and isset($_GET['id']) and $_GET['action'] == "update" and !empty( $_GET['id'] ) ){
    $idSpectacle = htmlspecialchars(htmlentities( $_GET['id'] ));
    if( $leSpectacle = $spectacles->getSpectacle( $idSpectacle )){
        //rien c'est bon
    }
    else{
        //erreur
    }
}
else{
    //erreur
}
//on modifie
if(isset($_POST['btn-save']))
{
    $Titre = htmlspecialchars( $_POST['Titre'] ,ENT_NOQUOTES);
    //$Annee = htmlspecialchars(htmlentities( $_POST['Annee'] ));
    $Spe_mes = htmlspecialchars( $_POST['mes'] ,ENT_NOQUOTES);
    $Acteurs = htmlspecialchars( $_POST['Acteurs'] ,ENT_NOQUOTES);
    $Spe_cie = htmlspecialchars( $_POST['cie'] ,ENT_NOQUOTES);
    $Duree = htmlspecialchars( $_POST['Duree'] ,ENT_NOQUOTES);
    $Langue = htmlspecialchars( $_POST['Langue'] ,ENT_NOQUOTES);
    $Public = htmlspecialchars( $_POST['Public'] ,ENT_NOQUOTES);
    $ResumeCourt = htmlspecialchars( $_POST['ResumeCourt'] ,ENT_NOQUOTES);
    $ResumeLong = htmlspecialchars( $_POST['ResumeLong'] ,ENT_NOQUOTES);
    //$Affiche = htmlspecialchars(htmlentities( $_POST['Affiche'] ));
    $Genre = htmlspecialchars( $_POST['Genre'] ,ENT_NOQUOTES);
    if($spectacles->updateSpectacle($Titre,$Spe_mes,$Acteurs,$Spe_cie,$Duree,$Langue,$Public,/*$Affiche,*/$ResumeCourt,$ResumeLong,$Genre,$idSpectacle))
    {
        header("Location: index.php?action=update&inserted&id=$idSpectacle");
    }
    else
    {
        header("Location: index.php?action=update&failure&id=$idSpectacle");
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
            <strong>Super !</strong> Le spectacle a bien été modifié <a href="index.php?action=accueil">Accueil</a>!
        </div>
    </div>
    <?php
}
else if(isset($_GET['failure']))
{
    ?>
    <div class="container">
        <div class="alert alert-warning">
            <strong>Désolé!</strong> Erreur lors de la modification du spectacle !
        </div>
    </div>
    <?php
}
?>


<h1>Modification d'un spectacle</h1>
<div class="row">
    <div class="panel panel-default user-add-edit">
        <div class="panel-heading">


        </div>
        <div class="panel-body">
            <form method='post' class="form-horizontal" role="form" enctype="multipart/form-data" action="#">
                <table class='table table-bordered'>
                    <?php
                        while( $rst = $leSpectacle->fetch(PDO::FETCH_ASSOC)){
                    ?>
                    <tr>
                        <td>Titre du spectacle</td>
                        <td><input type='text' name='Titre' class='form-control' value="<?php echo $rst['Spe_titre'];?>" required></td>
                    </tr>
                     <!--
                    <tr>
                        <td>Année </td>
                        <td><input type='number' name='Annee' class='form-control'  value="<?php //echo $rst[''];?>" ></td>
                    </tr>
                    -->
                    <tr>
                        <td>Metteur en scène</td>
                        <td><input type='text' name='mes' class='form-control'  value="<?php echo $rst['Spe_mes'];?>" required></td>
                    </tr>

                    <tr>
                        <td>Acteurs</td>
                        <td><textarea name='Acteurs' class='form-control' ><?php echo $rst['Spe_acteur'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Compagnie</td>
                        <td><textarea name='cie' class='form-control' ><?php echo $rst['Spe_cie'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Durée du spectacle</td>
                        <td><input type="number" name='Duree' class='form-control'  value="<?php echo $rst['Spe_duree'];?>" ></td>
                    </tr>
                    <tr>
                        <td>Langue</td>
                        <td><input type="text" name='Langue' class='form-control'  value="<?php echo $rst['Spe_Lang'];?>" ></td>
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
                            <!--
                    <tr>
                        <td>Affiche</td>
                        <td><input type="file" name='Affiche' class='form-control' ></td>
                    </tr>
                    -->
                    <tr>
                        <td>Resume court</td>
                        <td><textarea name='ResumeCourt' class='form-control' ><?php echo $rst['Spe_resume_court'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Resume long</td>
                        <td><textarea name='ResumeLong' class='form-control' ><?php echo $rst['Spe_resume_long'];?></textarea></td>
                    </tr>
                    <tr>
                        <td>Genre</td>
                        <td>
                            <input  type="text" name='Genre' class='form-control'  value="<?php echo $rst['Spe_genre'];?>" >
                        </td>
                    </tr>
                    <?php
                    }
                    ?>
                    <tr>
                        <td colspan="2">
                            <button type="submit" class="btn btn-primary" name="btn-save">
                                <span class="glyphicon glyphicon-plus"></span> Modifié le spectacle
                            </button>
                            <a href="index.php" class="btn btn-large btn-success"><i  color="red" class="glyphicon glyphicon-backward"></i> &nbsp; Retour à l'accueil</a>
                        </td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
</div>