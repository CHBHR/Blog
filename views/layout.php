<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon super site</title>

    <link rel="stylesheet" href="<?= SCRIPT . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">
</head>


<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-sm navbar-light bg-light">
  <a class="navbar-brand pl-3" href="/">Blog</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav container-fluid">
      <li class="nav-item">
        <a class="nav-link" href="/">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/posts">Derniers Articles</a>
      </li>

      <!-- <li class="nav-item dropdown">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Dropdown
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
          <a class="dropdown-item" href="#">Action</a>
          <a class="dropdown-item" href="#">Another action</a>
          <div class="dropdown-divider"></div>
          <a class="dropdown-item" href="#">Something else here</a>
        </div>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li> -->
      <?php if (isset($_SESSION['auth'])): ?>
      <li class="nav-item ml-auto">
        <a class="nav-link" href="/logout">Se déconnecter</a>
      </li>
      <?php else: ?>
      <li class="nav-item ml-auto">
        <a class="nav-link" href="/login">Se connecter</a>
      </li>
      <?php endif?>
    </ul>
    <ul class="navbar-nav align-self-right">

    </ul>
    <!-- <form class="form-inline my-2 my-lg-0">
      <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
    </form> -->
  </div>
</nav>

<div class="container">
    <?= $content ?>
</div>


<footer class="page-footer font-small bg-secondary mt-auto text-light">

  <!-- Footer Text -->
  <div class="container-fluid text-center">

    <!-- Grid row -->
    <div class="row display-flex justify-content-around">

      <!-- Grid column -->
      <div class="col-3 mt-md-0 mt-3">

        <!-- Content -->
          <!-- Links -->
          <h5 class="text-uppercase font-weight-bold">Links</h5>

          <ul class="list-unstyled justify-content-left">

            <li>
              <a class="nav-link badge badge-info" href="/admin/posts">Admin access</a>
            </li>

          </ul>

      </div>

      <!-- Grid column -->
      <div class="col-5 mt-md-0 mt-3">

        <!-- Content -->
        <h5 class="text-uppercase font-weight-bold">Le projet</h5>
        <p class="text-justify">
          Ce blog a été créé dans le cadre de la formation "Développeur d'application PHP / Symfony" d'Openclassrooms. Il a été fait en vanila PHP sans ajout de librairies ou framework et le front a été fait avec Bootstrap.
        </p>

      </div>
      <!-- Grid column -->

    </div>
    <!-- Grid row -->

  </div>
  <!-- Footer Text -->

</footer>

</body>

</html>