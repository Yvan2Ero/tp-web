<?php
    require_once "./../ressources/fonctions.php";
    class Post{

        private $subject;

        private $content;

        private $cnx;

        public function __construct(string $subject, string $content)
        {
            $this->subject = $subject;
            $this->content = $content;
            $this->cnx           = getCnxReseau();
        }

        public function sauvegarder():bool
        {
            $q = $this->cnx->prepare("INSERT INTO posts_reseau(pseudo_autor, avatar_autor, sujet_nom, contenu_post, date_post)
                                        VALUES (:pseudo, :avatar, :sub, :content, NOW())");
            $rps = $q->execute(["pseudo"=>$_SESSION['user_pseudo'], "avatar" => $_SESSION["user_avatar"], "sub" => $this->subject, "content" =>$this->content]);
            return $rps;
        }
    }
