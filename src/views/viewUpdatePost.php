<div>

    <h2>Mettre à jour l'article</h2>

    <form method="post" action="update&id=<?= $article[0]->getId();?>">
        
        <label for="titre">Titre</label><br>
        <input type="text" id="titre" name="titre" value="<?= $article[0]->getTitre(); ?>"><br>

        <label for="chapo">Chapo</label><br>
        <textarea id="chapo" name="chapo"><?= $article[0]->getChapo(); ?></textarea><br>

        <label for="contenu">Contenu</label><br>
        <textarea id="contenu" name="contenu"><?= $article[0]->getContenu(); ?></textarea><br>

        <input type="submit" value="Mettre à jour" name="formUpdateArticle">
        
    </form>

</div>