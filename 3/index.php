<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

  if (!empty($_GET['save'])) {

    print('Спасибо, результаты сохранены.');
  }

  include('form.php');

  exit();
}

$errors = FALSE;
if (empty($_POST['name'])) {
  print('Заполните имя.<br/>');
  $errors = TRUE;
}
if (empty($_POST['email'])) {
  print('Заполните почту.<br/>');
  $errors = TRUE;
}
if (empty($_POST['year'])) {
  print('Выберите год.<br/>');
  $errors = TRUE;
}
if (!isset($_POST['g'])) {
  print('Выберите пол.<br/>');
  $errors = TRUE;
}
if (empty($_POST['limb'])) {
  print('Выберите кол-во конечностей.<br/>');
  $errors = TRUE;
}
if (empty($_POST['sp'])) {
  print('Выберите супер способности.<br/>');
  $errors = TRUE;
}
if (empty($_POST['check'])) {
  print('Отметьте ознакомление с контрактом.<br/>');
  $errors = TRUE;
}

if ($errors) {

  exit();
}
$user = 'u47536';
$pass = '4040214';
$db = new PDO('mysql:host=localhost;dbname=u47536', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
  $stmt = $db->prepare("INSERT INTO application SET name=:name, email=:email, year=:year, sex=:sex, limb=:limb, bio=:bio");
  $stmt->bindParam(':name', $_POST['name']);
  $stmt->bindParam(':email', $_POST['email']);
  $stmt->bindParam(':year', $_POST['year']);
  $stmt->bindParam(':sex', $_POST['g']);
  $stmt->bindParam(':limb', $_POST['limb']);
  $stmt->bindParam(':bio', $_POST['bio']);
  $stmt -> execute();
  $id= $db->lastInsertId();
  $st= $db->prepare("INSERT INTO powers SET name_p=:name_p,id=:id");
  $st->bindParam(':id', $id);
  foreach ($_POST['sp'] as $powa){
    $st->bindParam(':name_p', $powa);
    $st->execute();
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');
?>