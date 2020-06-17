<?php

require_once "./../ressources/fonctions.php";
class Cnx
{
    private $pseudo;
    private $password;
    private $cnx;

    public function __construct($pseudo, $password)
    {
        $this->pseudo = $pseudo;
        $this->password = $password;
        $this->cnx = getCnxReseau();
    }

    public function verifier()
    {
        $q = $this->cnx->query("SELECT * FROM users_reseau
                            WHERE user_pseudo = '$this->pseudo'
                            AND user_password = '$this->password'");
        return $q->fetch();
        $q->closeCursor();
    }
    public function session()
    {
        $user = $this->verifier();
        if($user)
        {
            $_SESSION['user_id'] = $user["user_id"];
            $_SESSION['user_pseudo'] = $user["user_pseudo"];
            $_SESSION['user_email'] = $user["user_email"];
            $_SESSION['user_avatar'] = $user["user_avatar"];
            return true;
        }
        return false;

    }
}
