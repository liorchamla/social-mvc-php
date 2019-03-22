<?php

require_once "Model.php";

/**
 * MODEL DES COMMENTS
 * -----------------
 * Cette classe permet d'accéder à la table des comments. Elle dispose de toutes les fonctionalités
 * que possède la classe Model à savoir :
 * - Sélectionner tous les comments (findAll())
 * - Sélectionner un comments (find($id))
 * - Insérer un nouveau comments (insert($data))
 * - Mettre à jour un comments (update($data))
 * - Supprimer un comments (delete($id))
 */
class CommentsModel extends Model
{
    protected $table = "comments";

    /**
     * Permet de récupérer les commentaires appartenant à un status
     *
     * @param integer $id
     * @return array
     */
    public function findAllByStatusId(int $id): array
    {
        $query = $this->db->prepare('
            SELECT comments.*, users.firstName, users.lastName, users.avatar
            FROM comments
            JOIN users ON users.id = comments.user_id
            WHERE comments.status_id = :id
            ORDER BY comments.createdAt DESC
        ');

        $query->execute(['id' => $id]);

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
}
