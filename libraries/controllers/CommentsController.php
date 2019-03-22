<?php

require_once 'Controller.php';

class CommentsController extends Controller
{
    protected $modelName = "CommentsModel";

    public function save()
    {
        Request::redirectIfNotSubmitted('index.php');

        if (!Session::isConnected()) {
            $this->redirectWithError(
                "index.php",
                "Vous devez être connecté pour cette action"
            );
        }

        $content = Request::get('content', Request::SAFE);
        $status_id = Request::get('status_id', Request::INT);
        $user_id = $_SESSION['user']['id'];
        $createdAt = date('Y-m-d H:i:s');

        if (!$content || !$status_id) {
            $this->redirectBackWithError("Formulaire invalide, mal rempli !");
        }

        $data = compact('content', 'status_id', 'user_id', 'createdAt');

        $this->model->insert($data);

        $this->redirectBackWithSuccess("Commentaire ajouté avec succès !");
    }
}
