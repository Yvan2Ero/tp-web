<?php
session_start();
require_once "./function/functions.php";
    //VERIFICATION DU SUJET PASSEE
    $sub = e($_POST['subject']??$_GET['subject']);
    $flag = false;
    foreach($_SESSION['sujets'] as $ligne_sujet)
    {
        if($ligne_sujet['sujet_nom'] == $sub)
        {
            $flag = true;
            break;
        }
    }

    $posts = [];
    if(!$flag)//SI LE SUJET EN GET N'EXISTE PAS EN SESSION, ON RENTRE L'UTILISATEUR
    {
        header("Location:acceuil.php");
        exit();
    }
    $_SESSION['actual_subject'] = $sub;
    //FIN DE LA VERIFICATIOND U SUJET PASSE

    $title = "conversation";
    require "./view/header.view.php";
?>


<div id="posts"></div>
<div id="input_message">
    <div id="errors"></div>
    <form id="form-post" action="conversationHandler.php?task=write" method="post">
        <input type="hidden" id="subject" name="subject" value="<?=$_SESSION['actual_subject']?>">
        <textarea name="input_message" class="input_c" id="i_n" placeholder="Saisir..." ></textarea>
        <input type="submit" id="btn" class="input_c" name="btn" value="Poster">
    </form>
</div>
<script src="./js/conversation.js">

</script>
<? require "./view/footer.view.php";?>