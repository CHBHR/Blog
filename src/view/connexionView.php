   
        <div id="connexionBody">
            <h2>Connexion</h2>
            <form>
                <label for="formConnexionEmail">Email</label><br>
                <input type="email" id="formConnexionEmail"><br>
                <label for="formConnexionMdp">Mot de passe</label><br>
                <input type="password" id="formConnexionMdp"><br>
                <input type="submit" value="valider"><br>
            </form>
        </div>
        
        <div id="inscriptionBody">
            <h2>Inscription</h2>
            <form method="post" action="../controller/Register.php">
                
                <label for="nomUtilisateur">Nom d'utilisateur</label><br>
                <input type="text" id="nomUtilisateur" name="nomUtilisateur"><br>
                <label for="email">Email</label><br>
                <input type="email" id="email" name="email"><br>
                <label for="pass">Mot de passe</label><br>
                <input type="password" id="pass" name="pass"><br>
                <label for="passConfirmation">Confirmez le mot de passe</label><br>
                <input type="password" id="passConfirmation" name="passConfirmation"><br>
                <input type="submit" value="valider" name="formulaireInscription">
            </form>
        </div>
