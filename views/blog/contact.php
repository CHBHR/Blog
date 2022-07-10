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

<div class="container mt-4 bg-light col-lg-6 ">

    <h1>Me contacter</h1>

    <p>
        Vous voulez me contacter, me poser une question ou en savoir plus sur mon parcours? Vous pouvez remplir ce formulaire et je m'éforcerai de vous répondre le plus rapidement possible.
    </p>

    <form action="/contact/" method="POST">
        <div class="form-group">
            <label for="name">Nom / Prénom</label>
            <input type="text" class="form-control" name="name" id="name" required>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" class="form-control" name="email" id="email" required>
        </div>
        <div class="form-group">
            <label for="message">Votre message</label>
            <textarea name="message" id="message" rows="8" class="form-control" required></textarea>
        </div>

        <button type="submit" class="btn btn-primary mt-2">Envoyer</button>
    </form>
</div>