<!-- formulaire de connexion -->

    <h1>Login</h1>
    <form class="inscription-form" method="POST" action="./php/login.php">
        <input type="email" name="email" placeholder="Email" required>
        <input type="password" name="mot_de_passe" placeholder="Mot de Passe" required>
        <a href="">Mot de Passe oublié ?</a>
        <input type="submit" value="Connexion">
        
        <strong>Pas encore membre ?</strong>
            <a href="connexion/inscription">Inscrivez-vous maintenant</a>
        <p>
      <?php if (isset($_GET['error'])) echo "{$_GET['error']}"; ?>
      </p>
    </form>