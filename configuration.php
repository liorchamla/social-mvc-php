<?php

/**
 * FICHIER DE CONFIGURATION DU SITE !
 * ----------------------
 * On met en place ici tout ce qui sert à la configuration
 * On fait aussi tous les require_once importants !
 * Les models, les controllers, etc etc !
 *
 * Quiconque importe le fichier de configuration a donc accès à tout ce qui se trouve ici
 * y compris les require_once ;-)
 */

/**
 * MISE EN PLACE DE LA SESSION
 * ---------------------------
 * On le sait très bien, on aura besoin de la session dans ce site dans plus ou moins tous les fichiers
 * C'est donc une bonne pratique de la mettre en oeuvre tout de suite ici avant toute autre action
 *
 * Comprenez bien : le fichier configuration.php sera la première chose qui s'exécutera quand on appellera notre site.
 * On est donc surs que session_start() sera appelé tout le temps, et avant tout le reste !
 */
session_start();

/**
 * CONFIGURATION DE LA BASE DE DONNEES
 * -----------------------------------
 * Ca facilite l'évolution, le jour où on change de base de données ou que l'utilisateur
 * ou que le mot de passe change, on peut simplement modifier ce fichier
 * et hop ! Tout remarche à nouveau
 */
const DB_HOST = "localhost";
const DB_USER = "root";
const DB_PASSWORD = "troiswa";
const DB_NAME = "social";

/**
 * LES REQUIRES QUI SONT NECESSAIRES PARTOUT :
 * --------------------------------
 * C'est les require de base, on sait qu'on en a besoin partout.
 * Quiconque require ce fichier aura donc accès à Request, Session, et Http
 */

require_once 'libraries/Database.php';
require_once 'libraries/Request.php';
require_once 'libraries/Http.php';
require_once 'libraries/Session.php';
