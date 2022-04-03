<h1>Les derniers Articles</h1>
<?php foreach($params['posts'] as $post): ?>
    <div class="card mb-3">
        <div class="card-body">
            <h2><?= $post->titre ?></h2>
            <small class="badge bg-secondary"><?= $post->getFormatedDate() ?></small>
            <p><?= $post->chapo ?></p>
            <!--<p><?= $post->getExcerpt() ?></p>-->
            <a href="/posts/<?= $post->id ?>" class="btn btn-primary">Lire plus</a>
        </div>
    </div>
<?php endforeach ?>