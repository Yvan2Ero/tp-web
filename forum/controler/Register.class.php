<?php

    require_once "./function/functions.php";

    class Register{
        private $pseudo;
        private $email;
        private $password;
        private $password2;
        private $cnx;

        public function __construct($pseudo, $email, $password, $password2)
        {
            $this->pseudo       = $pseudo;
            $this->email        = $email;
            $this->password     = $password;
            $this->password2    = $password2;
            $this->cnx          = bdd();
        }

        public function verify()
        {
            return $this->getErrors()=="ras";
        }

        public function getErrors():string
        {
            if(mb_strlen($this->pseudo) <3 || mb_strlen($this->pseudo) >15)
            {
                return "Le pseudo doit contenir entre 3 et 15 caracteres";
            }
            if(!filter_var($this->email, FILTER_VALIDATE_EMAIL))
            {
                return "Addresse email invalide";
            }
            if(mb_strlen($this->password) <6 || mb_strlen($this->password) >12)
            {
                return "Le mot de passe doit contenir entre 6 et 12 caracteres";
            }
            if($this->password != $this->password2)
            {
                return "Les mots de passes sont differents";
            }
            return "ras";
        }
        public function save():bool
        {
            if($this->verify())
            {
                $q = $this->cnx->prepare("INSERT INTO users_reseau (user_pseudo, user_email, user_password)
                                    VALUES(:pseudo, :email, :password)");
                $q->execute([
                    "pseudo" => $this->pseudo,
                    "email"  => $this->email,
                    "password"=> $this->password
                ]);
                return true;
            }
            return false;
        }

        public function sesseion():bool
        {
            if($this->save())
            {
                $q = $this->cnx->query("SELECT * FROM users_reseau 
                                    WHERE user_pseudo = '$this->pseudo'
                                    AND user_password = '$this->password'")->fetch();
                
                $_SESSION['user_id'] = $q["user_id"];
                $_SESSION['user_pseudo'] = $q["user_pseudo"];
                $_SESSION['user_email'] = $q["user_email"];
                $_SESSION['user_avatar'] = null;
                return true;
            }
            return false;
        }
    }