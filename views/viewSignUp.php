<?php
    include_once 'helpers/session_helper.php';
?>
<div>

    <h2>Sign up</h2>

    <?php flash('register') ?>

    <form method="post" action="users&type=register">
        <input type="hidden" name="type" value="register">
        <input type="text" name="nomUtilisateur" placeholder="nom d'utilisateur...">
        <input type="text" name="email" placeholder="email...">
        <input type="password" name="mdp" placeholder="mot de passe...">
        <input type="password" name="mdpVerification" placeholder="confirmation mot de passe">
        <button type="submit" name="formSignIn">Sign Up</button>
    </form>

</div>

<div>

    <h2>Login</h2>

    <?php flash('login') ?>

    <form method="post" action="users&type=login">
        <input type="hidden" name="type" value="login">
        <input type="text" name="nomUtilisateur/email" placeholder="nom d'utilisateur ou email...">
        <input type="password" name="mdp" placeholder="mot de passe...">
        <button type="submit" name="formLogin">Login</button>
    </form>

</div>