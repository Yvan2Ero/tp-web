<?php

    class Teacher{

        private $prof_name;

        private $prof_surname;

        private $prof_email;

        private $prof_login;

        private $prof_password;

        public function __construct($prof_name, $prof_surname, $prof_email, $login, $prof_password)
        {
            $this->prof_name     = $prof_name;
            $this->prof_surname  = $prof_surname;
            $this->prof_email    = $prof_email;
            $this->prof_login    = $login;
            $this->prof_password = $prof_password;
        }

        public function getErrors()
        {
            if(mb_strlen(trim($this->prof_name))<2)
            {
                return "Taille du nom trop court";
            }
            if(mb_strlen(trim($this->prof_surname))<2)
            {
                return "Taille du prenom trop court";
            }
            if(!filter_var($this->prof_email, FILTER_VALIDATE_EMAIL))
            {
                return "Adresse e-mail invalide!";
            }
                return "ras";
        }

        public function verifier()
        {
            return $this->getErrors()=="ras";
        }

        public function sauvegarder()
        {
            $rq1 = getCnxEleve()->prepare("DELETE FROM professeur
                                            WHERE nom_prof=? AND prenom_prof=? AND email_prof=?");
                $rq1->execute([
                    $this->prof_name, $this->prof_surname, $this->prof_email
                ]);

            
            $q = getCnxEleve()->prepare("INSERT INTO professeur(nom_prof, prenom_prof, email_prof, prof_login, prof_password)
                                        VALUES (?,?,?,?,?)");
            $rslt = $q->execute([
                    $this->prof_name,$this->prof_surname, $this->prof_email,
                    $this->prof_login, $this->prof_password
                ]);
            if($rslt)
            {
                if($this->prof_login == "" || $this->prof_password == "")
                {
                    $rq = getCnxEleve()->prepare("SELECT * FROM professeur
                                                WHERE nom_prof=? AND prenom_prof=? AND email_prof=?");
                    $id = $rq->execute([
                        $this->prof_name, $this->prof_surname, $this->prof_email
                    ]);
                    if($id)
                    {
                        $id = $rq->fetch()["id_prof"];
                        $log = $this->prof_surname.$id;
                        $pwd = $this->prof_surname.$id;
                        $qu = getCnxEleve()->prepare("UPDATE professeur
                                                    SET prof_login=?, prof_password=?
                                                    WHERE id_prof =?");
                        return($qu->execute([
                            ($log),strtolower($pwd), $id
                        ]));
                    }else
                    {
                        return false;
                    }
                }
                return true;
            }
            else{
                return false;
            }
        }
    }