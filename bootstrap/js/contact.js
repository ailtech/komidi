/**
 * Created by alexandre on 24/04/17.
 */
$(document).ready(function(){
    // lors de la validation de l'envoie du message on execute le code ci contre
    $("#soumissionFormulaireContact").click(function(e){
        //on annulle par default le click sur le bouton de soumission de formulaire
        e.preventDefault();
        //on serialize le formulaire
        var donnee = $("#formulaireContact").serialize();
        //on lance une requete ajax et retourne les erreur ou les succée de l'envoie du message
        $.ajax({

            url : 'index.php?action=demandeContact',
            type : 'POST',
            data : donnee,
            dataType : 'html', // On désire recevoir du HTML

            success : function(code_html, statut){ // code_html contient le HTML renvoyé

                //on va parcourir les donne renvoiyer pour traiter l'information et le retourner a l'utilisateur
                switch ( code_html){
                    case "0":// cas ou tout ces bien passer
                        //on affiche l'erreur a l'utilisateur
                        $("#texteModal").text("Votre message a bien étè envoyer.");
                        $("#myModal").modal();
                        //on netoye le formuliare
                        $("#formulaireContact")[0].reset();
                        break;
                    case "1":// cas ou on ne peux pas envoyer de mesage
                        //on affiche l'erreur a l'utilisateur
                        $("#texteModal").text("Le service est momentanément indisponible pour le moment veuillez réessayer plus tard, nous sommes désolées pour la géne occasionnée #L'equipe Komidiscope.");
                        $("#myModal").modal();
                        break;
                    case "2"://cas ou un champ et vide ou depaasele nombre de caractere autoriser
                        //on affiche l'erreur a l'utilisateur
                        $("#texteModal").text("Un des champs est vide ou soit le nombre de caractères possible a été dépasser.");
                        $("#myModal").modal();
                        break;
                    case "3":// cas ou un des champ non renseigner
                        //on affiche l'erreur a l'utilisateur
                        $("#texteModal").text("Un des champs n'a pas été renseigner.");
                        $("#myModal").modal();
                        break;
                    default://cas ou erreur inconnue
                        //on affiche l'erreur a l'utilisateur
                        $("#texteModal").text("Une erreur inattendue s'est produite, veuillez réessayer plus tard, nous sommes désolées pour la géne occasionnée #L'equipe Komidiscope.");
                        $("#myModal").modal();
                }


            }

        });
    });


});