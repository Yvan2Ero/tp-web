<?php 
    session_start();
    if(empty($_SESSION["user_id"]))
    {
        session_destroy();
        header("Location:index.php");
    }

    require_once "./../ressources/fonctions.php";

    if(isset($_POST['modifier']))
    {
        if(isset($_FILES['avatar']) && !empty($_FILES['avatar']['name']))
        {
            $tailleMax = 4194304;
            $extensions = ['gif','jpg', 'jpeg', 'png'];
            $extensioCharge = strtolower(substr(strchr($_FILES['avatar']['name'], '.'),1));
            if(in_array($extensioCharge, $extensions))
            {

                if($_FILES['avatar']['size']<=$tailleMax)
                {
                    $picturePath = "membres/avatars/".$_SESSION['user_id'].".".$extensioCharge;

                    $rslt = move_uploaded_file($_FILES['avatar']['tmp_name'],$picturePath);

                    $avatar = $_SESSION["user_id"].".".$extensioCharge;

                    $id = $_SESSION["user_id"];

                    $q = getCnxReseau()->prepare("UPDATE users_reseau 
                                                  SET user_avatar = :avatar WHERE user_id = :id");
                    if(!$q->execute([
                        'avatar' => echaper($avatar),
                        'id'     => $id
                    ])){$erreur = "Erreur lors de l'enregistrement de l'image!";} 

                }else
                {
                    $erreur = "Extension invalide!";
                }                
            }else
            {
                $erreur = "Votre photo de profile doit etre au format: gif, jpg, jpeg ou png";
            }
        }
        if(!empty_in_post(["new_pseudo"]))
        {
            $pseudo = echaper($_POST["new_pseudo"]);
            if(mb_strlen(trim($pseudo))>=3 && mb_strlen(trim($pseudo))<=20)
            {
                $q = getCnxReseau()->prepare("UPDATE users_reseau SET user_pseudo = :pseudo WHERE user_id = :id");
                $r = $q->execute([
                    "pseudo" => $pseudo,
                    "id"    =>  $_SESSION['user_id']
                ]);
                if($r)
                {
                }else{
                    $erreur = "Une erreur est survenue!";
                }
            }else
            {
                $erreur = "Le pseudo doit contenir entre 3 et 20 caracteres";
            }

        }
        if(!empty_in_post(["new_email"]))
        {
            $email = echaper($_POST["new_email"]);
            if(filter_var($email, FILTER_VALIDATE_EMAIL))
            {
                $q = getCnxReseau()->prepare("UPDATE users_reseau SET user_email = :email WHERE user_id = :id");
                $r = $q->execute([
                    "email" => $email,
                    "id"    =>  $_SESSION['user_id']
                ]);
                if($r)
                {
                   
                }else{
                    $erreur = "Une erreur est survenue!";
                }
            }else
            {
                $erreur = "Email invalide!!";
            }

        }
       
        if(empty($erreur))
        {
             // ON MET A JOUR LA SESSION
             $q = getCnxReseau()->query("SELECT * FROM users_reseau WHERE user_id = ".$_SESSION['user_id']);
             $user = $q->fetch();
             $_SESSION['user_pseudo'] = $user["user_pseudo"];
             $_SESSION['user_email'] = $user["user_email"];
             $_SESSION['user_avatar'] = $user["user_avatar"]??null;
             header("Location:profile.php");
        }
    }

    $path = "./membres/avatars/";
    $default_avatar = "default.svg";
    $title = "profile";
    require "./view/profile.view.php";
?>