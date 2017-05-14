<?php

/**
 * Class Controleur permet d'appeller les vues
 * @since 25/10/16
 * @version 2
 * @author Alexandre
 */
class Controleur{
    /**
     * L'attribue $path permet de préciser ou ce trouve l'emplacement des vues
     * @var string $path emplacement des vues dans arborescence.
     */
    private $path;

    /**
     * Constructeur de controleur.
     * @param string $path_p Prend en paramétre l'emplacement des vues dans l'arborescence.
     */
    function Controleur($path_p)
    {
        $this->path = $path_p;
    }

    /**
     * Setteur du l'emplacement des vues dans l'arborescence
     * @param string $path emplacement des vues.
     * @see Controleur::$path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * Getteur de l'emplacement des vues.
     * @return string Retourne l'emplacement des vues dans l'arborescence.
     * @see Controleur::$path
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     *Fait appelle a la page d' acceuil
     * @see Controleur::getPath()
     */
    public function call_accueil()
    {

        require $this->getPath().'vueAccueil.php';
    }

    /**
     *Fait appelle a la page login
     * @see Controleur::getPath()
     */
    public function call_login()
    {
        require $this->getPath().'vueLogin.php';
    }

    /**
     *Fait appelle a la page erreur
     * @see Controleur::getPath()
     */
    public function call_erreur()
    {
        require $this->getPath().'vueErreur.php';
    }

    /**
     *Fait appelle a la page inscription
     * @see Controleur::getPath()
     */
    public function call_inscription()
    {
        require $this->getPath().'vueInscription.php';
    }

    /**
     *Fait appelle a la page demade inscription
     * @see Controleur::getPath()
     */
    public function call_demandeInscription()
    {
        require $this->getPath().'vueDemandeInscription.php';
    }

    /**
     *Fait appelle a la page vueSpectacle
     * @see Controleur::getPath()
     */
    public function call_spectacle()
    {
        require $this->getPath().'vueSpectacle.php';
    }

    /**
     *Fait appelle a la page vue concontact
     * @see Controleur::getPath()
     */
    public function call_contact()
    {
        require $this->getPath().'vueContact.php';
    }

    /**
     *Fait appelle a la page notation
     * @see Controleur::getPath()
     */
    public function call_noter()
    {
        require $this->getPath().'vueNoter.php';
    }

    /**
     *Fait appelle a la page deconnection
     * @see Controleur::getPath()
     */
    public function call_deco()
    {
        require $this->getPath().'vueDeconnection.php';
    }

    /**
     *Fait appelle a la page identification
     * @see Controleur::getPath()
     */
    public function call_connexion()
    {
        require $this->getPath().'vueIdentification.php';
    }

    /**
     *Fait appelle a la page recherche
     * @see Controleur::getPath()
     */
    public function call_recherche()
    {
        require $this->getPath().'vueRecherche.php';
    }

    /**
     *Fait appelle a la page demandede contact
     * @see Controleur::getPath()
     */
    public function call_demande_contact()
    {
        require $this->getPath().'actionContact.php';
    }
}