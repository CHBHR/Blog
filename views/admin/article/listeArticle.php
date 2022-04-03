<h1>Administration des articles</h1>

<table class="table">
    <thead>
        <tr>
        <th scope="col">#</th>
        <th scope="col">Titre</th>
        <th scope="col">Chapo</th>
        <!-- <th scope="col">Contenu</th> -->
        <th scope="col">Date création</th>
        <th scope="col">Date mise à jour</th>
        <th scope="col">Auteur</th>
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
                <td><?= $post->auteur_id ?></td>
                <td>
                    <a href="#" class="btn btn-warning">Modifier</a>
                    <form action="/admin/posts/delete/<?= $post->id ?>" method="POST" class="d-inline">
                        <button type="submit" class="btn btn-danger">Supprimer</button>
                    </form>
                </td>
            </tr>
        
        <?php endforeach ?>
    </tbody>
</table>