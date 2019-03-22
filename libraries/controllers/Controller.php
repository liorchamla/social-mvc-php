<?php

/**
 * LA CLASSE DE BASE D'UN CONTROLLER
 * ---------------------------------
 * Elle est abstraite car un Controller de rien ça veut rien dire. On ne veut pas que quelqu'un puisse un jour se dire "Allez, je créé un Controller sans préciser de quoi je parle".
 *
 * Elle ne sert qu'à avoir les méthodes et les comportements de base communs à tous les controllers ! Elle ne doit donc pas être utilisée telle quelle.
 *
 * Il faut obligatoirement en hériter dans une autre classe qui, elle, précisera plus de quoi on parle (des utilisateurs ? des status ? des commentaires ?)
 *
 * LES PROPRIETES :
 * ---------------------
 * $model représente l'objet Model à utiliser pour nos requêtes
 * $modelName représente le nom de l'objet Model à créer avant toute action sur un controller
 *
 * LES METHODES :
 * ----------------------
 * - Le constructeur permet de mettre en place le model ou de faire une exception si on le model indiqué n'existe pas !
 * - La méthode view() permet d'afficher une vue avec le header et le footer
 * - Les méthodes redirectWithError, redirectWithSuccess, etc ne sont que des raccourcis pour pas se faire chier quand on veut rediriger :-)
 */
abstract class Controller
{
    /**
     * C'est l'objet Model qui servira à toutes nos actions dans un controller, c'est lui qui fait le lien avec une table de la base de données
     *
     * Par exemple, dans le UsersController, cette propriété contiendra un UsersModel, dans le StatusController, cette propriété contiendra un StatusModel
     *
     * Donc dans toutes les fonctions d'un controller, on peut appeler $this->model pour pouvoir manipuler les données de la table facilement !
     *
     * Le model contenu dans la propriété dépend exclusivement de l'autre propriété $modelName (voir la description)
     *
     * @var Model
     */
    protected $model;

    /**
     * C'est le nom de la classe Model qu'on veut dans $this->model (la propriété ci-dessus)
     *
     * Exemple : si $modelName contient "UsersModel", alors $model contiendra un objet de la classe UsersModel
     *
     * Comme il est nécessaire à tous les Controller de posséder un model, si cette donnée n'est pas renseignée quand on construit un controller (par exemple, quand on fait $controller = new UsersController() et que dans la classe
     * UsersController on n'a pas précisé de $modelName) alors il y aura une erreur
     *
     * @var string
     */
    protected $modelName;

    /**
     * Le constructeur a pour seul but de vérifier la validité du model demandé et de créer un objet issu de la classe demandée
     */
    public function __construct()
    {
        // 1. Vérifier que le développeur a bien renseigné le nom d'un model
        if (empty($this->modelName)) {
            // Si le développeur n'a pas fourni dans sa classe de valeur pour $modelName, on fait une grosse bonne vieille erreur
            throw new Exception('Vous avez oublié de fournir un <em>protected $modelName</em> dans la classe ' . get_called_class() . " hors il est obligatoire de fournir le nom du Model à utiliser !");
        }

        // 2. Vérifier si le model existe
        $chemin = "libraries/models/{$this->modelName}.php";
        // Si $this->modelName contient "UsersModel", ça donne "libraries/models/UsersModel.php"
        if (!file_exists($chemin)) {
            // Si le fichier n'existe pas, on fait une nouvelle erreur
            throw new Exception("Le model défini dans " . get_called_class() . " ({$this->modelName}) n'existe pas ! Nous n'avons pas trouvé le fichier qui aurait du se trouver ici : $chemin !");
        }

        // Si tout s'est bien passé jusqu'ici, on peut donc créer le model et le stocker dans $this->model
        require_once $chemin;
        $this->model = new $this->modelName();
        // Si $this->modelName contient UsersModel, ça donne $this->model = new UsersModel()
        // Si $this->modelName contient StatusModel, ça donne $this->model = new StatusModel()
    }

    /**
     * La fonction view() permet d'afficher un template PHTML avec le header.phtml et le footer.phtml qui l'accompagnent.
     *
     * ATTENTION : C'est une fonction PHP, elle ne connait donc pas les variables qui ont été déclarées en dehors d'elle même.
     * Elle sera donc incapable de transmettre les variables au sein des PHTML si elles ne sont pas envoyées dans le paramètre $variables sous la forme d'un tableau associatif
     *
     * Exemple : si notre PHTML travaille avec 3 variables qui s'appellent $prenom, $nom et $age, il faut absolument que le tableau $variables passé en paramètres
     * possède ces 3 clés, comme suit :
     * [
     *  'prenom' => 'Lior',
     *  'nom' => 'Chamla',
     *  'age' => 32
     * ]
     *
     * @param string $template Le chemin vers le fichier PHTML, sans l'extension .phtml
     * @param array $variables Le tableau associatif contenant les variables utilisées dans le template PHTML
     * @return void
     */
    protected function view(string $template, array $variables = [])
    {
        /**
         * EXTRACTION DES VARIABLES :
         * --------------------------
         * La première chose à faire ici c'est créer des variables qui seront équivalentes
         * aux clés qui se trouvent dans le tableau $variables.
         *
         * Exemple, si le tableau $variables contient deux clés :
         * [
         *  'prenom' => 'Lior',
         *  'nom' => 'Chamla'
         * ]
         *
         * Il faut qu'on ait 2 variables correspondantes :
         * $prenom = 'Lior';
         * $nom = 'Chamla';
         *
         * C'est ce que permet de faire la fonction extract()
         */
        extract($variables);

        // Inclusion du header
        require_once 'templates/partials/header.phtml';

        // Inclusion du fichier principal
        // Exemple : si $template contient "users/form-login", alors on inclus "templates/users/form-login.phtml"
        require_once "templates/$template.phtml";

        // Inclusion du footer
        require_once 'templates/partials/footer.phtml';
    }

    /**
     * Permet de rediriger vers une $url avec un $message d'erreur
     *
     * @param string $url
     * @param string $message
     * @return void
     */
    protected function redirectWithError(string $url, string $message)
    {
        Session::addFlash('error', $message);
        Http::redirect($url);
    }

    /**
     * Permet de rediriger vers une $url avec un $message de succès
     *
     * @param string $url
     * @param string $message
     * @return void
     */
    protected function redirectWithSuccess(string $url, string $message)
    {
        Session::addFlash('success', $message);
        Http::redirect($url);
    }

    /**
     * Permet de rediriger vers la page précédente avec un $message d'erreur
     *
     * @param string $message
     * @return void
     */
    protected function redirectBackWithError(string $message)
    {
        $url = $_SERVER['HTTP_REFERER'];
        $this->redirectWithError($url, $message);
    }

    /**
     * Permet de rediriger vers la page précédente avec un $message de succès
     *
     * @param string $message
     * @return void
     */
    protected function redirectBackWithSuccess(string $message)
    {
        $url = $_SERVER['HTTP_REFERER'];
        $this->redirectWithSuccess($url, $message);
    }
}
