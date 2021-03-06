<h1>Les derniers Articles</h1>

<?php foreach($params['articles'] as $post): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->titre ?></h2>
            <small class="badge bg-secondary"><?= $post->getFormatedDate($post->date_creation) ?></small>
            <p><?= $post->chapo; ?></p>
            <p>Ecrit par <?= $post->getAuthor($post->id_auteur) ?></p>
            <a href="/articles/<?= $post->id; ?>" class="btn btn-primary">Lire plus</a>
        </div>
    </div>
<?php endforeach ?>