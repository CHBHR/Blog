   
        <div id="connexionBody">
            <h2>Connexion</h2>
            <form method="post" action="../process.php">

            <label for="nomUtilisateur">Nom d'utilisateur</label><br>
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" required><br>
                <label for="mdp">Mot de passe</label><br>
                <input type="password" id="mdp" name="mdp" required><br>
                <input type="submit" value="Connexion" name="formConnection"><br>
            </form>
        </div>
        
        <div id="inscriptionBody">
            <h2>Inscription</h2>
            <form method="post" action="../process.php">
                
                <label for="nomUtilisateur">Nom d'utilisateur</label><br>
                <input type="text" id="nomUtilisateur" name="nomUtilisateur" required><br>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email" required><br>
                <label for="mdp">Mot de passe</label><br>
                <input type="password" id="mdp" name="mdp" required><br>
                <label for="mdpConfirmation">Confirmez le mot de passe</label><br>
                <input type="password" id="mdpConfirmation" name="mdpConfirmation" required><br>
                <input type="submit" value="Inscription" name="formInscription">
                <?php
                    echo $errors ="";
                ?>
            </form>
        </div>
