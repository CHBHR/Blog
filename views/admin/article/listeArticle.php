<h1>Administration des articles</h1>

<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
<?php endif ?>

<a href="/admin/posts/create" class="btn btn-success my-3">Créer un nouvel Article</a>

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
        <?php foreach($params['articles'] as $post): ?>

            <tr>
                <th scope="row"><?= $post->id ?></th>
                <td><?= $post->titre ?></td>
                <td><?= $post->chapo ?></td>
                <!-- <td><?= $post->contenu ?></td> -->
                <td><?= $post->getFormatedDate($post->date_creation) ?></td>
                <td><?= $post->getFormatedDate($post->date_mise_a_jour) ?></td>
                <td><?= $post->getAuthor($post->auteur_id) ?></td>
                <td><?= $post->getPendingComment($post->id) ?></td>
                <td>
                    <a href="/admin/posts/edit/<?= $post->id ?>" class="btn btn-warning">Modifier</a>
                    <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                    <a href="/admin/posts/comment/<?= $post->id ?>" class="btn btn-secondary">Commentaires</a>
                </td>
            </tr>
        
        <?php endforeach ?>
    </tbody>
</table>