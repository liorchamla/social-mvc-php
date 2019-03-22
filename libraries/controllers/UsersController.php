<?php

require_once 'Controller.php';

class UsersController extends Controller
{

    protected $modelName = "UsersModel";

    public function register()
    {
        // On affiche le template users/register.phtml
        $this->view('users/register');
    }

    public function formLogin()
    {
        // On affiche le template users/form-login.phtml
        $this->view('users/form-login');
    }

    public function save()
    {
        // 1. Redirection vers l'index si le formulaire n'a pas été soumis
        Request::redirectIfNotSubmitted('index.php');

        // 2. Extraction des informations du POST et redirection si le formulaire est mal rempli
        $firstName = Request::get('firstName', Request::SAFE);
        $lastName = Request::get('lastName', Request::SAFE);
        $email = Request::get('email', Request::EMAIL);
        $password = Request::get('password');
        $passwordConfirm = Request::get('passwordConfirm');
        $description = Request::get('description', Request::SAFE);
        $avatar = Request::get('avatar', FILTER_VALIDATE_URL);

        if (!$firstName || !$lastName || !$email || !$password || !$passwordConfirm || !$avatar) {
            $this->redirectBackWithError("Votre formulaire n'était pas complet !");
        }

        // 3. Vérification qu'aucun utilisateur n'existe déjà avec cet email
        // Je demande donc à mon model (le UsersModel, chargé des requêtes SQL vers la table des users)
        $user = $this->model->findByEmail($email);

        // Si un utilisateur existe avec cet email, alors on affiche une erreur
        if ($user) {
            $this->redirectBackWithError("Un compte existe déjà avec cette adresse email");
        }

        // 4. Vérification que les mot de passe sont identiques (password et passwordConfirm)
        if ($password != $passwordConfirm) {
            $this->redirectBackWithError("Les deux mots de passe fournis ne correspondent pas !");
        }

        // 5. Création du hash pour le password et insertion dans la table users
        $password = password_hash($password, PASSWORD_DEFAULT);

        // Création du tableau associatif avec les données
        $data = [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'password' => $password,
            'email' => $email,
            'avatar' => $avatar,
            'description' => $description,
        ];
        // Equivalent à : $data = compact('firstName', 'lastName', 'password', 'email', 'avatar', 'description');

        // On demande à notre model (le UsersModel, chargé des requêtes vers la table des users)
        $this->model->insert($data);

        // 6. Redirection vers la page de connexion
        $this->redirectWithSuccess(
            "index.php?controller=users&task=formLogin",
            "Bien ouej, vous pouvez désormais vous connecter !"
        );
    }

    public function login()
    {
        // 1) Vérification si POST sinon redirection vers index.php
        Request::redirectIfNotSubmitted('index.php');

        // 2) Extraction des données du POST
        $email = Request::get('email', Request::EMAIL);
        $password = Request::get('password');

        // 3) Vérification des données extraites, sinon redirection vers page précédente
        if (!$email || !$password) {
            $this->redirectBackWithError("Le formulaire a été mal rempli");
        }

        // 4) Récupération de l'utilisateur correspond à l'email donné, si pas d'utilisateur, redirection vers la page précédente
        $user = $this->model->findByEmail($email);

        if (!$user) {
            $this->redirectBackWithError("Aucun compte utilisateur ne possède cette adresse email");
        }

        // 5) Vérification du mot de passe hashé, sinon redirection vers la page précédente
        $correspondance = password_verify($password, $user['password']);

        if (!$correspondance) {
            $this->redirectBackWithError("Le mot de passe ne correspond au compte utilisateur trouvé");
        }

        // 6) Mise en place de la session de l'utilisateur avec toutes ses données
        Session::connect($user);

        // 7) Redirection vers l'index.php
        $this->redirectWithSuccess(
            "index.php",
            "Bravo <strong>$user[firstName]</strong>, vous êtes désormais connecté(e) au réseau !"
        );
    }

    public function logout()
    {
        Session::disconnect();

        $this->redirectWithSuccess(
            "index.php",
            "Vous êtes désormais déconnecté !"
        );
    }

}
