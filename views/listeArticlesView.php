    <main>

        <h2>Les Articles</h2>

        <div id="listeArticles">  
        
        <?php
        $dataArticle = getAllArticle();
        //var_dump($dataArticle);
        if(count($dataArticle) > 0):?>
            
            <?php foreach($dataArticle as $article){?>
                
                    <h3><?php echo $article['titre']; ?></h3>
                    <p><?php echo $article['chapo']; ?></p>
                    <a href="../controller/articleController.php?id=<?php echo $article['id'] ?>" >Lire l'article</a>
                    <p><?php echo(getAuteurName($article['auteur_id'])); ?></p>
                    
        <?php } else:
        echo "Désolé, il n'y a pas d'artciles disponnible pour le moment.";
        endif;
        ?>
        
        

        </div>

        <div id="creeArticle">
        
        <?php
            if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'):?>
                
                <h2>Créer un nouvel article</h2>

                <form method="post" action="../controller/listeArticleController.php">
                    
                    <label for="titre">Titre</label><br>
                    <input type="text" id="titre" name="titre"><br>

                    <label for="chapo">Chapo</label><br>
                    <textarea id="chapo" name="chapo"></textarea><br>

                    <label for="contenu">Contenu</label><br>
                    <textarea id="contenu" name="contenu"></textarea><br>

                    <input type="submit" value="Sauvegarder" name="formCreationArticle">
                    
                </form>
                
        <?php endif; ?>
            
        </div>
        <?php ; ?>
    </main>