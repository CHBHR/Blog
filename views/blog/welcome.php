<?php if(isset($_GET['success'])): ?>
    <div class="alert alert-success">Vous êtes connecté!</div>
<?php elseif(isset($_GET['submit'])): ?>
    <div class="alert alert-success">Votre commentaire a été envoyer pour validation</div>
<?php endif ?>

<h1 class=" mt-4"> Un blog pour me présenter </h1>

<div class="container mt-4 d-flex align-items-center justify-content-around bg-light p-2">

    <div class="col-lg-6">
        <p>
            Je m'appelle Christopher Rey </br>
            Bienvenu sur mon blog, créé pour le Projet 05 de mon parcours "Développeur d'application PHP / Symfony" avec Openclassrooms.
            Ici vous trouverez des articles de blog que j'aurai partagé et la possibilité de commenter, une présentation de mes skills et mon CV en téléchargement et un formulaire de contact pour toute question que vous pourriez avoir.
        </p>

        <p>
            N'hésitez pas à visiter le site, de vous créer un compte si vous voulez être tennu au courant des dernières avancées et mises à jours et de laisser un commentaire sur un article qui vous aurai interressé.
        </p>
    </div>

    <div class="d-none d-lg-block col-lg-4">
        <img src="/public/images/p02.jpeg" class="img-thumbnail border-none height-80%">
    </div>

</div>

<div class="container mt-4 bg-light">
    <h2>
        Mes derniers articles
    </h2>
    
    <div class="p-2 d-lg-flex justify-content-around">
        <?php foreach($params['posts'] as $post): ?>
            <div class="card mb-3 col-lg-4 text-lg-center">
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

<div class="container mt-4 bg-light">

    <div id="block-skill">

        <div id="skill-parcours">

            <h2>Mon parcours</h2>
            
            <p class="text-justify">
                Alternant en développement back-end, spécialiste PHP/SYMFONY, je fini ma reconvertion professionnelle.
                Mon parcours m'offre une vision globale du millieu ainsi qu'une compréhention des dynamiques humaines et techniques que ce soit pour livrer un produit dans des délais fixes, organiser la charge de tavail, communiquer de manière efficasse ou mettre en place de nouvelles méthodologies agiles.
            </p>

            <h5>Résumé</h5>
            <p>
                J'ai travaillé pendant plusieurs années dans des bar et boites de nuit Parisiennes, ou j'ai monté en compétence jusqu'à co-géré un bar.
                <ul>
                    <li>Prise de décision et priorisation des tâches</li>
                    <li>Travail de longues heures en restant maitre de la situation</li>
                    <li>Communication avec les clients, collègues et fournisseurs, relationnel</li>
                    <li>Management, gestion et formation d'équipe</li>
                </ul>
            </p>
            <P>
                J'ai aussi beaucoup voyagé et travaillé à l'étranger, en tant que Team-Manageur ou en solitaire
                <ul>
                    <li>Découverte de pays, culture et langues: USA, Canada, Europe, Corée, Australie, Nouvelle Zélande</li>
                    <li>Adaptation à différent travaux: event managing, construction, bar, services</li>
                    <li>Organisation, team management et médiation culturelle</li>
                </ul>
            </P>
            <p>
                Aujourd'hui je change de carrière pour devenir un développeur avec le programme Openclassrooms et chez Openclassrooms également, ou je continue d'apprendre.
                <ul>
                    <li>Organisation Agile et méthodologies de découpe de tâches, priorisations et estimation du temps de travail</li>
                    <li>Clean Architecture, tests et versionning</li>
                    <li>Utilisation et maintenance de PHP/SYMFONY et autres frameworks et librairies</li>
                    <li>Participation à l'améioration des outils, de la documentation et facilitation du partage des compétences</li>
                </ul>
            </p>

        </div>

        <div id="skill-hard">
            <h3>Hard Skills</h3>
            <ul>
                <li>Comprendre, réfactorer et participer à la maintenance du code sur une Clean Architecture en OOP PHP/SYMFONY</li>
                <li>Coder en Test Driven Design, corriger les bugs (xDebug) et utiliser des outils de verisonning (GitHub)</li>
                <li>Création et gestion des droits d'une API REST</li>
                <li>Maitrise des langages: HTML/CSS/JS/PHP/SQL</li>
                <li>Notions en: C / RUST / JAVA</li>
                <li>Bilingue Franco-Anglais et bonnes notions en Espagnol</li>
            </ul>
        </div>

        <div id="skill-soft">
            <h3>Soft Skills</h3>
            <ul>
                <li>Très bon communicant, je n'hésite pas à poser des questions, partager l'information et m'adapter à la langue et culture de mon interlocuteur. Ayant quivis des workshops de communication non violente (CNV) je peut désamorcer des conflits</li>
                <li>Volontaire, curieux et travailleur je sais gérer mon temps de manière efficasse et chercher la meilleure solution pour tous les partis concernés. J'aime en apprendre sur tous les sujets pour avoir une vision holistique et pouvoir m'adapter, innover ou améliorer les conditions de travail de mes collègues</li>
                <li>Adaptable, autant en travail d'équipe ou en autonomie, je cherche toujours le meilleur résulta pour le plus grand nombre. Je comprend les dynamiques qu'un travail partagé implique et me soucis de la bonne compréhention et du bien être de mes collègues. J'ai eu la chance de travailler avec de nombreuses personnes de différents pays, cultures et parcours</li>
            </ul>
        </div>

        <div id="skill-hobby">
            <h3>Centres d'interet</h3>
            <p>
            Grand amateur de jeux vidéo, jeux de sociétés et 'wargames', je participe à toutes les facettes du processus:
            <ul>
                <li>Game design, suivis d'évênements type LUDUM DARE et GAME JAMS ainsi que des compétitions esport</li>
                <li>Collection, contrustion et peintures de figurines pour jeux de roles et d'escarmouche/guerre (Warhammer, Carnevale, Rumbleslam)</li>
                <li>Découverte, feedback et conception de plusieurs jeux et mouvements artistiques sur le sujet (BrawlArcane28, Turnip28): j'aime m'intégrer dans les communautés et participer autant que possible</li>
            </ul>
            </p>

            <p>J'aime énormément voyager, découvrir et me perdre dans de nouveaux endroits autours du monde, avec une préférence pour l'Australie et la Nouvelle Zélande (que je recommande grandement)</p>
            
        </div>
        
    </div>

