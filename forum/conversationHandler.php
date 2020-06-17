<?php
    session_start();
    require_once "./controler/Post.class.php";
    if(empty($_SESSION['user_id']))
    {header("Location:index.php");}

    //DETERMINATION DE LA TACHE A EXECUTER 

    $task = "read";
    if(!empty_in_get(['task']))
    {
        $task = $_GET['task'];
    }
    if($task == "write")
    {
        postMessage();
    }
    else{
        readMessages();
    }

    /*
        FONCTION D'ENVOI D'UN MESSAGE
    */
    function postMessage()
    {
        if(!empty_in_post(['input_message']))
        {
            if( mb_strlen(trim($_POST['input_message'])) >=1 )
            {
                $new_post = new Post($_SESSION['actual_subject'],$_POST['input_message']);
                if($new_post->sauvegarder())
                {
                    echo json_encode(['succes' => 'Message poste']);
                }
                else
                {
                    echo json_encode(["erreur" => "Une erreur est survenu"]);
                }
            }
            else{
                echo json_encode(["erreur" => "Veillez entrer un message!"]);
            }
        }
        elseif(isset($_POST['btn']))
        {
            echo json_encode(["erreur" => "Veillez entrer un message!"]);
        } 
    }
     

    //FONCTION DE RESTITUTION DES MESSAGES
    function readMessages()
    {       
            $posts = getCnxReseau()->prepare("SELECT * FROM posts_reseau WHERE sujet_nom = :sub");
            $posts->execute(['sub'=>$_SESSION['actual_subject']]);
            $posts = $posts->fetchAll();
            echo json_encode($posts);
    }
        