$(document).ready(function(){


    $("#note").click(function(e){
        //alert("ajax load");//debug
        //on arrete l action par default
        e.preventDefault();
        //on va chercher les info
        var idSpectacle,nbEtoile,idMembres;
        idSpectacle = $("[name='idSpectacle']").val();
        nbEtoile = $("#input-7-xs").val();
        idMembres = $("[name='idMembre']").val();
        //alert(idSpectacle+" : "+nbEtoile+" : "+idMembres);//debug
        //lance de la requete avec ajax

        $.ajax({
            url : 'index.php',
            type : 'GET',
            data : 'action=noter&nbEtoile='+nbEtoile+'&idSpectacle='+idSpectacle+'&idMembres='+idMembres,
            dataType : 'html', // On désire recevoir du HTML
            success : function(retour, statut){
                //alert(retour);//debug
                if( retour == "1"){
                    $("#alertNotation").attr("style", "");
                    $("#alertNotation").text("Votre vote a bien était enregistrer, nous vous remercions de tout coeur de participer au devellopement de nos acteur!");
                }
                else if ( retour == "0"){
                    $("#alertNotation").removeClass("alert alert-success");
                    $("#alertNotation").addClass("alert alert-danger");
                    $("#alertNotation").attr("style", "");
                    $("#alertNotation").text("On peut voter q'une seul fois,on doit être membres et le spectacle doit exister, désoler :( ");

                }
                else{
                    $("#alertNotation").removeClass("alert alert-success");
                    $("#alertNotation").addClass("alert alert-danger");
                    $("#alertNotation").attr("style", "");
                    $("#alertNotation").text("Une erreur est survenue, veuiller réesayer, si l'erreur persiste veuiller nous contacter.");
                }

            },
            error : function(resultat, statut, erreur){
                //alert(resultat);//debug
                $("#alertNotation").removeClass("alert alert-success");
                $("#alertNotation").addClass("alert alert-danger");
                $("#alertNotation").attr("style", "");
                $("#alertNotation").text("Une erreur est survenue, veuiller réesayer, si l'erreur persiste veuiller nous contacter.");
            }
        });


    });

});