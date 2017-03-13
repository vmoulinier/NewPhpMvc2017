<h2 class="center">Page Annonces</h2>
<table class="table">
    <thead>
    <tr>
        <td>
            <b>Auteur de l'annonce</b>
        </td>
        <td>
            <b>Titre de l'annonce</b>
        </td>
        <td>
            <b>Contenu de l'annonce</b>
        </td>
        <td>

        </td>
    </tr>
    </thead>
    <tbody>
    <?php foreach($annonces as $key => $annonce): ?>

            <tr>
                <td>
                    <?= $annonce->getUser()->getNom() ?>
                </td>
                <td>
                    <?= $annonce->getTitle() ?>
                </td>
                <td>
                    <?= $annonce->getContent() ?>
                </td>
                <td>
                    <a href="<?= PATH ?>/annonces/view_annonce/<?= $annonce->getId() ?>"><button class="btn btn-success">Voir annonce</button></a>
                </td>
            </tr>
    <?php endforeach; ?>
    </tbody>
</table>
