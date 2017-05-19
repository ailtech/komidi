$(document).ready(function(){
    //alert("Jquery Recheche Initialiser");
    //alert($("#recherche").val());


    $("#recherche").keyup(function(e){
        e.preventDefault();
        //alert("ouch ne me presse plus!");
        //alert($("#recherche").val());
        var codeTouche = [65,66,67,68,69,70,71,72,73,74,75,76,77,78,79,80,81,82,83,84,85,86,87,88,89,90,9,16,32,46];
        var texte = $("#recherche").val();
        if( $.inArray( e.keyCode , codeTouche ) == -1){
            //sa veut dire que la personne a presser une autre touche que une lettre
        }
        else{
            //alert(e.keyCode);
            //alert(texte);
            $.ajax({
                url : 'index.php',
                type : 'GET',
                data : 'action=recherche&texte='+texte,
                dataType : 'html', // On désire recevoir du HTML
                success : function(retour, statut){
                    //alert(retour);//debug
                    $("#emplacementRecherche").html(retour);
                    //alert(retour);
                },
                error : function(resultat, statut, erreur){
                    //alert(resultat);//debug
                    alert("erreur!");
                }
            });
        }


    });
    //************************RETIRE LES RECHERCHE
    $("#recherche").keyup(function(){
        var texte = $("#recherche").val();
        if( texte.length == 0){
            $("#emplacementRecherche").html("<span></span>");
        }
        else{
            //on fait rien
        }

    });

});