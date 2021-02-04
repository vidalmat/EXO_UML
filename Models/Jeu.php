



<?php

namespace Models;
    use PDO;

    class Jeu extends DbConnect {

        private $id_jeu;
        private $score;
        private $niveau;
        private $current;


        // Construction des getters
        public function getIdJeu(): int {
            return $this->id_jeu;
        }

        public function getScore(): ?string {
                return $this->score;
        }

        public function getNiveau(): ?string {
            return $this->niveau;
        }

        public function getCurrent(): ?string {
            return $this->current;
        }
        /* Fin des getters */


        // Construction des setters
        public function setIdJeu(int $id_jeu) {
            $this->id_jeu = $id_jeu;
        }

        public function setScore(string $score) {
            $this->score = $score;
        }

        public function setNiveau(string $niveau) {
            $this->niveau = $niveau;
        }

        public function setCurrent(string $current) {
            $this->current = $current;
        }

        /* Fin des setters */


        // FONCTIONS INTERNES À LA CLASSE


        // variable contenant la requête SQL sous la forme d'une chaîne de caractère
    public function selectAll() {

        $query = "SELECT id_jeu, score, niveau, current FROM jeu;";

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

       
        $query = "SELECT id_jeu FROM jeu WHERE id_jeu = :id_jeu;";
        $result  = $this->pdo->prepare($query);

        // Prévenir l'injection SQL, "voir cours et doc" 
        // ajout de la fonctionnalité "blindValue" pour associer une valeur à un paramètre 
        // + voir ci-dessus remplacer $this->nomdelacolonne par :nomdelacolonne
        $result->bindValue("id_jeu", $this->id_jeu, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch();

        if($datas) {
            $this->id_jeu = $datas['id_jeu'];
        }
        return $datas;

    }


        public function insert(){
            $query = "INSERT INTO jeu(id_jeu, score, niveau, current) VALUE (:id_jeu, :score, :niveau, :current);";

            $result = $this->pdo->prepare($query);

            $result->bindValue("id_jeu", $this->id_jeu, \PDO::PARAM_STR);
            $result->bindValue("score", $this->score, \PDO::PARAM_STR);
            $result->bindValue("current", $this->current, \PDO::PARAM_STR);


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
