# komidi
Créer un système de notation en étoile.

1.
Importer le fichier baseDonneKomidiscope.sql dans votre serveur de base de donne ATTENTION dans le fichier il faut modifier 
les ligne 5 : CREATE USER 'komidi'@'localhost' IDENTIFIED BY 'azerty'; a la place de localhost l'adresse de votre serveur 
de base de donnee et a la place de azerty le mot de passe voulue.
ligne 5: GRANT INSERT,SELECT,UPDATE ON db_komidi. * TO 'komidi'@'localhost'; remplacer localhost par l'adrese de votre serveur.

2.Dans le fichier ./modele/db.class.php, il faut remplacer les ligne:
    ligne 23: protected $HOTE = "localhost"; Remplacer localhost par l'adresse du serveur.
    ligne 38: protected $USER = "root"; Remplacer root par le nom de l'utilisateur
    ligne 43: protected $MDP = "root"; Remplacer pâr le mot de passe de connection de la base de donnee
    
    
3.Dans le fichier ./include/fonction.php, il faut remplacer les ligne:
      ligne 94: $PARAM_hote ="localhost"; Remplacer localhost par l'adresse du serveur.
      ligne 97: $PARAM_utilisateur  ="root"; Remplacer root par le nom de l'utilisateur
      ligne 98: $PARAM_mot_passe    ="root"; Remplacer root par le mot de passe de connection de la base de donnee
     
4.Dans le fichier ./vue/admin/include/config.php, il faut remplacer les ligne:
        ligne 12: $PARAM_hote ="localhost"; Remplacer localhost par l'adresse du serveur.
        ligne 15: $PARAM_utilisateur  ="root"; Remplacer root par le nom de l'utilisateur
        ligne 16: $PARAM_mot_passe    ="root"; Remplacer root par le mot de passe de connection de la base de donnee

5.Dans le fichier ./vue/admin/include/fonction.php, il faut remplacer les ligne:
        ligne 118: $PARAM_hote ="localhost"; Remplacer localhost par l'adresse du serveur.
        ligne 121: $PARAM_utilisateur  ="root"; Remplacer root par le nom de l'utilisateur
        ligne 122: $PARAM_mot_passe    ="root"; Remplacer root par le mot de passe de connection de la base de donnee
        
6.Dans le fichier ./vue/admin/templates/header.php, il faut remplacer les ligne:
        ligne 9: $PARAM_hote ="localhost"; Remplacer localhost par l'adresse du serveur.
        ligne 12: $PARAM_utilisateur  ="root"; Remplacer root par le nom de l'utilisateur
        ligne 13: $PARAM_mot_passe    ="root"; Remplacer root par le mot de passe de connection de la base de donnee
        
7.Dans le fichier ./fonction.php, il faut remplacer les ligne:
        ligne 118: $PARAM_hote ="localhost"; Remplacer localhost par l'adresse du serveur.
        ligne 121: $PARAM_utilisateur  ="root"; Remplacer root par le nom de l'utilisateur
        ligne 122: $PARAM_mot_passe    ="root"; Remplacer root par le mot de passe de connection de la base de donnee