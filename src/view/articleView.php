
<main>

    <div>
      
        <h2><?php echo $dataArticle['titre']; ?></h2>
        
        <p><?php echo $dataArticle['chapo']; ?></p>

        <p><?php echo $dataArticle['contenu']; ?></p>

        <p><?php echo date('d/m/Y',strtotime($dataArticle['date_mise_a_jour'])); ?></p>

        <!-- <p><?php echo(getAuteurName($article['auteur_id'])); ?></p>-->

    </div>

    

</main>