<?php
/**
 * Created by PhpStorm.
 * User: alexandre
 * Date: 24/04/17
 * Time: 16:23
 */

require_once 'include/config.php';

if( !empty( $_POST['civilite'] ) and !empty( $_POST['nom'] ) and !empty( $_POST['prenom'] ) and !empty( $_POST['msg'] ) and !empty( $_POST['ville'] ) and !empty( $_POST['codepostal'] ) and !empty( $_POST['email'] ) )
{
    //on extrait les variables global dans des simple variable en echapant les caratere special.
    $civilite = htmlspecialchars( $_POST['civilite'] , ENT_NOQUOTES);
    $nom = htmlspecialchars( $_POST['nom'] , ENT_NOQUOTES);
    $prenom = htmlspecialchars( $_POST['prenom'] , ENT_NOQUOTES);
    $msg = htmlspecialchars( $_POST['msg'] , ENT_NOQUOTES);
    $ville = htmlspecialchars( $_POST['ville'] , ENT_NOQUOTES);
    $cde = htmlspecialchars( $_POST['codepostal'] , ENT_NOQUOTES);
    $email = htmlspecialchars( $_POST['email'] , ENT_NOQUOTES);
    //on verifie si les dimension requis pour les variable sont exacte
    if( ( strlen($nom) >= 0 and strlen($nom) <= 25) and ( strlen($prenom) >= 0 and strlen($prenom) <= 25) and ( strlen($cde) >= 0 and strlen($cde) <= 5 ) and  filter_var($email,FILTER_VALIDATE_EMAIL)  and ( strlen($ville) >= 0 and strlen($ville) <= 35 ) )
    {
        // on verifie de quelle civilitée et la personne et on l'enregistre
        switch ($civilite)
        {
            case 2:
                $civilite = "Mademoiselle";
                break;
            case 3:
                $civilite = "Madame";
                break;
            default:
                $civilite = "Monsieur";
        }
        //echo $civilite;
        //on envoie un mail pour l'administrateur recevoir le message et on enregistre le message dans la base de donnee

        //on prepare le message
        $message = "<!DOCTYPE html>
                <html>
                <head>
	                <title>Contact Komidi via plateforme komidiscope</title>
                </head>
                <body>
	                <h1>$civilite, $nom $prenom</h1>
	                <p>Résident à $ville,$cde,</p>
	                <h1>Message: <p>$msg</p></h1>
                </body>
                </html>";
        //on définit les entete
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
        $headers .= 'From: '.$nom.' '.$prenom.' <'.$email.'>' . "\r\n";
        //on stanciation d'un objet mail
        $mail = new Mail("lefevre451@gmail.com","Contact Komidi",$message,$headers);
        //on lance le mail et enregistre
        if( $mail->envoyeMail( $civilite, $nom, $prenom,$ville, $cde, $email ) )
        {
            //echo "action traiter avec sucées";
            echo 0; // 0 pour tout ces bien passer
        }
        else
        {
            //echo "action non traitée";
            echo 1; // 1 pour envoie message echouer
        }

    }
    else
    {
        //echo "dimension incorect";
        echo 2; // 2 pour un des champ dépasse la limite de caratéres possible.
    }
}
else
{
    //echo "Une variable manquante";
    echo 3; // 3 pour un des champ non renseigner.
}
?>