<?php
require 'db.php';
$BookId = $_GET['id'];
$sql = 'DELETE FROM books WHERE BookId=?';
$statement = $connection->prepare($sql);
if ($statement->execute([$BookId])) {
  header("Location: BookList.php");
}