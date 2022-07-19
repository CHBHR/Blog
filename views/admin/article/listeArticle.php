<h1>Administration des articles</h1>

<?php if(!empty($params['message'])): ?>
    <div class="alert alert-success"><?= $params['message'] ?></div>
<?php endif ?>

<a href="/admin/articles/create" class="btn btn-success my-3">Créer un nouvel Article</a>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Chapo</th>
        <th scope="col">Date création</th>
        <th scope="col">Date mise à jour</th>
        <th scope="col">Auteur</th>
        <th scope="col">Commentaires en attente</th>
        <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($params['articles'] as $article): ?>

            <tr>
                <th scope="row"><?= $article->id ?></th>
                <td><?= $article->titre ?></td>
                <td><?= $article->chapo ?></td>
                <td><?= $article->getFormatedDate($article->date_creation) ?></td>
                <td><?= $article->getFormatedDate($article->date_mise_a_jour) ?></td>
                <td><?= $article->getAuthor($article->id_auteur) ?></td>
                <td><?= $article->getPendingComment($article->id) ?></td>
                <td>
                    <a href="/admin/articles/edit/<?= $article->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/admin/articles/delete/<?= $article->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="/admin/articles/comment/<?= $article->id ?>" class="btn btn-secondary">Commentaires</a>
                </td>
            </tr>
        
        <?php endforeach ?>
    </tbody>
</table>