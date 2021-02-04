<?php


namespace Models;
    use PDO;

    class Mot extends DbConnect {

        private $id_mot;
        private $mot;
        private $niveau;
        private $image1;
        private $image2;
        private $image3;
        private $image4;


        // Construction des getters
        public function getIdMot(): int {
            return $this->id_mot;
        }

        public function getMot(): ?string {
                return $this->mot;
        }

        public function getNiveau(): ?string {
            return $this->niveau;
        }

        public function getImage1(): ?string {
            return $this->image1;
        }

        public function getImage2(): ?string {
            return $this->image2;
        }

        public function getImage3(): ?string {
            return $this->image3;
        }

        public function getImage4(): ?string {
            return $this->image4;
        }

        /* Fin des getters */


        // Construction des setters
        public function setIdMot(int $id_mot) {
            $this->id_mot = $id_mot;
        }

        public function setMot(string $mot) {
            $this->mot = $mot;
        }

        public function setNiveau(string $niveau) {
            $this->niveau = $niveau;
        }

        public function setImage1(string $image1) {
            $this->image1 = $image1;
        }

        public function setImage2(string $image2) {
            $this->image2 = $image2;
        }


        public function setImage3(string $image3) {
            $this->image3 = $image3;
        }


        public function setImage4(string $image4) {
            $this->image4 = $image4;
        }


        /* Fin des setters */


        // FONCTIONS INTERNES À LA CLASSE


        // variable contenant la requête SQL sous la forme d'une chaîne de caractère
    public function selectAll() {

        $query = "SELECT id_mot, mot, niveau, image1, image2, image3, image4 FROM mot;";

        // je récupère un objet de type PDOStatement => requête préparée
        $result = $this->pdo->prepare($query);

        // exécution de la requête préparée - $result récupère le jeu de résultat 
        $result->execute();

        //
        $datas = $result->fetchAll();

        return $datas;
    }


        // sert à afficher la base de données
        public function select() {

       
        $query = "SELECT id_mot FROM mot WHERE id_mot = :id_mot;";
        $result  = $this->pdo->prepare($query);

        // Prévenir l'injection SQL, "voir cours et doc" 
        // ajout de la fonctionnalité "blindValue" pour associer une valeur à un paramètre 
        // + voir ci-dessus remplacer $this->nomdelacolonne par :nomdelacolonne
        $result->bindValue("id_mot", $this->id_mot, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch();

        if($datas) {
            $this->id_joueur = $datas['id_joueur'];
        }
        return $datas;

    }


        public function insert(){
            $query = "INSERT INTO mot (id_mot, mot, niveau, image1, image2, image3, image4) VALUE (:id_mot, :mot, :niveau, :image1, :image2, :image3, :image4);";

            $result = $this->pdo->prepare($query);

            $result->bindValue("id_mot", $this->id_mot, \PDO::PARAM_STR);
            $result->bindValue("mot", $this->mot, \PDO::PARAM_STR);
            $result->bindValue("niveau", $this->niveau, \PDO::PARAM_STR);
            $result->bindValue("image1", $this->image1, \PDO::PARAM_STR);
            $result->bindValue("image2", $this->image2, \PDO::PARAM_STR);
            $result->bindValue("image3", $this->image3, \PDO::PARAM_STR);
            $result->bindValue("image4", $this->image4, \PDO::PARAM_STR);

            if(!$result->execute()) {
                var_dump( $result->errorInfo()); // sert à détecter la moindre erreur dans la fonction
                $_SESSION["error"]["bdd"] = $result->errorInfo()[2]; // sert à faire apparaître l'erreur dû à un mail identique par ex 
                return false;
            }else {
                return $this;
            }
        }


        public function dbConnect() {
            $this->pdo = new PDO("mysql:host=localhost:3306;dbname=jeu_images;charset=utf8");
        }


        public function update() {



        }


    }





?>