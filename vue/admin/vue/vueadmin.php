<?php
require('include/config.php');
$spe = $spectacles->getSpectacles();
?>
<table class="table">
    <tr>


        <th width="10%">Nom spectacle</th>
        <th width="10%">les Metteur en scénes</th>
        <th width="10%">les acteurs</th>
        <th width="10%">Compagnie</th>
        <th width="10%">affiche</th>
        <th width="500%">resumer spectacle</th>
        <th width="10%">Genre</th>
        <th width="10%">Durre</th>
        <th width="10%">Langue</th>
        <th width="10%">Public</th>
        <th width="500%">Resumer long</th>
        <th width="10%"></th>

    </tr>

    <?php

    while($donne = $spe->fetch(PDO::FETCH_ASSOC) ){
        ?>


        <td><?php echo $donne['Spe_titre']; ?></td>
        <td><?php echo $donne['Spe_mes']; ?></td>
        <td><?php echo$donne['Spe_acteur']; ?></td>
        <td><?php echo $donne['Spe_cie']; ?></td>
        <td><?php echo $donne['Spe_affiche']; ?></td>
        <td><?php echo $donne['Spe_resume_court']; ?></td>
        <td><?php echo $donne['Spe_genre']; ?></td>
        <td><?php echo $donne['Spe_duree']; ?></td>
        <td><?php echo $donne['Spe_Lang']; ?></td>
        <td><?php echo $donne['Spe_public']; ?></td>
        <td><?php echo $donne['Spe_resume_long']; ?></td>
        <td>
            <!-- modifier -->
            <a href="index.php?action=update&id=<?php echo $donne['Spe_id']; ?>" class="glyphicon glyphicon-edit"></a>
            <!-- supprimer -->
            <a href="index.php?action=delete&id=<?php echo $donne['Spe_id']; ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Êtes-vous sûr de supprimmer ce spectacle?');"></a>
        </td>

        </tr>
    <?php } ?>
</table>

