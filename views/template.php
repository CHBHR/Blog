<?php

// if (!isset($_SESSION)) {
//     session_start();
// }

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $_SESSION['postdata'] = $_POST;
    unset($_POST);
    header("Location: ".$_SERVER['PHP_SELF']);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Blog de CHBHR</title>

    <link rel="stylesheet" href="/public/css/normalize.css">

    <!-- Importation des fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    
    <link rel="stylesheet" href="/public/css/header.css">

    <link rel="stylesheet" href="/public/css/stylesheet.css">

    <link rel="stylesheet" href="/public/css/footer.css">
    
</head>
<body>

    <header>
        <h1>"Moi c'est Chris et ça c'est mon blog"</h1>
        <nav id="header_nav">
            <ul>
                <li>
                    <a href="index.php?accueil">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="#">
                        Skills
                    </a>
                </li>
                <li>
                    <a href="index.php?listeArticle">
                        Articles
                    </a>
                </li>

                <?php
                if(!isset($_SESSION['nomUtilisateur']))
                {
                    echo " <li>
                    <a href='index.php?users'>
                        Connexion/Inscription
                    </a>
                    </li>";
                } else {
                    echo "
                    <li>
                       Bonjour " . $_SESSION['nomUtilisateur'] . "
                    </li>
                    <li>
                        <a href='users&q=logout'>
                            Deconnexion
                        </a>
                    </li>";
                }
                ?>
                
            </ul>
        </nav>

    </header>

    <main>

    <?= $content ;?>

    </main>

    <footer>

        <nav>
            <li>
                <a href="#">
                    Politique de confidencialité
                </a>
            </li>
            <li>
                <a href="#">
                    Admin access
                </a>
            </li>
        </nav>

    </footer>

</body>
</html>