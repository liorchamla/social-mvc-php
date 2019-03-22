<?php

require_once "Model.php";

/**
 * MODEL DES STATUS
 * -----------------
 * Cette classe permet d'accéder à la table des status. Elle dispose de toutes les fonctionalités
 * que possède la classe Model à savoir :
 * - Sélectionner tous les status (findAll())
 * - Sélectionner un status (find($id))
 * - Insérer un nouveau status (insert($data))
 * - Mettre à jour un status (update($data))
 * - Supprimer un status (delete($id))
 */
class StatusModel extends Model
{
    /**
     * OBLIGATOIRE : Le nom de la table que l'on souhaite traiter avec ce model
     *
     * @var string
     */
    protected $table = 'status';

    /**
     * Redéfinition de la fonction findAll() : pourquoi ?
     * ---------------------------------------
     * Grâce à l'héritage, la fonction findAll existe déjà dans notre classe sans qu'on n'ait rien à faire.
     *
     * Le problème est que la fonction findAll dont on hérite n'est pas assez précise, ne répond pas complètement à nos attentes
     *
     * On peut donc la redéfinir pour la faire faire autre chose !
     *
     * @return array
     */
    public function findAll(): array
    {
        $query = $this->db->prepare('
            SELECT
                status.*,
                users.firstName,
                users.lastName,
                users.avatar,
                COUNT(comments.id) AS comments
            FROM status
            JOIN users ON status.user_id = users.id
            LEFT JOIN comments ON comments.status_id = status.id
            GROUP BY status.id
            ORDER BY status.createdAt DESC
        ');
        $query->execute();

        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * Redéfinition de la fonction find: même raison que findAll
     *
     * @param integer $id
     * @return void
     */
    public function find(int $id)
    {
        $query = $this->db->prepare('
            SELECT
                status.*,
                users.firstName,
                users.lastName,
                users.avatar,
                COUNT(comments.id) AS comments
            FROM status
            JOIN users ON status.user_id = users.id
            LEFT JOIN comments ON comments.status_id = status.id
            WHERE status.id = :id
            GROUP BY status.id
            ORDER BY status.createdAt DESC
        ');
        $query->execute(['id' => $id]);

        return $query->fetch(PDO::FETCH_ASSOC);
    }
}
