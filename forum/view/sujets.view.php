
<? require"./view/header.view.php";?>

    <div id="subject_section">
        <ul>
        <?foreach($_SESSION['sujets'] as $sujet): ?>
                <li><a href="conversation.php?subject=<?=$sujet['sujet_nom']?>"><?=$sujet['sujet_nom']?></a></li>
        <? endforeach; ?>
        </ul>
    </div>
    <div id="add_subject">
        <h4>Ajouter un sujet?</h4>
        <div id="errors"><span style="color:red"><?=$erreur??null?></span></div>
            <form action method="get">
                <input type="hidden" name="cat" value="<?=$cat?>">
                <input type="text" name="subject_title" id="subject_title" placeholder="Titre du sujet..." required>
                <textarea name="subject_content" id="subject_content" placeholder="Contenu..." required></textarea>
                <input type="submit" name="btn" value="Ajouter le sujet">
            </form>
    </div>

<? require "./view/footer.view.php";?>