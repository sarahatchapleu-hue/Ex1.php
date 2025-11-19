<?php
 try {
    $db = new PDO("mysql:host=localhost;dbname=jo_100;charset=utf8", "root", "");
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die($e->getMessage());
}

$edit = null;
if (isset($_GET["edit"])) {
    $id = intval($_GET["edit"]);
    $q = $db->prepare("SELECT * FROM `100` WHERE id=?");
    $q->execute([$id]);
    $edit = $q->fetch(PDO::FETCH_ASSOC);
}

// Ajout de la modification

if (!empty($_POST)) {

    $nom = trim($_POST["nom"]);
    $pays = strtoupper(trim($_POST["pays"]));
    $course = $_POST["course"];
    $temps = $_POST["temps"];

    $erreurs = [];
    if (strlen($pays) !== 3) $erreurs[] = "Le code pays doit faire 3 lettres.";
    if (!is_numeric($temps)) $erreurs[] = "Temps invalide.";

    if (empty($erreurs)) {
        if (!empty($_POST["id"])) {
            $sql = $db->prepare("UPDATE `100` SET nom=?, pays=?, course=?, temps=? WHERE id=?");
            $sql->execute([$nom, $pays, $course, $temps, $_POST["id"]]);
            echo "<p style='color:green;'>Modification réussie.</p>";
        } 
        else {
            $sql = $db->prepare("INSERT INTO `100` (nom,pays,course,temps) VALUES (?,?,?,?)");
            $sql->execute([$nom, $pays, $course, $temps]);
            echo "<p style='color:green;'>Ajout effectué !</p>";
        }
    } else {
        foreach ($erreurs as $e) echo "<p style='color:red;'>$e</p>";
    }
}

// Champ de recherche

$search = $_GET["s"] ?? "";

// Tri
$cols = ["nom","pays","course","temps"];
$sort = $_GET["sort"] ?? "nom";
if (!in_array($sort,$cols)) $sort="nom";

$order = strtoupper($_GET["order"] ?? "ASC");
$order = ($order==="DESC") ? "DESC":"ASC";

// Pagination
$limit = 10;
$page = isset($_GET["page"]) ? max(1,intval($_GET["page"])) : 1;
$offset = ($page-1)*$limit;

$total = $db->prepare("SELECT COUNT(*) FROM `100` WHERE nom LIKE ?");
$total->execute(["%$search%"]);
$totalRows = $total->fetchColumn();
$totalPages = ceil($totalRows/$limit);

// Recuperation des donnees
$sql = $db->prepare("
    SELECT * FROM `100`
    WHERE nom LIKE ?
    ORDER BY $sort $order
    LIMIT $limit OFFSET $offset
");
$sql->execute(["%$search%"]);
$data = $sql->fetchAll(PDO::FETCH_ASSOC);

// course
$courses = $db->query("SELECT DISTINCT course FROM `100`")->fetchAll(PDO::FETCH_COLUMN);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Gestion 100m</title>
<style>
table { border-collapse: collapse; width: 70%; margin-top:20px; }
td,th { border:1px solid #333; padding:6px; }
</style>
</head>
<body>

<h2><?= $edit ? "Modifier" : "Ajouter" ?> un resultat</h2>

<form method="post">
    <?php if($edit): ?>
        <input type="hidden" name="id" value="<?= $edit['id'] ?>">
    <?php endif; ?>

    Nom : <input type="text" name="nom" value="<?= $edit['nom'] ?? '' ?>" required><br><br>
    Pays : <input type="text" maxlength="3" name="pays" value="<?= $edit['pays'] ?? '' ?>" required><br><br>

    Course :
    <select name="course">
        <?php foreach($courses as $c): ?>
            <option value="<?= $c ?>" <?= ($edit && $edit["course"]==$c)?"selected":"" ?>><?= $c ?></option>
        <?php endforeach; ?>
    </select>
    <br><br>

    Temps : <input type="number" step="0.01" name="temps" value="<?= $edit['temps'] ?? '' ?>" required><br><br>

    <button type="submit"><?= $edit ? "Modifier" : "Ajouter" ?></button>
</form>

<hr>

<h2>Recherche</h2>
<form>
    <input type="text" name="s" value="<?= htmlspecialchars($search) ?>" placeholder="Nom">
    <button type="submit">Chercher</button>
</form>

<h2>Resultats</h2>

<table>
<tr>
    <th><a href="?sort=nom&order=<?= $order==='ASC'?'DESC':'ASC' ?>">Nom</a></th>
    <th><a href="?sort=pays&order=<?= $order==='ASC'?'DESC':'ASC' ?>">Pays</a></th>
    <th><a href="?sort=course&order=<?= $order==='ASC'?'DESC':'ASC' ?>">Course</a></th>
    <th><a href="?sort=temps&order=<?= $order==='ASC'?'DESC':'ASC' ?>">Temps</a></th>
    <th>Modifier</th>
</tr>

<?php foreach($data as $row): ?>
<tr>
    <td><?= htmlspecialchars($row["nom"]) ?></td>
    <td><?= htmlspecialchars($row["pays"]) ?></td>
    <td><?= htmlspecialchars($row["course"]) ?></td>
    <td><?= htmlspecialchars($row["temps"]) ?></td>
    <td><a href="?edit=<?= $row["id"] ?>">✏️</a></td>
</tr>
<?php endforeach; ?>
</table>

<br>

<?php for($i=1;$i<=$totalPages;$i++): ?>
    <?= ($i==$page) ? "<strong>$i</strong> " : "<a href='?page=$i&s=$search&sort=$sort&order=$order'>$i</a> " ?>
<?php endfor; ?>

</body>
</html>








