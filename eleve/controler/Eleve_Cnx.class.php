<?php

    require './../ressources/fonctions.php';

    class Eleve_Cnx{

        private $matricule;

        private $password;

        private $cnx;

        public function __construct($matricule, $password)
        {
            $this->matricule  = $matricule;
            $this->password   = $password;
            $this->cnx        = getCnxEleve();
        }

        public function verifier()
        {
            $q = $this->cnx->prepare("SELECT * FROM eleve
                                        WHERE matricule = :matricule AND mot_de_passe = :mdp");
            $q->execute(['matricule' => $this->matricule, 'mdp' => $this->password]);

            $rslt = $q->fetch();

            if(empty($rslt))
            {
                return -1;
            }
            else
            {
                return $rslt;
            }
        }

    }