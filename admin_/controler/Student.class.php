<?php

    class Student{
        private $name;
        private $surname;
        private $date_burn;
        private $site_burn;
        private $date_arrive;
        private $classe_name;
        private $password;
        private $matricul;
        private $sex;

        public function __construct( $name,$surname,$date_burn, $site_burn, $classe_name,  $password, $matricul, $sex)
        {
            $this->name = $name;
            $this->surname = $surname;
            $this->date_burn = $date_burn;
            $this->site_burn = $site_burn;
            $this->date_arrive = "20".date('y-m-d');
            $this->classe_name = $classe_name;
            $this->password = $password;
            $this->matricul = $matricul;
            $this->sex = $sex;

        }
        public function getErrors():string
        {
            if($this->date_burn>= "20".date('y-m-d'))
            {
                return "Date de naissance incorrect";
            }
            if(mb_strlen($this->name)<2)
            {
                return "Taille du nom trop court";
            }
            if(mb_strlen($this->surname)<2)
            {
                return "Taille du nom trop court";
            }
            return "ras";
        }

        public function verifier()
        {
            return $this->getErrors()=="ras";
        }

        public function enregistrer()
        {
            $q = getCnxEleve()->prepare("DELETE  FROM eleve 
            WHERE  nom_eleve=? AND prenom_eleve = ? AND date_naiss =? AND nom_classe=? ");
            $rps = $q->execute([
                $this->name,
                $this->surname,
                $this->date_burn , 
                $this->classe_name ,                      
            ]);

            $q = getCnxEleve()->prepare
            ("INSERT INTO eleve (nom_eleve ,prenom_eleve,date_naiss,
            lieu_naiss, annee_arrive, nom_classe, mot_de_passe, matricule, sexe)
            VALUES(?,?,?,?,?,?,SHA1(?),?,?)");

           if( $q->execute(
                [
            $this->name ,
            $this->surname,
            $this->date_burn ,
            $this->site_burn ,
            $this->date_arrive ,
            $this->classe_name ,
            $this->password ,
            $this->matricul ,
            $this->sex
                ]
                ))
                {
                    $q = getCnxEleve()->prepare("SELECT id_eleve FROM eleve 
                    WHERE  nom_eleve=? AND prenom_eleve = ? AND date_naiss =? AND nom_classe=? ");
                    $rps = $q->execute([
                        $this->name,
                        $this->surname,
                        $this->date_burn , 
                        $this->classe_name ,                      
                    ]);
                    if($rps)
                    {
                        $id = (int)($q->fetch()["id_eleve"]);
                        $matricul = strtolower(str_replace(" ", "-",date("y")."-".$this->classe_name."-".$id));
                        $q = getCnxEleve()->prepare("UPDATE eleve SET  	matricule=? WHERE id_eleve=$id");
                        return ($q->execute(
                            [$matricul]
                        ));
                    }
                }
        }
        
    }