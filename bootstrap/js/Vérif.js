/**
 * Created by alexandre on 20/11/16.
 */
function surligne(champ, erreur){
    if(erreur)
        champ.style.backgroundColor = "#fba";
    else
        champ.style.backgroundColor = "#00FF00";
}

function verifPseudo(champ){
    if(champ.value.length < 5 || champ.value.length > 25){
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifPassword1(champ){
    if(champ.value.length < 6 || champ.value.length > 12){
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifPassword2(champ){
    var mdp1 = document.getElementById("mdp").value;
    var mdp2 = document.getElementById("mdpverif").value;
    if (mdp1 != mdp2){
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

function verifMail(champ){
    var regex = /^[a-zA-Z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
    if(!regex.test(champ.value)){
        surligne(champ, true);
        return false;
    }
    else
    {
        surligne(champ, false);
        return true;
    }
}

