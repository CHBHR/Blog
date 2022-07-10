<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <title>Le blog de Christopher</title>

  <link rel="stylesheet" href="<?= SCRIPT . 'css' . DIRECTORY_SEPARATOR . 'app.css' ?>">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

  <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

</head>


<body class="d-flex flex-column min-vh-100">

<nav class="navbar navbar-expand-sm navbar-light bg-light">
  
  <a class="navbar-brand ml-3" href="/">Mon Blog</a>

  <button class="navbar-toggler" type="button" data-toggle="collapse"   data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="/">Accueil</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/articles">Les Articles</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="/contact">Me Contacter</a>
      </li>

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
  </div>
</nav>

<div class="container">
    <?= $content ?>
</div>

<div class="mt-4"></div>

<footer class="page-footer font-small bg-secondary mt-auto text-light">

  <!-- Footer Text -->
  <div class="container-fluid text-center">

    <!-- Grid row -->
    <div class="pt-3 d-flex flex-column flex-sm-row justify-content-around">

      <!-- Grid column -->
      <div class="col-sm-6 mt-md-0 mt-3">

        <!-- Content -->
          <!-- Links -->
          <h5 class="text-uppercase font-weight-bold">Links</h5>

          <ul class="list-unstyled justify-content-left">

            <li>
              <a class="nav-link badge badge-info" href="/admin/articles">Admin access</a>
            </li>

          </ul>

      </div>

      <!-- Grid column -->
      <div class="col-sm-6 mt-md-0 mt-3">

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