<h1><?= $params['post']->titre ?></h1>
<small><?= $params['post']->chapo ?></small>
<p><?= $params['post']->contenu ?></p>
<small><?= $params['post']->getFormatedDate() ?></small>
<p><?= var_dump($params['post']->auteur_id) ?></p>

<a href="/posts" class="btn btn-secondary">Revenir en arrière</a>