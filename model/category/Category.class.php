<?php

/**
 * Description of Category
 *
 * @author mika
 */
class Category {

    private $id;
    private $name;
    private $description;

    public function __construct(array $data) {
        $this->hydrate($data);
    }

    public function hydrate(array $data) {
        foreach ($data as $key => $value) {
            $method = 'set' . ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        if ($id >= 1 && strlen($id) <= 4) {
            $this->id = (int) $id;
        }
    }

    public function setName($name) {
        if (strlen($name) <= 32 && is_string($name)) {
            $this->name = $name;
        }
    }

    public function setDescription($description) {
        if (strlen($description) <= 128 && is_string($description)) {
            $this->description = $description;
        }
    }

}
