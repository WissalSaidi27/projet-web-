<?php
class Contrat {
    private $id_c;
    private $id_part;
    private $type_c;
    private $duree;

    // Constructeur
    public function __construct($id_part, $type_c, $duree, $id_c = null) {
        $this->id_c = $id_c;
        $this->id_part = $id_part;
        $this->type_c = $type_c;
        $this->duree = $duree;
    }

    // Getters
    public function getIdC() {
        return $this->id_c;
    }

    public function getIdPart() {
        return $this->id_part;
    }

    public function getTypeC() {
        return $this->type_c;
    }

    public function getDuree() {
        return $this->duree;
    }

    // Setters
    public function setIdC($id_c) {
        $this->id_c = $id_c;
    }

    public function setIdPart($id_part) {
        $this->id_part = $id_part;
    }

    public function setTypeC($type_c) {
        $this->type_c = $type_c;
    }

    public function setDuree($duree) {
        $this->duree = $duree;
    }
}
?>

