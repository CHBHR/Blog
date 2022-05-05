<div class="card mt-4 mb-4">

    <div class="card-header">
        <h1><?= $params['post']->titre ?></h1>
    </div>

    <div class="card-body">
        <h5 class="card-title"><?= $params['post']->chapo ?></h5>
        <p class="card-text"><?= $params['post']->contenu ?></p>
        <small><?= $params['post']->getAuthor($params['post']->auteur_id) ?></small>
        <small><?= $params['post']->getFormatedDate($params['post']->date_creation) ?></small>
    </div>
    
</div>

<div class="commentaire ">

    <h3>Commentaires</h3>

    <!-- need to check if comments, if not display nothing. If there are, loop through to generate comments -->

    <div class="card bg-light mb-3" >
        <div class="card-body">
            <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
            <small>Autheur et date de création</small>
        </div>
    </div>

</div>

<!-- x implement form to add comment if user is logged in, if not logged, displays message with button to login -->
<div class="block-form-commentaire">

    <h3>Ajouter un commentaire</h3>

    <?php if (isset($_SESSION['errors'])): ?>
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

        <form action="<?= "/posts/submitComment" ?>" method="POST">
            <div class="form-group">
                <label for="titre">Commentaire</label>
                <textarea name="contenu" id="contenu" rows="6" class="form-control"></textarea>
            </div>
            <div class="form-group">
                <input type="hidden" id="id_auteur" name="id_auteur" value="<?= $_SESSION['id'] ?>">
            </div>
            <div class="form-group">
                <input type="hidden" id="id_article" name="id_article" value="<?= $params['post']->id ?>">
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
