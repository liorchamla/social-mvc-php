<?php

/**
 * FABRIQUE DE CONNEXION A LA BASE DE DONNEES (SINGLETON)
 * ----------------------------------------
 * On a très souvent besoin d'une connexion à la base de données dans notre code,
 * plutôt que de recréer une connexion à chaque fois (new PDO()), il vaut mieux créer
 * une seule connexion et qui sera disponible tout le long de l'exécution.
 *
 * Il suffit d'appeler la méthode static getInstance() de la classe Database :
 * $maConnexion = Database::getInstance()
 *
 * La classe est abstraite car on ne veut pas qu'un développeur distrait puisse créer
 * un objet issu de cette classe.
 */
abstract class Database
{
    /**
     * L'instance de PDO qui servira à tout notre code
     *
     * @var PDO
     */
    private static $pdo;

    /**
     * Fabrication d'une connexion PDO en Singleton
     * -----------------------------------
     * Dans cette méthode, on va vérifier si elle a déjà été appelée et si un objet
     * PDO existe déjà dans la propriété statique $pdo.
     *
     * Si il n'y a pas encore de connexion à la base de données, on la créé en se servant
     * des paramètres du fichier de configuration.
     *
     * Dans tous les cas, on retourne l'objet PDO créé auparavant ou à l'instant.
     *
     * @return PDO
     */
    public static function getInstance(): PDO
    {
        if (empty(self::$pdo)) {
            $host = DB_HOST;
            $name = DB_NAME;
            $user = DB_USER;
            $password = DB_PASSWORD;

            self::$pdo = new PDO(
                "mysql:host=$host;dbname=$name;charset=utf8",
                $user,
                $password,
                [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                ]
            );
        }

        return self::$pdo;
    }
}
