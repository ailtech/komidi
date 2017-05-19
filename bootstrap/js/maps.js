// Fonction de gestion des erreurs
function errorHandler(error)
{
    // On log l'erreur sans l'afficher, permet simplement de débugger.
    console.log('Geolocation error : code '+ error.code +' - '+ error.message);

    // Affichage d'un message d'erreur plus "user friendly" pour l'utilisateur.
    alert('Une erreur est survenue durant la géolocalisation. Veuillez réessayer plus tard ou contacter le support.');
}

function InitMyMap(position) {
    // Coordonnées du point gps qui sera au centre de la carte
    var myLatlng = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
    var PosSalleSpec = new google.maps.LatLng(document.getElementById("lat").value, document.getElementById("long").value);
    // Carte centrée sur le point, zoom 10
    var myMapOptions = {
        zoom: 10,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    };

    // Création de la carte
    var myMap = new google.maps.Map(
        document.getElementById('map'),
        myMapOptions
    );

    // Création du Marker de l'utilisateur
    var myPos = new google.maps.Marker({
        // Coordonnées du marker
        position: myLatlng,
        map: myMap,
        title: "Vous êtes ici"
    });
    // Création du Marker de la salle
    var PosSalle = new google.maps.Marker({
        position: PosSalleSpec,
        map: myMap,
        title: "La salle"
    });

}

//$(document).ready(function() {
    // La géolocalisation est-elle prise en charge par le navigateur ?
    if(navigator.geolocation)
    {
        navigator.geolocation.getCurrentPosition(InitMyMap, errorHandler);
    }
    else
    {
        alert('Votre navigateur ne prend malheureusement pas en charge la géolocalisation.');
    }
//});

