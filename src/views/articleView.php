
<main>

    <div>
      
        <h2><?php echo $dataArticle['titre']; ?></h2>
        
        <p><?php echo $dataArticle['chapo']; ?></p>

        <p><?php echo $dataArticle['contenu']; ?></p>

        <p><?php echo date('d/m/Y',strtotime($dataArticle['date_mise_a_jour'])); ?></p>

    </div>

    <?php
    if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'):?>
        
        <div>

            <h2>Modfifier article</h2>

            <form method="post" action="../controller/articleController.php">
                
                <label for="titre">Titre</label><br>
                <input type="text" id="titre" name="titre" value="<?php echo $dataArticle['titre']; ?>"><br>

                <label for="chapo">Chapo</label><br>
                <textarea id="chapo" name="chapo"><?php echo $dataArticle['chapo']; ?></textarea><br>

                <label for="contenu">Contenu</label><br>
                <textarea id="contenu" name="contenu"><?php echo $dataArticle['contenu']; ?></textarea><br>

                <input type="submit" value="Modifier" name="formUpdateArticle">
                
            </form>

        </div>
        
    <?php endif; ?>

    

</main>