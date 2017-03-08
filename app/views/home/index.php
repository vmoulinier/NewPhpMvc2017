<?php var_dump(isset($_SESSION['user_id'])); ?>
<h2 class="center">Page Index</h2>
<div class="row">
    <div class="col-sm-4 col-sm-offset-4">
        <form method="post">
            <?= $form->input('email', 'Email', ['type' => 'email']); ?>
            <?= $form->input('password', 'Mot de passe', ['type' => 'password']); ?>
            <?= $form->submit('Envoyer !'); ?>
        </form>
    </div>
</div>
