<?php
  session_start();
  require_once "./controler/SuperAdmin.class.php";

  if(isset($_GET['btn']))
  {
    if(!empty_in_get(["user_name", "user_password1", "user_password2"]))
    {
      $user_name = $_GET['user_name'];
      $user_password1 = $_GET['user_password1'];
      $user_password2 = $_GET['user_password2'];
      $admin = new SuperAdmin($user_name, $user_password1, $user_password2);
      if(!$admin->session())
      {
        $erreur = "Mauvaises informations!!";
      }
    }
  }
require "./view/super_admin.view.php";
