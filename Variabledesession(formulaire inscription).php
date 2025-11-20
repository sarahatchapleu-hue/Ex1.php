<?php
session_start();

 try {
    $dbh = new PDO("mysql:host=localhost;dbname=jo_100; charset=utf8", "root",  "" );
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// Gestion du logout
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// formulaire de connexion

if (isset($_POST['register'])) {
   if ($_POST['username'] != '' && $_POST['password'] != ''){
      $hash = password_hash($_POST['password'],  PASSWORD_DEFAULT);
      $sth = $dbh->prepare( query: "INSERT INTO `user` (`username`, `password`) VALUES (:username, :password)"
    );
      $sth->execute([
        'username'=> $_POST['username'],
        'password'=> $hash,
      ]);
      echo "<b>Votre inscription est valide</b>";
    }

}

// Si la variable de session username n'existe pas
  if (!isset($_SESSION["username"])) {
?>
    <h1>Inscription</h1>
    <form method="post">
        <label for="username">Username :</label>
        <input type="text" id="username" name="username"><br/> 
        <label for="Password">Password :</label>
        <input type="password" id="password" name="password"><br/>

        <input type="submit" value="valider" name="register">
    </form>
<?php

     //Connexion

    if (isset($_POST['connect'])) {

    // Verification
    if (!empty($_POST['username']) && !empty($_POST['password'])) {

    // Chercher l'utilisateur
        $sth = $dbh->prepare("SELECT * FROM `user` WHERE `username` = :username");
        $sth->execute(['username' => $_POST['username']]);
        $user = $sth->fetch(PDO::FETCH_ASSOC);

        if ($user) {
    // Verifier le mot de passe
            if (password_verify($_POST['password'], $user['password'])) {
                $_SESSION['username'] = $user['username'];
                echo "<b>Connexion réussie</b>";
            } else {
                echo "<b>Mot de passe incorrect !</b>";
            }
        } else {
            echo "<b>Utilisateur inconnu</b>";
        }
    }
}   
?>
    <h1>Connection</h1>
     <form method="post">
    <label>Username : </label>
    <input type="text" name="username"><br/>
    <label>Password : </label>
    <input type="password" name="password"><br/>
    <input type="submit" value="valider" name="connect">
</form>

<?php
} else {
    echo "<h1>Bonjour " . htmlspecialchars($_SESSION["username"]) . "</h1>";
?>
    <form method="post">
        <button type="submit" name="logout">Supprimer / Déconnexion</button>
    </form>
<?php
}
?>
