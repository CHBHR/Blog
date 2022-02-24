
        <main>

            <h2>Les Articles</h2>
            
            <div>
                <?php

                include_once '../model/model.php';
                $db = dbConnect();

                $sqlQuery = 'SELECT * FROM article';
                $articleStatement = $db->prepare($sqlQuery);
                $articleStatement->execute();
                $articles = $articleStatement->fetchAll();

                foreach ($articles as $article){
                    ?>
                    <h3><?php echo $article['titre']; ?></h3>
                    <p><?php echo $article['chapo']; ?></p>
                    <p><?php echo $article['contenu']; ?></p>
                    
                    <?php
                }
                ?>

            </div>

            <div id="listeArticles">

                <div class="artcileApercu">
                    <h3>Titre de l'article 1</h3>
                    <p>chapo: message de résumé du contenu</p>
                    <p>Autheur</p>
                    <p>Date de publication</p>
                    <p>Nombre de commentaires</p>
                </div>

            </div>

        </main>