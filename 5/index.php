<?php
session_start();
header('Content-Type: text/html; charset=UTF-8');

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
  $messages = array();
  if (!empty($_COOKIE['save'])) {
    setcookie('save', '', 100000);
    setcookie('login', '', 100000);
    setcookie('pass', '', 100000);
    $messages[] = 'Спасибо, результаты сохранены.';
    if(!empty($_COOKIE['pass'])){
      $messages[] = sprintf('Вы можете <a href="login.php">войти</a> с логином <strong>%s</strong>
      и паролем <strong>%s</strong> для изменения данных.',
      strip_tags($_COOKIE['login']),
      strip_tags($_COOKIE['pass']));
    }
    setcookie('name_value', '', 100000);
    setcookie('email_value', '', 100000);
    setcookie('year_value', '', 100000);
    setcookie('g_value', '', 100000);
    setcookie('limb_value', '', 100000);
    setcookie('bio_value', '', 100000);
    setcookie('immortal_value', '', 100000);
    setcookie('ghost_value', '', 100000);
    setcookie('levitation_value', '', 100000);
    setcookie('contract_value', '', 100000);
  }
  $errors = array();
  $error=FALSE;
  $errors['name'] = !empty($_COOKIE['name_error']);
  $errors['email'] = !empty($_COOKIE['email_error']);
  $errors['year'] = !empty($_COOKIE['year_error']);
  $errors['g'] = !empty($_COOKIE['g_error']);
  $errors['limb'] = !empty($_COOKIE['limb_error']);
  $errors['sp'] = !empty($_COOKIE['sp_error']);
  $errors['bio'] = !empty($_COOKIE['bio_error']);
  $errors['contract'] = !empty($_COOKIE['contract_error']);

  if ($errors['name']) {
    setcookie('name_error','',100000);
    $messages[] = '<div class="error">Заполните имя!</div>';
  }
  if ($errors['email']) {
    setcookie('email_error','',100000);
    $messages[] = '<div class="error">Заполните почту!</div>';
  }
  if ($errors['year']) {
    setcookie('year_error','',100000);
    $messages[] = '<div class="error">Выберите год рождения!</div>';
  }
  if ($errors['g']) {
    setcookie('g_error','',100000);
    $messages[] = '<div class="error">Выберите пол!</div>';
  }
  if ($errors['limb']) {
    setcookie('limb_error','',100000);
    $messages[] = '<div class="error">Выберите количество ваших конечностей!</div>';
  }
  if ($errors['sp']) {
    setcookie('sp_error','',100000);
    $messages[] = '<div class="error">Выберите хотя бы одну суперспособность!</div>';
  }
  if ($errors['contract']) {
    setcookie('contract_error','',100000);
    $messages[] = '<div class="error">Поставьте галочку, что ознакомлены с контрактом!</div>';
  }

  $values = array();
  $values['name'] = empty($_COOKIE['name_value']) ? '' : strip_tags($_COOKIE['name_value']);
  $values['email'] = empty($_COOKIE['email_value']) ? '' : strip_tags($_COOKIE['email_value']);
  $values['year'] = empty($_COOKIE['year_value']) ? 0 : strip_tags($_COOKIE['year_value']);
  $values['g'] = empty($_COOKIE['g_value']) ? '' : strip_tags($_COOKIE['g_value']);
  $values['limb'] = empty($_COOKIE['limb_value']) ? '' : strip_tags($_COOKIE['limb_value']);
  $values['immortal'] = empty($_COOKIE['immortal_value']) ? 0 : strip_tags($_COOKIE['immortal_value']);
  $values['ghost'] = empty($_COOKIE['ghost_value']) ? 0 : strip_tags($_COOKIE['ghost_value']);
  $values['levitation'] = empty($_COOKIE['levitation_value']) ? 0 : strip_tags($_COOKIE['levitation_value']);
  $values['bio'] = empty($_COOKIE['bio_value']) ? '' : strip_tags($_COOKIE['bio_value']);
  $values['contract'] = empty($_COOKIE['contract_value']) ? FALSE : strip_tags($_COOKIE['contract_value']);

  if (!$error && !empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
    include('connect.php');
    try{
      $get1=$db->prepare("select * from application where id=?");
      $get1->bindParam(1,$_SESSION['uid']);
      $get1->execute();
      $inf=$get1->fetchALL();
      $values['name']=$inf[0]['name'];
      $values['email']=$inf[0]['email'];
      $values['year']=$inf[0]['year'];
      $values['sex']=$inf[0]['sex'];
      $values['limb']=$inf[0]['limb'];
      $values['bio']=$inf[0]['bio'];

      $get2=$db->prepare("select name_p from powers where id=?");
      $get2->bindParam(1,$_SESSION['uid']);
      $get2->execute();
      $inf2=$get2->fetchALL();
      for($i=0;$i<count($inf2);$i++){
        if($inf2[$i]['name_p']=='Бессмертие'){
          $values['immortal']=1;
        }
        if($inf2[$i]['name_p']=='Прохождение сквозь стены'){
          $values['ghost']=1;
        }
        if($inf2[$i]['name_p']=='Левитация'){
          $values['levitation']=1;
        }
      }
    }
    catch(PDOException $e){
      print('Error: '.$e->getMessage());
      exit();
    }
    printf('Вход с логином %s, uid %d', $_SESSION['login'], $_SESSION['uid']);
  }
  include('form.php');

}
else{
$name=$_POST['name'];
$email=$_POST['email'];
$year=$_POST['year'];
$sex=$_POST['g'];
$limb=$_POST['limb'];
$pwrs=$_POST['sp'];
$bio=$_POST['bio'];
if(empty($_SESSION['login'])){
  $cont=$_POST['check'];
}
$errors = FALSE;
if (empty($_POST['name'])) {
  setcookie('name_error', '1', time() + 24 * 60 * 60);
  setcookie('name_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('name_value', $_POST['name'], time() + 30 * 24 * 60 * 60);
  setcookie('name_error','',100000);
}
if (empty($_POST['email']) or !filter_var($_POST['email'],FILTER_VALIDATE_EMAIL)) {
  setcookie('email_error', '1', time() + 24 * 60 * 60);
  setcookie('email_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('email_value', $_POST['email'], time() + 30 * 24 * 60 * 60);
  setcookie('email_error','',100000);
}
if ($_POST['year']=='Выбрать год') {
  setcookie('year_error', '1', time() + 24 * 60 * 60);
  setcookie('year_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('year_value', intval($_POST['year']), time() + 30 * 24 * 60 * 60);
  setcookie('year_error','',100000);
}
if (!isset($_POST['g'])) {
  setcookie('g_error', '1', time() + 24 * 60 * 60);
  setcookie('g_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('g_value', $_POST['g'], time() + 30 * 24 * 60 * 60);
  setcookie('g_error','',100000);
}
if (!isset($_POST['limb'])) {
  setcookie('limb_error', '1', time() + 24 * 60 * 60);
  setcookie('limb_value', '', 100000);
  $errors = TRUE;
}
else{
  setcookie('limb_value', $_POST['limb'], time() + 30 * 24 * 60 * 60);
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
    if($supp=='Бессмертие'){setcookie('immortal_value', 1, time() + 30 * 24 * 60 * 60); $a['immortal_value']=1;} 
    if($supp=='Прохождение сквозь стены'){setcookie('ghost_value', 1, time() + 30 * 24 * 60 * 60);$a['ghost_value']=1;} 
    if($supp=='Левитация'){setcookie('levitation_value', 1, time() + 30 * 24 * 60 * 60);$a['levitation_value']=1;} 
  }
  foreach($a as $b=>$val){
    if($val==0){
      setcookie($b,'',100000);
    }
  }
}

setcookie('bio_value',$_POST['bio'],time()+30*24*60*60);
if(empty($_SESSION['login'])){
  if (!isset($_POST['check'])) {
    setcookie('contract_error', '1', time() + 24 * 60 * 60);
    setcookie('contract_value', '', 100000);
    $errors = TRUE;
  }
  else{
    setcookie('contract_value',TRUE, time() + 30 * 24 * 60 * 60);
    setcookie('contract_error','',100000);
  }
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
if (!empty($_COOKIE[session_name()]) && !empty($_SESSION['login'])) {
  include('connect.php');
  $stmt = $db->prepare("UPDATE application SET name=:name, email=:email, year=:year, sex=:sex, limb=:limb, bio=:bio WHERE id=:id");
  $cols=array(
    ':name'=>$name,
    ':email'=>$email,
    ':year'=>$year,
    ':sex'=>$sex,
    ':limb'=>$limb,
    ':bio'=>$bio
  );
  foreach($cols as $t=>&$b){
    $stmt->bindParam($t,$b);
  }
  $stmt->bindParam(':id',$id);
  $stmt -> execute();
   
  $del= $db->prepare("DELETE FROM powers WHERE id=?");
  $del->execute(array($id));

  $st= $db->prepare("INSERT INTO powers SET name_p=:name_p, id=:id");
  $st->bindParam(':id',$id);
  foreach ($_POST['sp'] as $powa){
    $st->bindParam(':name_p', $powa);
    $st->execute();
  }
}
else{
  if(!$errors){
  include('connect.php');
  $login = 'u'.substr(uniqid(),0,-5);
  $pass = substr(md5(rand(0,2000)),0,7);
  $pass_hash=password_hash($pass,PASSWORD_DEFAULT);
  setcookie('login', $login);
  setcookie('pass', $pass);
  try{
    $stmt = $db->prepare("INSERT INTO application SET name=:name,email=:email,year=:year,sex=:sex,limb=:limb,bio=:bio");
    $stmt->bindParam(':name',$_POST['name']);
    $stmt->bindParam(':email',$_POST['email']);
    $stmt->bindParam(':year',$_POST['year']);
    $stmt->bindParam(':sex',$_POST['g']);
    $stmt->bindParam(':limb',$_POST['limb']);
    $stmt->bindParam(':bio',$_POST['bio']);
    $stmt -> execute();
    $id=$db->lastInsertId();
    $usr=$db->prepare("insert into username set uid=?,login=?,pass=?");
    $usr->bindParam(1,$id);
    $usr->bindParam(2,$login);
    $usr->bindParam(3,$pass_hash);
    $usr->execute();
    $pwr=$db->prepare("INSERT INTO powers SET name_p=:name_p,id=:id");
    $pwr->bindParam(':id',$id);
    foreach($_POST['sp'] as $power){
      $pwr->bindParam(':name_p',$power); 
      $pwr->execute();  
    }
  }
  catch(PDOException $e){
    print('Error : ' . $e->getMessage());
    exit();
  }
}
}
if(!$errors){
  setcookie('save','1');
}

header('Location: index.php');
}?>