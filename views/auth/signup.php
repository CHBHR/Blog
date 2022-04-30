<?php if (isset($_SESSION['errors'])): ?>

<?php foreach($_SESSION['errors'] as $errorsArray): ?>
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

<h2>S'inscrire</h2>

<form action="/signin" method="POST">
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
    <div class="form-group">
        <label for="passwordCheck">Répétez votre mot de passe / Password Check</label>
        <input type="passwordCheck" class="form-control" name="passwordCheck" id="passwordCheck">
    </div>

    <button type="submit" class="btn btn-primary">S'inscrire</button>
</form>