</div>

<div class="text-center bg-light p-2">
    
    <h5>CV</h5>
    <p>Si cette présentation résumée vous a interessée, vous pouvez trouver un lien ci-dessous pour télécharger un CV plus complet. Mes informations de contact y sont présentes également:</p>
    <a href="/downloadpdf" target="_blank">Télécharger mon CV en format PDF</a>

</div>

<div class="container mt-4  text-center">

    <h3>Socials</h3>

    <p>
        Vous trouverez ici des liens vers mes différents réseaux sociaux, si vous voulez découvrir mon travail ou mes hobby
    </p>

    <div class="col-6 mx-auto d-flex justify-content-around">

        <!-- Facebook -->
        <a class="btn btn-primary" style="background-color: #3b5998;" href="#!" role="button"
        ><i class="fab fa-facebook-f"></i
        ></a>

        <!-- Twitter -->
        <a class="btn btn-primary" style="background-color: #55acee;" href="#!" role="button"
        ><i class="fab fa-twitter"></i
        ></a>

        <!-- Instagram -->
        <a class="btn btn-primary" style="background-color: #ac2bac;" href="#!" role="button"
        ><i class="fab fa-instagram"></i
        ></a>

        <!-- Linkedin -->
        <a class="btn btn-primary" style="background-color: #0082ca;" href="#!" role="button"
        ><i class="fab fa-linkedin-in"></i
        ></a>

        <!-- Github -->
        <a class="btn btn-primary" style="background-color: #333333;" href="#!" role="button"
        ><i class="fab fa-github"></i
        ></a>

    </div>

</div>

<div class="container mt-4 bg-light col-lg-6 ">
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