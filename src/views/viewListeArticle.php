<div>
    <h2>
        "Articles"
    </h2>
    
    <div>
    
        <?php

        if ($articles):
            foreach ($articles as $article): 
            ?>

            <div>
                <h3>
                    <a href="post&id=<?= $article->getId() ?>"><?= $article->getTitre() ?></a>
                </h3>
                <p>
                    <?= $article->getChapo() ?>
                </p>
                <p>
                    <?= date('Y/m/d',strtotime($article->getDateMAJ())) ?>
                </p>
            </div>

            <?php endforeach ?>
        
        <? else: echo "Il n'y a aucun article"?>
            
        <?php endif; ?>
        

    </div>

    <a href="post&create">Create New Article</a>

</div>