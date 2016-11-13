<?php include 'templates/header.php' ?>

    <h2 class="text-center">Ajouter un spectacle</h2>
    <div class="well">
        <form class="form-horizontal" role="form" enctype="multipart/form-data" action="ajouter.php" method="post">
            <!-- id du produit -->
            <div class="form-group">
                <label class="col-sm-4 control-label">Référence</label>
                <div class="col-sm-6">
                    <input type="text" name="id" value="" class="form-control" placeholder="Entrez la référence" required autofocus>
                </div>
            </div>
             <!-- Nom du produit -->           
            <div class="form-group">
                <label class="col-sm-4 control-label">Nom</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="nom"  id="nom" placeholder="Entrez le nom" required>
                </div>
            </div>
            <!-- Description longue du produit -->
            <div class="form-group">
                <label class="col-sm-4 control-label">Description</label>
                <div class="col-sm-6">
                    <textarea name="description" class="form-control" rows="6" placeholder="Entrez sa description" required></textarea>
                </div>
            </div>
            <!-- Prix du produit -->   
            <div class="form-group">
                <label class="col-sm-4 control-label">Prix de vente €</label>
                <div class="col-sm-4">
                    <input type="text" name="prix" value="" class="form-control" placeholder="Entrez le prix" required>
                </div>
            </div>
            <!--  Id de la catégorie correspondant au produit à partir de la table des catégories  -->               
            <div class="form-group">
                <label class="col-sm-4 control-label">Catégorie</label>
                <div class="col-sm-4">
                    <select class="form-control" id="sel1" name="categorie">
                        <?php
                            $reponse = $cnx->query('SELECT * FROM tbl_categories');
                            while ($donnees = $reponse->fetch())
                            {
                        ?>
                        <option value="<?php echo $donnees['id']; ?>"><?php echo $donnees['nom']; ?></option>
                        <?php
                            }
                            $reponse->closeCursor();
                        ?>
                    </select>
                </div>
            </div>
            <!--  Bouton de validation de la création du produit  -->                  
            <div class="form-group">
                <div class="col-sm-4 col-sm-offset-4">
                    <button type="submit" class="btn btn-default btn-primary" name="btnAjout"><span class="glyphicon glyphicon-save"></span> Valider</button>
                </div>
            </div>
        </form>        
    </div>


<?php

// Ajoutter le produit si le bouton est activé   

if(isset($_POST['btnAjout'])){
    $strSQL  = "INSERT INTO tbl_produits (id, categorie, nom, description, prix) 
                VALUES (:id,:categorie,:nom,:description,:prix);";
    $requete=$cnx->prepare($strSQL);
    $requete->execute(array(
                        'id'=>$_POST['id'],
                        'categorie'=>$_POST['categorie'],
                        'nom'=>$_POST['nom'],
                        'description'=>$_POST['description'],
                        'prix'=>$_POST['prix']));

}

include "templates/footer.php";

?>