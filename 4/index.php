<?php
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
  }
  $errors = array();
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['g'] = !empty($_COOKIE['g_error']);
  $errors['limb'] = !empty($_COOKIE['limb_error']);
  $errors['sp'] = !empty($_COOKIE['sp_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['contract'] = !empty($_COOKIE['contract_error']);

  if ($errors['name']) {
    $messages[] = '<div class="error">Заполните имя!</div>';
  }
  if ($errors['email']) {
    $messages[] = '<div class="error">Заполните почту!</div>';
  }
  if ($errors['year']) {
    $messages[] = '<div class="error">Выберите год рождения!</div>';
  }
  if ($errors['g']) {
    $messages[] = '<div class="error">Выберите пол!</div>';
  }
  if ($errors['limb']) {
    $messages[] = '<div class="error">Выберите количество ваших конечностей!</div>';
  }
  if ($errors['sp']) {
    $messages[] = '<div class="error">Выберите хотя бы одну суперспособность!</div>';
  }
  if ($errors['contract']) {
    $messages[] = '<div class="error">Поставьте галочку, что ознакомлены с контрактом!</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : $_COOKIE['name_value'];
  $values['email'] = empty($_COOKIE['email_value']) ? '' : $_COOKIE['email_value'];
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : $_COOKIE['year_value'];
  $values['g'] = empty($_COOKIE['g_value']) ? '' : $_COOKIE['g_value'];
  $values['limb'] = empty($_COOKIE['limb_value']) ? '' : $_COOKIE['limb_value'];
  $values['immortal'] = empty($_COOKIE['immortal_value']) ? 0 : $_COOKIE['immortal_value'];
  $values['ghost'] = empty($_COOKIE['ghost_value']) ? 0 : $_COOKIE['ghost_value'];
  $values['levitation'] = empty($_COOKIE['levitation_value']) ? 0 : $_COOKIE['levitation_value'];
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : $_COOKIE['bio_value'];
  $values['contract'] = empty($_COOKIE['contract_value']) ? FALSE : $_COOKIE['contract_value'];

  include('form.php');

}
else{
$errors = FALSE;
if (empty($_POST['name'])) {
  setcookie('name_error', '1', time() + 24 * 60 * 60);
  setcookie('name_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('name_value', $_POST['name'], time() + 12*30 * 24 * 60 * 60);
  setcookie('name_error','',100000);
}
if (empty($_POST['email']) or !filter_var($_POST['mail],FILTER_VALIDATE_EMAIL'])) {
  setcookie('email_error', '1', time() + 24 * 60 * 60);
  setcookie('email_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('email_value', $_POST['email'], time() + 12*30 * 24 * 60 * 60);
  setcookie('email_error','',100000);
}
if ($_POST['year']=='Выбрать год') {
  setcookie('year_error', '1', time() + 24 * 60 * 60);
  setcookie('year_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('year_value', intval($_POST['year']), time() + 12*30 * 24 * 60 * 60);
  setcookie('year_error','',100000);
}
if (!isset($_POST['g'])) {
  setcookie('g_error', '1', time() + 24 * 60 * 60);
  setcookie('g_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('g_value', $_POST['g'], time() + 12*30 * 24 * 60 * 60);
  setcookie('g_error','',100000);
}
if (!isset($_POST['limb'])) {
  setcookie('limb_error', '1', time() + 24 * 60 * 60);
  setcookie('limb_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('limb_value', $_POST['limb'], time() + 12*30 * 24 * 60 * 60);
  setcookie('limb_error','',100000);
}
if (!isset($_POST['sp'])) {
  setcookie('sp_error', '1', time() + 24 * 60 * 60);
  setcookie('immortal_value', '', 100000);
  setcookie('ghost_value', '', 100000);
  setcookie('levitation_value', '', 100000);
  $errors = TRUE;
}
else{
  $suppow=$_POST['sp'];
  $a=array(
    "immortal_value"=>0,
    "ghost_value"=>0,
    "levitation_value"=>0
  );
  foreach($suppow as $supp){
    if($supp=='Бессмертие'){setcookie('immortal_value', 1, time() + 12*30 * 24 * 60 * 60); $a['immortal_value']=1;} 
    if($supp=='Прохождение сквозь стены'){setcookie('ghost_value', 1, time() + 12*30 * 24 * 60 * 60);$a['ghost_value']=1;} 
    if($supp=='Левитация'){setcookie('levitation_value', 1, time() + 12*30 * 24 * 60 * 60);$a['levitation_value']=1;} 
  }
  foreach($a as $b=>$val){
    if($val==0){
      setcookie($b,'',100000);
    }
  }
}

setcookie('bio_value',$_POST['bio'],time()+12*30*24*60*60);

if (!isset($_POST['check'])) {
  setcookie('contract_error', '1', time() + 24 * 60 * 60);
  setcookie('contract_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('contract_value',TRUE, time() + 12*30 * 24 * 60 * 60);
  setcookie('contract_error','',100000);
}

if ($errors) {
  header('Location: index.php');
  exit();
}
else{
  setcookie('name_error', '', 100000);
  setcookie('email_error', '', 100000);
  setcookie('year_error', '', 100000);
  setcookie('g_error', '', 100000);
  setcookie('limb_error', '', 100000);
  setcookie('sp_error', '', 100000);
  setcookie('bio_error', '', 100000);
  setcookie('contract_error', '', 100000);
}
$user = 'u47536';
$pass = '4040214';
$db = new PDO('mysql:host=localhost;dbname=u47536', $user, $pass, array(PDO::ATTR_PERSISTENT => true));
try {
  $stmt = $db->prepare("INSERT INTO application SET name=:name, email=:email, year=:year, sex=:g, limb=:limb, bio=:bio");
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
setcookie('save','1');

header('Location: index.php');
}?>