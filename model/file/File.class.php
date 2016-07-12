<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of file
 *
 * @author mika
 */
class File {
    
    private $file_id;
    private $title;
    private $img;
    private $text;
    private $categorie;
    private $date;
    
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
    
    public function getFile_id() {
        return $this->file_id;
    }
    public function getTitle() {
        return $this->title;
    }
    public function getImg() {
        return $this->img;
    }
    public function getText() {
        return $this->text;
    }
    public function getCategorie() {
        return $this->categorie;
    }
    
    public function setFile_id($file_id) {
        if ($file_id >= 1 && strlen($file_id) <= 4) {
            $this->file_id = (int) $file_id;
        }
    }
    public function setTitle($title) {
        if (strlen($title) <= 64 && is_string($title)) {
            $this->title = $title;
        }
    }
    public function setImg($img) {
        if (strlen($img) <= 128 && is_string($img)) {
            $this->img = $img;
        }
    }
    public function setTe($text) {
        if (strlen($text) <= 256 && is_string($text)) {
            $this->text = $text;
        }
    }
    public function setCategorie($categorie) {
        if (strlen($categorie) <= 48 && is_string($categorie)) {
            $this->categorie = $categorie;
        }
    }
}
