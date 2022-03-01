
        <main>

            <h2>Les Articles</h2>

            <div id="listeArticles">

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

        </main>