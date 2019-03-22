<?php

require_once 'Controller.php';

// Require spécifique, on utilise le model des commentaires dans la fonction show()
// On doit donc faire un require particulier ici.
require_once 'libraries/models/CommentsModel.php';
// Notez que ce n'est pas le cas pour le model des status qui sera automatiquement "requiré" dans la classe Controller abstraite (cf. Constructeur de la classe Controller)

class StatusController extends Controller
{
    protected $modelName = "StatusModel";

    public function index()
    {
        // Récupération des status
        $status = $this->model->findAll();

        // Affichage HTML
        $this->view('status/index', [
            'status' => $status,
        ]);
    }

    public function show()
    {
        $id = Request::get('id', Request::INT);

        if (!$id) {
            $this->redirectWithError(
                "index.php",
                "Vous devez préciser de quel statut vous voulez voir les détails !"
            );
        }

        $status = $this->model->find($id);

        $commentsModel = new CommentsModel();
        $comments = $commentsModel->findAllByStatusId($id);

        // Affichage HTML
        $this->view('status/show', [
            'status' => $status,
            'comments' => $comments,
        ]);
    }

    public function edit()
    {
        // 0. Vérifier que le mec est connecté ou erreur et redirection vers l'index
        if (!Session::isConnected()) {
            Session::addFlash('error', "Vous devez être connecté pour ce type d'opération");
            Http::redirect("index.php");
        }

        // 1. Vérifier que la page a bien reçu un id en GET sinon rediriger vers l'index
        $id = Request::get('id', Request::INT);

        if (!$id) {
            $this->redirectWithError(
                "index.php",
                "Vous devez préciser le statut que vous souhaitez modifier"
            );
        }

        // 2. Récupérer les infos du statut grâce au model correspondant et à sa fonction find()
        $status = $this->model->find($id);

        // 3. Si la récupération ne renvoi rien, erreur et redirection vers l'index
        if (!$status) {
            $this->redirectWithError(
                "index.php",
                "Le statut $id n'a pas été trouvé !"
            );
        }

        // 4. Si l'utilisateur actuellement connecté ne correspond pas à l'auteur du statut (user_id)
        // Message d'erreur et redirection vers l'index
        if (!Session::isActualUser($status['user_id'])) {
            $this->redirectWithError(
                "index.php",
                "Vous n'êtes pas propriétaire de ce statut !"
            );
        }

        // Affichage HTML
        $this->view(
            "status/edit",
            [
                'status' => $status,
            ]
        );
    }

    public function update()
    {
        // 1. Redirection si formulaire (POST) vide :
        Request::redirectIfNotSubmitted('index.php');

        // 2. Redirection si utilisateur non connecté
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Il faut être connecté pour pourvoir faire cette opération !"
            );
        }

        // 3. Extraction du POST et redirection si champs invalides
        $id = Request::get('id', Request::INT);
        $content = Request::get('content', Request::SAFE);

        if (!$id || !$content) {
            $this->redirectBackWithError('Le formulaire est mal rempli !');
        }

        // 4. Création du model et récupération du status en question
        $status = $this->model->find($id);

        // 5. Redirection si pas de statut trouvé pour cet ID
        if (!$status) {
            $this->redirectBackWithError("Vous essayez de modifier un statut qui n'existe pas ...");
        }

        // 6. Redirection si le statut n'appartient pas à l'utilisateur actuellement connecté
        if (!Session::isActualUser($status['user_id'])) {
            $this->redirectBackWithError("Vous n'êtes pas le propriétaire de ce statut !");
        }

        // 7. Création du tableau des données à mettre à jour et requête
        $data = compact('id', 'content');
        $this->model->update($data);

        // 8. Redirection vers la page du status !
        $this->redirectWithSuccess(
            "index.php?controller=status&task=show&id=$id",
            "Statut modifié avec succès !"
        );
    }

    public function save()
    {
        // 1. Vérifier que le formulaire a été soumis, sinon => index.php
        Request::redirectIfNotSubmitted('index.php');

        // 1. Bis : Vérifier que l'utilisateur est bien connecté, sinon => index.php
        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez vous connecter pour ajouter un statut !"
            );
        }

        // 2. Extraction et vérification du champ "content" => back
        $content = Request::get('content', Request::SAFE);

        if (!$content) {
            $this->redirectBackWithError("Vous devez fournir le contenu de votre statut !");
        }

        // 3. Création du tableau contenant les données à insérer
        $data = [
            'content' => $content,
            'user_id' => $_SESSION['user']['id'],
            'createdAt' => date('Y-m-d H:i:s'),
        ];

        // 4. Insertion avec la méthode insert()
        $this->model->insert($data);

        // 5. Redirection vers l'index
        $this->redirectWithSuccess(
            "index.php",
            "Bravo, statut posté avec succès sur le réseau !"
        );
    }

}
