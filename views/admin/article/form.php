<h1><?= $params['article']->titre ?? 'Crée un nouvel Article' ?></h1>

<form action="<?= isset($params['post']) ? "/admin/posts/edit/{$params['article']->id}" : "admin/posts/create"  ?>" method="POST">
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

    <!-- TO DO -->
    <!-- <div class="form-group hidden">
        <input type="hidden" class="form-control" name="auteur_id" id="auteur_id" value="">
    </div> -->

    <button type="submit" class="btn btn-primary"><?= isset($params['post']) ? 'Enregistrer les modifications' : 'Enregistrer mon article' ?> </button>
</form>