<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
<?php elseif(isset($_GET['submit'])): ?>
    <div class="alert alert-success">Votre commentaire a été envoyer pour validation</div>
<?php endif ?>

<h1 class=" mt-4"> Un blog pour me présenter </h1>

<div class="container  mt-4">

    <p>
        Bonjour, je m'appelle Christopher et bienvenu sur mon blog, créé pour le Projet 05 de mon parcours "Développeur d'application PHP / Symfony" avec Openclassrooms.
        Ici vous trouverez des articles de blog que j'aurai partagé et la possibilité de commenter, une présentation de mes skills et mon CV en téléchargement et un formulaire de contact pour toute question que vous pourriez avoir.
    </p>

    <p>
        N'hésitez pas à vous balader sur le site, de laisser un commentaire et de vous créer un compte si vous voulez être tennu au courant des dernières avancées et mises à jours.
    </p>

</div>

<div class="container">
    <h2>
        Mes derniers articles
    </h2>
    
    <div class="bg-light p-2">
        <?php foreach($params['posts'] as $post): ?>
            <div class="card mb-3">
                <div class="card-body">
                    <h2><?= $post->titre ?></h2>
                    <small class="badge bg-secondary"><?= $post->getFormatedDate($post->date_creation) ?></small>
                    <p><?= $post->getExcerpt($post->chapo) ?></p>
                    <p>Ecrit par <?= $post->getAuthor($post->auteur_id) ?></p>
                    <a href="/posts/<?= $post->id ?>" class="btn btn-primary">Lire plus</a>
                </div>
            </div>
        <?php endforeach ?>
    </div>

    <a href="/posts" class="btn btn-primary mt-3">Voir plus</a>

</div>

<div class="container mt-4">
    <h3>
        Bientot ici, le téléchargement de mon CV Et la liste de mes skills
    </h3>

    <div id="block-skill">

        <div id="skill-parcours">
            <p>
                implémenter historique et parcours
            </p>
        </div>

        <div id="skill-hard">
            <p>
                implémenter hard skill liste
            </p>
        </div>

        <div id="skill-soft">
            <p>
                implémenter soft skill liste
            </p>
        </div>
        
    </div>

    <a href="/downloadpdf" target="_blank">Télécharger mon CV en format PDF</a>
</div>

<div class="container  mt-4">
    <h3>Me contacter</h3>
    <p>
        Vous voulez me contacter, me poser une question ou en savoir plus sur mon parcours? Vous pouvez remplir ce formulaire et je m'éforcerai de vous répondre le plus rapidement possible.
    </p>
    <form action="/contact" method="POST">
        <div class="form-group">
            <label for="name">Nom / Prénom</label>
            <input type="text" class="form-control" name="name" id="name">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email">
        </div>
        <div class="form-group">
            <label for="menu">Votre message</label>
            <textarea name="menu" id="menu" rows="8" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
    </form>
</div>