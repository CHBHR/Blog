<?php    
    if (!empty($params['session'])): ?>
    
<?php foreach($params['session'] as $errorsArray): ?>
    <?php foreach($errorsArray as $errors): ?>
        <div class="alert alert-danger">
            <?php foreach($errors as $error): ?>
                <li><?= $error ?></li>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
<?php endforeach ?>

<?php endif ?>
<?php session_destroy() ?>

<h2>Se connecter</h2>

<form action="/login" method="POST">
    <div class="form-group">
        <label for="username">Nom d'utilisateur / Username</label>
        <input type="text" class="form-control" name="username" id="username">
    </div>
    <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" name="email" id="email">
    </div>
    <div class="form-group">
        <label for="password">Mot de passe / Password</label>
        <input type="password" class="form-control" name="password" id="password">
    </div>

    <button type="submit" class="btn btn-primary mt-2">Se connecter</button>
</form>

<div class="container mt-3">
    <p>
        Pas encore inscrit?
    </p>
    <a class="btn btn-success" href="/signup" role="button">S'inscrire</a>
</div>
