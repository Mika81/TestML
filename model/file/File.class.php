<?php

class File {

    private $id;
    private $title;
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

    public function getTitle() {
        return $this->title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setId($id) {
        if ($id >= 1 && strlen($id) <= 4) {
            $this->id = (int) $id;
        }
    }

    public function setTitle($title) {
        if (strlen($title) <= 32 && is_string($title)) {
            $this->title = $title;
        }
    }

    public function setDescription($description) {
        if (strlen($description) <= 128 && is_string($description)) {
            $this->description = $description;
        }
    }

}
