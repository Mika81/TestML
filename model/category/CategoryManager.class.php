<?php

class CategoryManager {

    private $db;

    public function __construct($db) {
        $this->setDb($db);
    }

    public function setDb(PDO $db) {
        $this->db = $db;
    }

    /* ----------CREATE */

    public function add(Category $category) {
        $query = $this->db->prepare('INSERT INTO Category SET name=:name, description=:description');
        $query->bindValue(':name', $this->db->quote($category->getName()), PDO::PARAM_STR);
        $query->bindValue(':description', $this->db->quote($category->getDescription()), PDO::PARAM_STR);
        $query->execute();
        $query->closeCursor();
    }

    /* ----------READ */

    public function getList() {
        $query = $this->db->prepare('SELECT * '
                . 'FROM Category '
                . 'ORDER BY id DESC');
        $query->execute();
        $data = $query->fetchAll(PDO::FETCH_ASSOC);
        $query->closeCursor();
        if (empty($data)):
            return false;
        else:
            return $data;
        endif;
    }

    public function getName($id) {
        $query = $this->db->prepare('SELECT name '
                . 'FROM Category '
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

    public function getAll($id) {
        $query = $this->db->prepare('SELECT * '
                . 'FROM Category '
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

    /* ----------UPDATE */

    public function update(Category $updateCategory) {
        $query = $this->db->prepare('UPDATE Category '
                . 'SET name=:name, description=:description '
                . 'WHERE id=:id');
        $query->bindValue(':name', $this->db->quote($updateCategory->getName()), PDO::PARAM_STR);
        $query->bindValue(':description', $this->db->quote($updateCategory->getDescription()), PDO::PARAM_STR);
        $query->bindValue(':id', $updateCategory->getId(), PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    /* ----------DELETE */

    public function delete($id) {
        $query = $this->db->prepare('DELETE FROM Category '
                . 'WHERE id = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

    public function deleteAssociationWithFile($id) {
        $query = $this->db->prepare('DELETE FROM File_Category '
                . 'WHERE id_Category = :id');
        $query->bindValue(':id', $id, PDO::PARAM_INT);
        $query->execute();
        $query->closeCursor();
    }

}
