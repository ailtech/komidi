/**
 * Created by alexandre on 16/05/17.
 */
//recupere erreur
function erreur(error) {
    switch(error.code) {
        case error.PERMISSION_DENIED:
            //alert("Vous avez choisi de refuser la geolocalisation.");
            //$("#etat").html($("#etat").html()+"Vous avez choisi de refuser la geolocalisation<br>");
            toStringInfo("Vous avez choisi de refuser la geolocalisation.");
            break;
        case error.POSITION_UNAVAILABLE:
            //alert("Impossible d'avoir des information sur votre localisation.");
            //$("#etat").html($("#etat").html()+"Impossible d'avoir des information sur votre localisation.<br>");
            toStringInfo("Impossible d'avoir des information sur votre localisation.");
            break;
        case error.TIMEOUT:
            //alert("Temps de geolocalisation dépassée.");
            //$("#etat").html($("#etat").html()+"Temps de geolocalisation dépassée.<br>");
            toStringInfo("Temps de geolocalisation dépassée.");
            break;
        case error.UNKNOWN_ERROR:
            //alert("Une erreur inconnue est survenue.");
            //$("#etat").html($("#etat").html()+"Une erreur inconnue est survenue.<br>");
            toStringInfo("Une erreur inconnue est survenue.");
            break;
    }
}

//affiche tracer
function tracer(position){
    var maLat = position.coords.latitude;
    var maLon = position.coords.longitude;

    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 9,
        center: {lat: maLat, lng: maLon},
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
}

//verifie si navigation supporter
if(navigator.geolocation)
{

    navigator.geolocation.getCurrentPosition(tracer, erreur);
}
else
{
    alert("La Geolocation n\'est pas supporter par votre apareil");
}