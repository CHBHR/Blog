<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Le Blog de CHBHR</title>

    <link rel="stylesheet" href="/src/public/css/normalize.css">

    <!-- Importation des fonts  -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&family=Roboto:wght@300&display=swap" rel="stylesheet"> 
    <link rel="stylesheet" href="/src/public/css/header.css">

    <link rel="stylesheet" href="/src/public/css/header.css">

    <link rel="stylesheet" href="/src/public/css/stylesheet.css">

    <link rel="stylesheet" href="/src/public/css/footer.css">
    
</head>
<body>

    <header>
        <h1>"Moi c'est Chris et ça c'est mon blog"</h1>
        <nav id="header_nav">
            <ul>
                <li>
                    <a href="/src/controller/controller.php">
                        Accueil
                    </a>
                </li>
                <li>
                    <a href="#">
                        Skills
                    </a>
                </li>
                <li>
                    <a href="/src/controller/listeArticleController.php">
                        Articles
                    </a>
                </li>

                <?php
                if(!isset($_SESSION['nomUtilisateur']))
                {
                    echo " <li>
                    <a href='/src/controller/connexionController.php'>
                        Connexion/Inscription
                    </a>
                    </li>";
                } else {
                    echo "
                    <li>
                       Bonjour " . $_SESSION['nomUtilisateur'] . "
                    </li>
                    <li>
                        <a href='/src/Logout.php'>
                            Deconnexion
                        </a>
                    </li>";
                }
                ?>
                
            </ul>
        </nav>
    </header>