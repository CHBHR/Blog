
<main>

<div>
    <h2>
        "À propos de moi"
    </h2>
    <p>
        Mon nom est Christopher Rey, j'ai 31 ans et je suis en reconversion dans le monde du développement web, spécialiste back end.
        Je travail dur pour réapprendre un métier, tant sur le plan technique que sur les méthodologies, architectures et 'best practices' qui le compose. Devenir déveoppeur est un rêve d'enfant et je me suis lancé il y a quelques années. Bienvenus sur mon blog :)
        <br>
        Ici vous pourrez trouver des informations sur moi, mon CV, des articles écris ou partagé, des liens vers mes réseaux sociaux et d'éventuels projets que j'updaterai régulièrement.
        <br>
        N'hésitez pas à faire un tours et contactez moi si mon profil vous interesse ;)
    </p>
</div>

<div>
    <h2>
        "Mes skills, Mon CV"
    </h2>
    <p>
        Liste de mes skills et téléchargement du CV bientot disponible
        <br>
        <a href="">Hâte?</a>
    </p>
</div>

<div>
    <h2>
        "Articles"
    </h2>
    
    <div>
    
        <?php

        foreach ($articles as $article): 
            ?>

            <div>
                <h3>
                    <a href="post&id=<?= $article->getId() ?>"><?= $article->getTitre() ?></a>
                </h3>
                <p>
                    <?= $article->getChapo() ?>
                </p>
                <p>
                    <?= date('d/m/Y',strtotime($article->getDateMAJ())) ?>
                </p>
            </div>


        <?php endforeach ?>

        </div>
</div>

</main>