<?php

require_once "Model.php";

/**
 * MODEL DES USERS
 * -----------------
 * Cette classe permet d'accéder à la table des users. Elle dispose de toutes les fonctionalités
 * que possède la classe Model à savoir :
 * - Sélectionner tous les users (findAll())
 * - Sélectionner un users (find($id))
 * - Insérer un nouveau users (insert($data))
 * - Mettre à jour un users (update($data))
 * - Supprimer un users (delete($id))
 */
class UsersModel extends Model
{
    protected $table = "users";

    /**
     * Permet de retrouver un utilisateur grâce à son email
     *
     * Cette fonction n'existe pas dans la classe Model, on doit donc la créer ici par nous même !
     *
     * @param string $email
     * @return array|bool
     */
    public function findByEmail(string $email)
    {
        $query = $this->db->prepare('
            SELECT * FROM users WHERE email = :email
        ');

        $query->execute([
            ':email' => $email,
        ]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
