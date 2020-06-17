<?php

  require_once "./../ressources/fonctions.php";

  class SuperAdmin{

    private $user_name;

    private $user_password1;

    private $user_password2;

    public function __construct($user_name, $user_password1, $user_password2)
    {
      $this->user_name = $user_name;
      $this->user_password1 = $user_password1;
      $this->user_password2 = $user_password2;
    }


    public function verifier()
    {
      $q = getCnxEleve()->prepare("SELECT * FROM superadmin
                                  WHERE admin_user_name = :user_name
                                  AND admin_password_1   = :password1
                                  AND admin_password_2    = :password2");
      $admin = $q->execute([
        'user_name'   =>    $this->user_name,
        'password1'   =>    $this->user_password1,
        'password2'   =>    $this->user_password2
      ]);
      if(!$admin)
      {
        return null;
      }
      return $q->fetch();
    }

    public function session()
    {
      $admin = $this->verifier();
      if($admin==null)
      {
        return false;
      }else
      {
        $_SESSION["user_name"]  = $admin['admin_user_name'];
        header("Location:acceuil.php");
        exit();
      }
    }
  }
