<h2 class="center">Créer une annonce</h2>
<br />
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post">
            <?= $form->input('title', 'Titre de l\'annonce'); ?>
            <?= $form->input('content', 'Contenu de l\'annonce'); ?>
            <?= $form->submit('Enregistrer'); ?>
        </form>
    </div>
</div>
<p class="center green bold"><?php if(isset($_COOKIE["error"])): echo $_COOKIE["error"]; endif; ?></p>