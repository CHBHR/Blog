<div id="creeArticle">
        
        <?php
            //if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'):?>
                
                <h2>Créer un nouvel article</h2>

                <form method="post" action="post&status=new">
                    
                    <label for="titre">Titre</label><br>
                    <input type="text" id="titre" name="titre"><br>

                    <label for="chapo">Chapo</label><br>
                    <textarea id="chapo" name="chapo"></textarea><br>

                    <label for="contenu">Contenu</label><br>
                    <textarea id="contenu" name="contenu"></textarea><br>

                    <input type="submit" value="Sauvegarder" name="formCreationArticle">
                    
                </form>
                
        <?php //endif; ?>
        
    </div>