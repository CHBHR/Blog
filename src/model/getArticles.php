<?php

require 'model.php';

$sqlQuery = 'SELECT * FROM article';
$articleStatement = $db->prepare($sqlQuery);
$articleStatement->execute();
$articles = $articleStatement->fetchAll();

foreach ($articles as $article){
    ?>
    <h3><?php echo $article['titre']; ?></h3>
    <p><?php echo $artcile['contenu']; ?></p>
    <?php
}