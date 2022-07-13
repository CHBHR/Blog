<div class="card mt-4 mb-4">

    <div class="card-header">
        <h1><?= $params['article']->titre ?></h1>
    </div>

    <div class="card-body">
        <h5 class="card-title"><?= $params['article']->chapo ?></h5>
        <p class="card-text"><?= $params['article']->contenu ?></p>
        <small><?= $params['article']->getAuthor($params['article']->id_auteur) ?></small>
        <small><?= $params['article']->getFormatedDate($params['article']->date_creation) ?></small>
    </div>
    
</div>

<div class="commentaire ">

    <h3>Commentaires</h3>

    <?php if (!$params['comment']): ?>

    <div class="card bg-light">
        <div class="card-body">
            <p class="card-text">Il n'y a aucun commentaire pour cet article</p>
        </div>
    </div>

    <?php elseif($params['comment']): ?>
        <?php $nb = 0; ?>
        <?php foreach($params['comment'] as $com): ?>
            <?php if($com->status === 'validated'): ?>
                <?php $nb++ ;?>
                <div class="card bg-light mb-3" >
                    <div class="card-body">
                        <p class="card-text"><?= $com->contenu ?></p>
                        <small>Posté par <?= $com->getAuthor($com->id_auteur) ?> le <?= $com->getFormatedDate($com->date_creation) ?></small>
                    </div>
                </div>
            <?php endif ?>
        <?php endforeach ?>
        <?php if($nb == 0 ): ?>
            <div class="card bg-light">
                <div class="card-body">
                    <p class="card-text">Il n'y a aucun commentaire pour cet article</p>
                </div>
            </div>
        <?php endif ?>
    <?php endif ?>

</div>

<div class="block-form-commentaire">

    <h3>Ajouter un commentaire</h3>

    <?php

        if (isset($_SESSION['errors'])): ?>
        <?php foreach($_SESSION['errors'] as $errorsArray): ?>
            <?php foreach($errorsArray as $errors): ?>
                <div class="alert alert-danger">
                    <?php foreach($errors as $error): ?>
                        <li><?= $error ?></li>
                    <?php endforeach ?>
                </div>
            <?php endforeach ?>
        <?php endforeach ?>
    <?php endif ?>
    <?php unset($_SESSION['errors']); ?>


    <?php if (isset($_SESSION['auth'])): ?>
    <div class="form-commentaire">

        <form action="<?= "/articles/submitComment" ?>" method="POST">
            <div class="form-group">
                <label for="titre">Commentaire</label>
                <textarea name="contenu" id="contenu" rows="6" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" id="id_auteur" name="id_auteur" value="<?= $_SESSION['id'] ?>">
            </div>
            <div class="form-group">
                <input type="hidden" id="id_article" name="id_article" value="<?= $params['article']->id ?>">
            </div>

            <button type="submit" class="btn btn-primary mt-4">Soumettre mon commentaire pour validation</button>
        </form>

    </div>
    
    <?php else: ?>
    <div>
        <p>
            Vous devez être connecté pour ajouter une commentaire
        </p>
        <a class="btn btn-primary" href="/login" role="button">Se connecter</a>
    </div>
    <?php endif?>

</div>
