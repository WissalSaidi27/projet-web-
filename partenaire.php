    <?php
    class Partenaire {
        private $id_part;
        private $nom;
        private $email;
        private $adr;

        public function __construct($nom, $email, $adr) {
          
            $this->nom = $nom;
            $this->email = $email;
            $this->adr = $adr;
        }

        public function getId_part() {
            return $this->id_part;
        }

        public function setId_part($id_part) {
            $this->id = $id_part;
        }

        public function getNom() {
            return $this->nom;
        }

        public function setNom($nom) {
            $this->nom = $nom;
        }

        public function getEmail() {
            return $this->email;
        }

        public function setEmail($email) {
            $this->email = $email;
        }

        public function getadr() {
            return $this->adr;
        }

        public function setadr($adr) {
            $this->adr = $adr;
        }
    }
    ?>
