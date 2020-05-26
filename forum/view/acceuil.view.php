<?require "./view/header.view.php";?> 
 <div id="cathegories-section"> 
        <?foreach ($_SESSION['cat'] as $une): ?>
        <div class="cathegorie">
            <a href="sujets.php?cat=<?=$une?>"><?=strtoupper($une)?></a>
        </div>
        <?endforeach; ?>
    </div> 
<? require "./view/footer.view.php";?>