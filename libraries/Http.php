<?php

/**
 * CLASSE QUI PERMET DE GERER LE PROTOCOLE HTTP
 * ------------------------------
 * Le but de cette classe est de fournir des méthodes simples et efficaces concernant
 * le protocole HTTP.
 *
 * Ses méthodes sont statiques de façon à ce qu'on n'ait pas besoin de créer un objet issu de cette classe pour en utiliser les méthodes comme par exemple :
 *
 * $http = new Http();
 * $http->redirect('index.php');
 *
 * On peut directement appeler les méthodes sur la classe elle-même :
 *
 * Http::redirect('index.php');
 *
 * C'est beaucoup plus simple / rapide / clair !
 *
 * Voilà l'utilité des méthodes déclarées comme static !
 */
class Http
{
    /**
     * Permet de rediriger l'utilisateur vers une URL
     *
     * @param string $url
     * @return void
     */
    public static function redirect(string $url)
    {
        header("Location: $url");
        exit();
    }

    /**
     * Permet de rediriger vers la page précédente
     *
     * @return void
     */
    public static function redirectBack()
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
        self::redirect($_SERVER['HTTP_REFERER']);
    }

}
