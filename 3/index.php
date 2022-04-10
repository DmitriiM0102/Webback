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
  $stmt = $db->prepare("INSERT INTO application VALUES (:n, :m, :y, :s, :l, :b)");
  $stmt->bindParam(':n', $_POST['name']);
  $stmt->bindParam(':m', $_POST['email']);
  $stmt->bindParam(':y', $_POST['year']);
  $stmt->bindParam(':s', $_POST['g']);
  $stmt->bindParam(':l', $_POST['limb']);
  $stmt->bindParam(':b', $_POST['bio']);
  $stmt -> execute();
  $id= $db->lastInsertId();
  $st= $db->prepare("INSERT INTO powers(name_p,id) VALUES(:n,:ip)");
  $st->bindParam(':ip', $id);
  foreach ($_POST['sp'] as $powa){
    $st->bindParam(':n', $powa);
    $st->execute();
  }
}
catch(PDOException $e){
  print('Error : ' . $e->getMessage());
  exit();
}

header('Location: ?save=1');