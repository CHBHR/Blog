<div>
      
    <h2><b><?= $article[0]->getTitre(); ?></b></h2>
    
    <p><?= $article[0]->getChapo(); ?></p>

    <p><?= $article[0]->getContenu(); ?></p>

    <p><?= date('d/m/Y',strtotime($article[0]->getDateMAJ())); ?></p>

</div>
