<h2 class="center">Page Index</h2>

<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post">
            <?= $form->input('username', 'Pseudo'); ?>
            <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
            <?= $form->submit('Envoyer !'); ?>
        </form>
    </div>
</div>
