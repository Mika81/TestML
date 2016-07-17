<?php

class FileManager {

    private $db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    /* ----------CREATE */

    public function add(File $file) {
        $query = $this->db->prepare('INSERT INTO File SET title=:title, description=:description');
        $query->bindValue(':title', $this->db->quote($file->getTitle()), PDO::PARAM_STR);
        $query->bindValue(':description', $this->db->quote($file->getDescription()), PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $this->db->lastInsertId();
        return $lastInsertId;
        $query->closeCursor();
    }

    public function associateCategory($lastInsertId, $cats) {
        $query = $this->db->prepare('INSERT INTO File_Category SET id_File=:IdFile, id_Category=:IdCategory');
        $query->bindValue(':IdFile', $lastInsertId, PDO::PARAM_INT);
        $query->bindValue(':IdCategory', $cats, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    /* ----------READ */

    public function get(Array $file) {
//        $query = $this->db->prepare('SELECT * FROM user WHERE alias=:alias AND pwd=:pwd');
//        $query->bindValue(':alias', $this->db->quote($user['alias']), PDO::PARAM_STR);
//        $query->bindValue(':pwd', hash('sha512', $user['pwd']));
//        $query->execute();
//        $data = $query->fetch(PDO::FETCH_ASSOC);
//        $query->closeCursor();
//        return new User($data);
    }

    public function getAllFiles() {
        $query = $this->db->prepare('SELECT * '
                . 'FROM File');
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getAll($id) {
        $query = $this->db->prepare('SELECT * '
                . 'FROM File '
                . 'WHERE id=:id ');
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetch(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getIdFilesForOneCategory($categoryId) {
        $query = $this->db->prepare('SELECT id_File '
                . 'FROM File_Category '
                . 'WHERE id_Category=:categoryId');
        $query->bindValue(':categoryId', $categoryId);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getList($id) {
        $query = $this->db->prepare('SELECT * '
                . 'FROM File '
                . 'WHERE id=:id '
                . 'ORDER BY id DESC');
        $query->bindValue(':id', $id);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getLastThree() {
        $query = $this->db->prepare('SELECT * '
                . 'FROM File '
                . 'ORDER BY id '
                . 'DESC '
                . 'LIMIT 0,3');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getAssociatedCategory($file_id) {
        $query = $this->db->prepare('SELECT id_Category '
                . 'FROM File_Category '
                . 'WHERE id_File=:idFile '
                . 'ORDER BY id '
                . 'DESC');
        $query->bindValue(':idFile', $file_id, PDO::PARAM_STR);
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    /* ----------UPDATE */

    public function update(File $updateFile) {
        $query = $this->db->prepare('UPDATE File '
                . 'SET title=:title, description=:description '
                . 'WHERE id=:id');
        $query->bindValue(':title', $this->db->quote($updateFile->getTitle()), PDO::PARAM_STR);
        $query->bindValue(':description', $this->db->quote($updateFile->getDescription()), PDO::PARAM_STR);
        $query->bindValue(':id', $updateFile->getId(), PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    /* ----------DELETE */

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM File '
                . 'WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    public function deleteAssociationWithCategory($id) {
        $query = $this->db->prepare('DELETE FROM File_Category '
                . 'WHERE id_File = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

}
