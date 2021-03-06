<h1>
    <?= $params['article']->titre ?? 'Crée un nouvel Article' ?>
</h1>

<form action="<?= isset($params['article']) ? "/admin/articles/edit/{$params['article']->id}" : "/admin/articles/create" ?>" method="POST">
    <div class="form-group">
        <label for="titre">Titre de l'article</label>
        <input type="text" class="form-control" name="titre" id="titre" value="<?= $params['article']->titre ?? '' ?>">
    </div>
    <div class="form-group">
        <label for="chapo">Chapo de l'article</label>
        <textarea name="chapo" id="chapo" rows="6" class="form-control"><?= $params['article']->chapo ?? '' ?></textarea>
    </div>
    <div class="form-group">
        <label for="contenu">Contenu de l'article</label>
        <textarea name="contenu" id="contenu" rows="8" class="form-control"><?= $params['article']->contenu ?? '' ?></textarea>
    </div>
    <div class="form-group d-none">
        <input name="id_auteur" id="id_auteur" class="form-control" value="<?= $_SESSION['id'] ?>">
    </div>

    <button type="submit" class="btn btn-primary"><?= isset($params['article']) ? 'Enregistrer les modifications' : 'Enregistrer mon article' ?> </button>
</form>

<a href="/admin/articles/" class="btn btn-secondary mt-3">Revenir en arrière</a>