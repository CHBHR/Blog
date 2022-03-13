<div>
      
    <h2><b><?= $article[0]->getTitre(); ?></b></h2>
    
    <p><?= $article[0]->getChapo(); ?></p>

    <p><?= $article[0]->getContenu(); ?></p>

    <p><?= date('d/m/Y',strtotime($article[0]->getDateMAJ())); ?></p>

</div>

<div>

    <form method="post" action="post&action=delete&id=<?= $article[0]->getId(); ?>">
        <input type="submit" value="Supprimer" name="buttonDeleteArticle">        
    </form>

    <form method="post" action="update&id=<?= $article[0]->getId(); ?>">
        <input type="submit" value="Modifier" name="buttonUpdateArticle">
    </form>

</div>