<?php
require_once "./function/functions.php";

    class Add_subject{

        private $title;

        private $content;

        private $cathegorie;

        private $cnx;

        private $autor;

        public function __construct($title, $content, $cathegorie, $autor)
        {
            $this->title = $title;
            $this->content = $content;
            $this->cathegorie = $cathegorie;
            $this->cnx = bdd();
            $this->autor = $autor;
        }

        public function verifier():bool
        {
            if($this->getErrors()=="ras")
                return true;
            else
                return false;
        }

        public function getErrors():string
        {
            if(mb_strlen(trim($this->title))<3 )
            {
                return "Titre du sujet trop court(minimum 3 caracteres)";
            }
            if(mb_strlen(trim($this->content))<5)
            {
                return "Contenu du sujet trop court(minimum 5 caracteres)";
            }
            $q = $this->cnx->query("SELECT * FROM  categorie_resau
                                 WHERE categorie_nom='$this->cathegorie'");
            if($q->rowCount()<=0)
            {
                return "Erreur de cathegorie!!";
            }
            return "ras";
        }
        public function sauvegarder()
        {
            $requette1 = 'INSERT INTO posts_reseau (pseudo_autor, sujet_nom, contenu_post, date_post)
            VALUES(:pseudo, :nom, :contenu, NOW())';
            $requette1 = $this->cnx->prepare($requette1);

            $requette2 = 'INSERT INTO sujets_reseau (nom_categorie, sujet_nom)
            VALUES(:categorie, :nom_sujet)';
            $requette2 = $this->cnx->prepare($requette2);
            $rps1 = $requette1->execute([
                'pseudo' => $this->autor,
                'nom' => $this->title,
                'contenu' => $this->content
            ]) ;
            $rps2 = $requette2->execute([
                'categorie' => $this->cathegorie,
                'nom_sujet' =>$this->title
            ]) ;

            $q = bdd()->query("SELECT * FROM sujets_reseau
            WHERE  	nom_categorie = '$this->cathegorie'");
            $_SESSION['sujets'] = $q->fetchAll();
            return ($rps2 && $rps1);
        }

    }

