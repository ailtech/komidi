
</div>
<table class="table">
    <tr>

        <th width="15%">id</th>
        <th width="15%">Nom spectacle</th>
        <th width="15%">les acteurs</th>
        <th width="15%">affiche</th>
        <th width="500%">resumer spectacle</th>
        <th width="15%"></th>

    </tr>

    <?php
    $count = 0;
    foreach($donnees as $donne){
        $count++;
        ?>

        <td><?php echo $donne['Spe_id']; ?></td>
        <td><?php echo $donne['Spe_titre']; ?></td>
        <td><?php echo$donne['Spe_acteur']; ?></td>
        <td><?php echo $donne['Spe_affiche']; ?></td>
        <td><?php echo $donne['Spe_resume_court']; ?></td>
        <td>
            <!-- modifier -->
            <a href="#?action=update&id=<?php echo $donne['Spe_id']; ?>" class="glyphicon glyphicon-edit"></a>
            <!-- supprimer -->
            <a href="#?action=delete&id=<?php echo $donne['Spe_id']; ?>" class="glyphicon glyphicon-trash" onclick="return confirm('Êtes-vous sûr ?');"></a>
        </td>

        </tr>
    <?php } ?>
</table>
</div>

</div>
