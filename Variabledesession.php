<?php
session_start();

// Gestion du logout
if (isset($_POST["logout"])) {
    session_unset();
    session_destroy();
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

// formulaire de connexion
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["username"])) {
    $_SESSION["username"] = $_POST["username"];
}

// Si la variable de session username n'existe pas
if (!isset($_SESSION["username"])) {
?>
    <form method="post">
        <label for="username">Username :</label>
        <input type="text" id="username" name="username" required>
        <button type="submit">Valider</button>
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
