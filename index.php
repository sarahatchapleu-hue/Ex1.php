<?php
 try {
      $mysqlClient = new PDO ( dsn: 'mysql:host=localhost; dbname=jo_100; charset=utf8', username: 'root', password: '');
} catch (PDOException $e) {
    die($e->getMessage());
}
?>