<?php

/**
 * CLASSE DE GESTION DE LA SESSION (Y COMPRIS LES MESSAGES D'ERREUR !)
 * ---------------------------------
 * Cette classe donne toutes les méthodes utiles pour travailler sur la session.
 *
 * Ses méthodes sont statiques de façon à ce qu'on n'ait pas besoin de créer un objet issu de cette classe pour en utiliser les méthodes comme par exemple :
 *
 * $session = new Session();
 * $session->addFlash('error', "un message d'erreur");
 *
 * On peut directement appeler les méthodes sur la classe elle-même :
 *
 * Session::addFlash('error', "un message d'erreur")
 *
 * C'est beaucoup plus simple / rapide / clair !
 *
 * Voilà l'utilité des méthodes déclarées comme static !
 */
class Session
{
    /**
     * Permet de savoir si l'utilisateur est connecté ou non
     *
     * @return boolean
     */
    public static function isConnected(): bool
    {
        return !empty($_SESSION['connected']);
    }

    /**
     * Permet de mettre en place la session pour un utilisateur donné
     *
     * @param array $user
     * @return void
     */
    public static function connect(array $user)
    {
        $_SESSION['connected'] = true;
        $_SESSION['user'] = $user;
    }

    /**
     * Permet de supprimer les infos de connexion dans la session
     *
     * @return void
     */
    public static function disconnect()
    {
        $_SESSION['connected'] = false;
        $_SESSION['user'] = null;
    }

    /**
     * Permet d'ajouter un message Flash
     *
     * @param string $type
     * @param string $message
     * @return void
     */
    public static function addFlash(string $type, string $message)
    {
        if (empty($_SESSION['messages'])) {
            $_SESSION['messages'] = [
                'error' => [],
                'success' => [],
            ];
        }
        $_SESSION['messages'][$type][] = $message;
    }

    /**
     * Permet de récupérer tout en supprimant les messages d'un certain type
     *
     * @param string $type
     * @return array
     */
    public static function getFlashes(string $type): array
    {
        if (empty($_SESSION['messages'])) {
            return [];
        }

        $messages = $_SESSION['messages'][$type];

        $_SESSION['messages'][$type] = [];

        return $messages;
    }

    /**
     * Permet de savoir si il existe des messages d'un certain type
     *
     * @param string $type
     * @return boolean
     */
    public static function hasFlashes(string $type): bool
    {
        if (empty($_SESSION['messages'])) {
            return false;
        }

        return !empty($_SESSION['messages'][$type]);
    }

    /**
     * Permet de savoir si l'utilisateur actuellement connecté est celui qu'on
     * envoi en paramètre
     *
     * @param integer $user_id
     * @return boolean
     */
    public static function isActualUser(int $user_id)
    {
        /**
         * EXPLICATION DU MOT self :
         * -------------------------
         * Ici je suis dans une méthode static, je ne peux donc pas utiliser $this car lorsque cette fonction sera appelée, elle le sera sur la classe Session et non sur un objet de la classe Session.
         *
         * $this représente un objet pas une classe.
         *
         * Ici je souhaite appeler une autre méthode static au sein de la même classe, j'utilise donc self::maMethode() et non pas  $this->maMethode()
         *
         */
        if (!self::isConnected()) {
            return false;
        }

        return $user_id == $_SESSION['user']['id'];
    }
}
