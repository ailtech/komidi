<?php
/**
 * Class Mail qui hérite de la class db
 * @author Alexandre
 * @since 12/12/16
 * @version 1
 */
class Mail extends db
{
    /**
     * Attribut désignant la personne a qui envoyer le mail.
     * @var string $to Destinataire du mail.
     */
    protected $to;
    /**
     * Attribut désignant le sujet du mail.
     * @var string $sujet Objet/sujet du mail.
     */
    protected $sujet;
    /**
     * Attribut désignant le message que l'on souhaite envoyée.
     * @var string $message Message a envoyée.
     */
    protected $message;
    /**
     * Attribut désignant les entête a utiliser pour l'envoie du mail.
     * @var string $headers entête du mail.
     */
    protected $headers;

    /**
     * Le Constructeur De Mail.
     * @param string $to_p Destinataire du mail
     * @see Mail::$to
     * @param string $sujet_p Sujet/Objet de mail.
     * @see Mail::$sujet
     * @param string $message_p Message du mail.
     * @see  Mail::$message
     * @param string $headers_p entête du mail
     * @see Mail::$headers
     */
    function Mail($to_p, $sujet_p, $message_p, $headers_p){
        $this->to = $to_p;
        $this->sujet = $sujet_p;
        $this->message = $message_p;
        $this->headers = $headers_p;
        //on fait appelle au constructeur mére pour disposer de la connection a la bdd
        parent::__construct();
    }

    /**
     * Méthode qui envoye un mail.
     * @param string $civilite Civilite de la personne.
     * @param string $nom Nom de la personne.
     * @param string $prenom Prenom de la personne.
     * @param string $ville Ville de la personne.
     * @param string $cde Code postal de la personne.
     * @param string $email Email de la personne.
     * @return bool Retourne true si email pu être envoyer ou enregistrer dans la base de donnée et false sinon.
     */
    public function envoyeMail( $civilite, $nom, $prenom,$ville, $cde, $email ){
        // si on a pu envoyer le mail ou enregistrer dans la bdd on reourn true
        if( mail( $this->getTo(), $this->getSujet(), $this->getMessage(), $this->getHeaders() ) or $this->enregistrementMail($civilite, $nom, $prenom,$ville, $cde, $email) )
        {
            return true;
        }
        else //sinon on retourne false
        {
            return false;
        }
    }

    /**
     * Methode qui enregistre Le message de la personne dans la BDD.
     * @param string $civilite Civilite de la personne.
     * @param string $nom Nom de la personne.
     * @param string $prenom Prenom de la personne.
     * @param string $ville Ville de la personne.
     * @param string $cde Code postal de la personne.
     * @param string $email Email de la personne.
     * @return bool Retourne true si le message a pu être enregistrer et false sinon.
     */
    public function enregistrementMail($civilite, $nom, $prenom,$ville, $cde, $email){
        // On recupére le message de la personne
        $msg = $this->getMessage();
        // On écrit la requête
        $requete = "INSERT INTO kdi_contact(msg_civilite, msg_nom, msg_prenom, msg, msg_ville, msg_cde, msg_email, msg_date) 
                    VALUES (\"$civilite\",\"$nom\",\"$prenom\",\"$msg\",\"$ville\",\"$cde\",\"$email\",NOW());";
        //On prépare la requête
        $rst = $this->getCo()->prepare($requete);
        //On execute la requête
        if( $rst->execute() )
        {
            return true;// requête bien executée.
        }
        else
        {
            return false;// requête mal executée.
        }


    }
     /**
      * Getteur du Destinataire.
     * @return string Retourne le Destinataire du message.
      * @see Mail::$to
     */
    public function getTo()
    {
        return $this->to;
    }

    /**
     * Getteur de L'objet du mail.
     * @return string Retourne l'objet de mail.
     * @see Mail::$sujet
     */
    public function getSujet()
    {
        return $this->sujet;
    }

    /**
     * Getteur du message.
     * @return string Retourne le message.
     * @see Mail::$message
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Getteur de l'entête
     * @return string Retourne l'entête.
     * @see Mail::$headers
     */
    public function getHeaders()
    {
        return $this->headers;
    }

    /**
     * Setteur du Destinataire.
     * @param string $to
     * @see Mail::$to
     */
    public function setTo($to)
    {
        $this->to = $to;
    }

    /**
     * Setteur du sujet.
     * @param string $sujet
     * @see Mail::$sujet
     */
    public function setSujet($sujet)
    {
        $this->sujet = $sujet;
    }

    /**
     * Setteur du message
     * @param string $message
     * @see Mail::$message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }

    /**
     * Setteur du header
     * @param string $headers
     * @see Mail::$headers
     */
    public function setHeaders($headers)
    {
        $this->headers = $headers;
    }


}