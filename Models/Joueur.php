<?php


namespace Models;
    use PDO;

    class Joueur extends DbConnect {

        private $id_joueur;
        private $pseudo;
        private $mdp;


        // Construction des getters
        public function getIdJoueur(): int {
            return $this->id_joueur;
        }

        public function getPseudo(): ?string {
                return $this->pseudo;
        }

        public function getMdp(): ?string {
            return $this->mdp;
        }

        /* Fin des getters */


        // Construction des setters
        public function setIdJoueur(int $id_joueur) {
            $this->id_joueur = $id_joueur;
        }

        public function setPseudo(string $pseudo) {
            $this->pseudo = $pseudo;
        }

        public function setMdp(string $mdp) {
            $this->mdp = $mdp;
        }

        /* Fin des setters */


        // FONCTIONS INTERNES À LA CLASSE


        // variable contenant la requête SQL sous la forme d'une chaîne de caractère
    public function selectAll() {

        $query = "SELECT id_joueur, pseudo, mdp FROM joueur;";

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

       
        $query = "SELECT id_joueur FROM joueur WHERE id_joueur = :id_joueur;";
        $result  = $this->pdo->prepare($query);

        // Prévenir l'injection SQL, "voir cours et doc" 
        // ajout de la fonctionnalité "blindValue" pour associer une valeur à un paramètre 
        // + voir ci-dessus remplacer $this->nomdelacolonne par :nomdelacolonne
        $result->bindValue("id_joueur", $this->id_joueur, PDO::PARAM_STR);

        $result->execute();
        $datas = $result->fetch();

        if($datas) {
            $this->id_joueur = $datas['id_joueur'];
        }
        return $datas;

    }


        public function insert(){
            $query = "INSERT INTO joeur (id_joueur, pseudo, mdp) VALUE (:id_joueur, :pseudo, :mdp);";

            $result = $this->pdo->prepare($query);

            $result->bindValue("id_admin", $this->id_joueur, \PDO::PARAM_STR);
            $result->bindValue("pseudo", $this->pseudo, \PDO::PARAM_STR);
            $result->bindValue("mdp", $this->mdp, \PDO::PARAM_STR);

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