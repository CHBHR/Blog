<h1>Administration des commentaire</h1>

<div class="card mt-4 mb-4">

    <div class="card-header">
        <h1><?= $params['article']->titre ?></h1>
    </div>

    <div class="card-body">
        <h5 class="card-title"><?= $params['article']->chapo ?></h5>
        <p class="card-text"><?= $params['article']->contenu ?></p>
        <p><?= $params['article']->getAuthor($params['article']->auteur_id) ?></p>
        <p><?= $params['article']->getFormatedDate($params['article']->date_creation) ?></p>
    </div>
    
</div>

<div class="commentaire ">

    <h3>Commentaires</h3>

    <?php if (!$params['commentaires']): ?>

        <div class="container-fluid">
            <div class="card bg-ligh p-2" style="max-width: 18rem;">
                <p class="card-text">Il n'y a aucun commentaire pour cet article</p>
            </div>
        </div>

    <?php elseif($params['commentaires']): ?>
        <?php foreach($params['commentaires'] as $com): ?>

        <div class="card bg-light mb-3" >
            <div class="card-body">
                <p class="card-text"><?= $com->contenu ?></p>
                <p>
                    Auteur : <?= $com->getAuthor($com->id_auteur) ?></br>
                    Date publication : <?= $com->getFormatedDate($com->date_creation) ?></br>
                    Status : <?= $com->status ?>
                </p>
                <a href="/admin/posts/comment/validate/<?= $com->id?>" class="btn btn-success">Valider</a>
                <a href="#" class="btn btn-danger">Supprimer</a>
            </div>
        </div>

        <?php endforeach ?>
    <?php endif ?>

</div>

<a href="/admin/posts/" class="btn btn-secondary mt-3">Revenir en arrière</a>