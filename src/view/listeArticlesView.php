        <main>

            <h2>Les Articles</h2>

            <div id="listeArticles">      
            
            <?

            
            $dataArticle = getArticle();
            var_dump($dataArticle);
            
            if($dataArticle->num_rows > 0){
                
                foreach($dataArticle as $article){?>
            
                        <h3><? echo $article['titre']; ?></h3>
                        <p><? echo $article['chapo']; ?></p>
                        <p><? echo $article['contenu']; ?></p>
                        <p><? echo $article['auteur']; ?></p>
                        <?
                }
            } else {
                echo "Désolé, il n'y a pas d'artciles disponnible pour le moment.";
            }?>
            

            </div>

            <div id="creeArticle">
            
            <?
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin')
                {
                        ?>
                    
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
                    
                <? } ?>
               
            </div>

        </main>