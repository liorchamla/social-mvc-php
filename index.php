<?php

/**
 * PAGE UNIQUE DE CONTROLE DU SITE : TRES IMPORTANT A COMPRENDRE !
 * -----------------------------------------
 * C'est la seule page de notre site, elle est capable d'appeler n'importe quelle action
 * sur n'importe quel controller !
 *
 * Elle met en place la configuration, puis se lance dans le boulot !
 */

// On demande le fichier de configuration qui contient toutes les données importantes et les requires !
require_once 'configuration.php';

/**
 * CIBLAGE DU CONTROLLER A UTILISER
 * ------------------------------------
 * On regarde si dans l'URL ou dans le POST, un controller a été désigné
 * ATTENTION : si dans l'URL ou dans le POST controller=users, la classe à utiliser sera UsersController
 * si c'est controller=comments, alors la classe à utiliser sera CommentsController.
 *
 * On doit donc prendre l'info qu'on nous donne et travailler dessus pour passer par exemple de "users" à "UsersController"
 */
$controllerName = Request::get('controller');

// Si on ne nous a pas désigné de controller, on choisi par défaut le StatusController
if (!$controllerName) {
    $controllerName = "status";
}

// On construit le nom du controller, par exemple si on a "users", il faut arriver à "UsersController" :

// 1. S'assurer que le nom est tout en minuscules (si on nous donne "USeRS", on veut "users") grâce à strtolower()
$controllerName = strtolower($controllerName);

// 2. S'assurer que la première lettre soit en majuscules (si on a "users", on veut "Users") grâce à la fonction ucfirst()
$controllerName = ucfirst($controllerName);

// 3. On peut coller désormais le mot "Controller" à côté (si on a "Users", on veut "UsersController") avec une simple concaténation
$controllerName = $controllerName . "Controller";

// 4. On veut vérifier que le controller existe bel et bien dans un fichier classique :
$chemin = "libraries/controllers/$controllerName.php";
if (!file_exists($chemin)) {
    // Si le fichier n'existe pas, on affiche une erreur :
    Session::addFlash('error', "L'action que vous avez demandé n'existe pas !");
    Http::redirect('index.php');
}

// 5. Tout est bon, on peut require le controller et ensuite le créer :
require_once $chemin;

/**
 * TRES IMPORTANT : pourquoi utiliser un bloc try/catch ici ?
 * ------------------------------------
 * A partir du moment où on va instancier un controller et lancer une tâche, des exceptions (erreurs) vont potentiellement apparaitre :
 * - La base de données est indisponible,
 * - Le temps de réponse de celle-ci a été dépassé,
 * - Une table a changé de nom et on ne trouve plus les informations
 * - ....
 * Il faut donc gérer cette exception et ne pas la laisser apparaitre telle quelle aux yeux
 * des visiteurs.
 *
 * Je choisi ici d'afficher une page spécifique pour l'erreur :-)
 */
try {
    $controller = new $controllerName();
    // Si $controllerName contient "UsersController",
    // ça donne donc $controller = new UsersController()
    // Si $controllerName  contient "TotoController", ça donne :
    // $controller = new TotoController();

    /**
     * ON DETERMINE LA TÂCHE A EXECUTER SUR LE CONTROLLER
     * ---------------------------------------------------
     * On veut récupérer la tâche que l'utilisateur a renseigné dans l'URL ou dans le post et qui s'appelle "task"
     */

    $task = Request::get('task');

    // 1. Si il n'y a pas de task dans l'URL ou dans le POST
    if (!$task) {
        // On en choisi une par défaut (l'index, la liste)
        $task = "index";
    }

    // 2. On doit vérifier que cette fonction existe sur le controller en question
    // On fait ça avec la fonction method_exists() qui prend en paramètres l'objet sur lequel on
    // veut voir si la méthode existe, puis le nom de la méthode qu'on veut tester
    // elle renvoie TRUE si l'objet possède bien cette méthode, et FALSE si l'objet ne la contient pas
    if (!method_exists($controller, $task)) {
        // Si le controller ne connait pas cette task, on affiche une erreur
        Session::addFlash('error', "La tâche que vous avez demandé n'a pas été trouvé !");
        Http::redirect("index.php");
    }

    /**
     * CA Y EST ! ON PEUT Y ALLER
     * --------------------------
     * Tous les cas pourris ont été testé et controllés, on est donc sur, si on arrive jusqu'ici
     * que tout est bon, on peut lancer l'action demandée sur le controller demandé
     */
    $controller->$task();
    // si $task contient "index", ça donne : $controller->index();
    // si $task contient "save", ça donne : $controller->save();
    // ... parfait :D

} catch (Exception $e) {
    // Si il y a eu la moindre erreur :
    $code = $e->getCode();
    $message = $e->getMessage();
    require_once 'templates/partials/header.phtml';
    require_once 'templates/error.phtml';
    require_once 'templates/partials/footer.phtml';
}
