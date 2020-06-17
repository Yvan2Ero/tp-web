<?php

    require "./../ressources/fonctions.php";

    class Admin_Cnx{

        private $nom;

        private $password;

        private $cnx;

        public function __construct(string $nom, string $password)
        {
            $this->nom = $nom;
            $this->password = $password;
            $this->cnx = getCnxEleve();
        }

        public function getInfos()
        {
            $q = $this->cnx->prepare("SELECT * FROM professeur
                                      WHERE prof_login = :log AND prof_password = SHA1(:pwd)");
            $rslt = $q->execute([
                'log' => $this->nom,
                'pwd' => $this->password
            ]);
            if($rslt)
            {
                return $q->fetch();
            }
            return [];
            
        }



    }