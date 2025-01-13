
  <h1>Inscription</h1>
  <form method="POST" action="./php/inscription.php" class="inscription-form">
    <input type="text" name="nom" placeholder="Nom" required>
    <input type="email" name="email" placeholder="Email" required>
    <input type="password" name="mot_de_passe" placeholder="Mot de Passe" required>
    <input type="submit" value="s'inscrire">
    <p>
      <?php if (isset($_GET['error'])) echo "{$_GET['error']}"; ?>
    </p>
  </form>