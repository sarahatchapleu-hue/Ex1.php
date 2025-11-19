<?php
 try {
      $dbh = new PDO ( dsn: 'mysql:host=localhost; dbname=jo_100; charset=utf8', username: 'root', password: '');
} catch (PDOException $e) {
    die($e->getMessage());
}
$order = "DESC";

$sth = $dbh->prepare('SELECT * FROM `100` WHERE nom = :name ORDER BY `Temps` '.$order);
$sth->execute(['name' => "Usain Bolt"]);

$sort = "nom";
if (isset($_GET['sort'])) {
  $sort = $_GET['sort'];
}

if (isset($_GET['order'])) {
  $order = $_GET['order'];
} 

$sth = $dbh->prepare('SELECT * FROM `100` order by '.$sort.' '.$order);
$sth->execute();

$data = $sth->fetchAll( mode: PDO::FETCH_ASSOC);

echo "<table>

  <thead>
    <tr>
    <th>
    Nom
      <a href='?sort=nom&order=ASC'>▲</a>
      <a href='?sort=nom&order=DESC'>▼</a>
    </th>
    <th>
    Pays
      <a href='?sort=pays&order=ASC'>▲</a>
      <a href='?sort=pays&order=DESC'>▼</a>
    </th>
    <th>
    Course
       <a href='?sort=course&order=ASC'>▲</a>
       <a href='?sort=course&order=DESC'>▼</a>
    </th>
    <th>
    Temps
      <a href='?sort=Temps&order=ASC'>▲</a>
      <a href='?sort=Temps&order=DESC'>▼</a>
    </th>

   </tr>
</thead>";
foreach ($data as $value) {
  echo "<tr>
       <td>".$value["nom"]. "</td>
       <td>".$value ["pays"]."</td>
       <td>".$value ["course"]."</td>
       <td>".$value ["temps"]. "</td>
     </tr>";
}
?>
