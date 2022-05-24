<?php
require 'connect.php';
try {
  $del2 = $db->prepare("DELETE FROM powers WHERE id=?");
  $del2->bindParam(1, $_GET['id']);
  $del2->execute();
  $del1 = $db->prepare("DELETE FROM application WHERE id=?");
  $del1->bindParam(1, $_GET['id']);
  $del1->execute();
}
catch(PDOException $e){
  print('Error: ' . $e->getMessage());
  exit();
}
header("Location: admin.php");
?>