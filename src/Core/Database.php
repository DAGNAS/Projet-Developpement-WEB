<?php
namespace App\Core;
/**
 * This interface represents a database.
 */
interface Database {

    /**
     * Prépare une requête SQL.
     *
     * @param string $sql La requête SQL à préparer.
     * @return PDOStatement L'objet de requête préparée.
     */
    public function prepare($sql);

    public function setQuery($query, $location, $sector, $type);

    public function getUserInfoByMail($email);

    public function updatePassword($email, $hashedPassword);

    public function SaveTimeLastConnexion($email);

    public function toggleEmailNotifications($email);

    public function getAllStudents();

    public function getOffersPaginated($limit, $offset);
}

?>