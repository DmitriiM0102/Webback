<style>
    div.form{
    max-width:960px;
    text-align: center;
    margin:0 auto;
    background-color: #bbbb;}
</style>
<body>
    <?php
    if (!empty($messages)){
        print('<div id="messages">');
        foreach($messages as $msgs){
            print($msgs);
        }
        print('</div>');
    }
    ?>
    <div class="formm">
        <form action="index.php" method="POST">

        <label>Введите своё имя:</label><br>
        <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" ><br>

        <label>Введите свой адрес электронной почты (Email):</label><br>
        <input name="email" type="email" <?php if ($errors['email']) {print 'class="error"';} ?> value="<?php print $values['email']; ?>" ><br>

        <label>Дата рождения:</label><br>
        <select name="year">
        <option value="god">Выбрать год</option>
        <?php
        for($i=1890;$i<=2022;$i++){
          if($values['year']==$i){
            printf("<option value=%d selected>%d год</option>",$i,$i);
          }
          else{
            printf("<option value=%d>%d год</option>",$i,$i);
          }
        }
        ?></select>
        <br>

        <label>Ваш пол:</label><br>
        <div <?php if ($errors['g']) {print 'class="error"';} ?>>
        <input type="radio" name="g" value="M" <?php if($values['g']=="M") {print 'checked';} ?>>Мужчина
        <input type="radio" name="g" value="W" <?php if($values['g']=="W") {print 'checked';} ?>>Женщина<br>

        <label>Количество конечностей:</label><br>
        <input type="radio" name="limb" value="0" <?php if($values['limb']=="0") {print 'checked';} ?>>0
        <input type="radio" name="limb" value="1" <?php if($values['limb']=="1") {print 'checked';} ?>>1
        <input type="radio" name="limb" value="2" <?php if($values['limb']=="2") {print 'checked';} ?>>2
        <input type="radio" name="limb" value="3" <?php if($values['limb']=="3") {print 'checked';} ?>>3
        <input type="radio" name="limb" value="4" <?php if($values['limb']=="4") {print 'checked';} ?>>4<br>

        <label>Список сверхспособностей:</label><br>
        <select name="sp[]" multiple <?php if ($errors['sp']) {print 'class="error"';} ?>>
            <option value="Бессмертие" <?php if($values['immortal']==1){print 'selected';} ?>>Бессмертие</option>
            <option value="Прохождение сквозь стены" <?php if($values['ghost']==1){print 'selected';} ?>>Прохождение сквозь стены</option>
            <option value="Левитация" <?php if($values['levitation']==1){print 'selected';} ?>>Левитация</option>
        </select>
        <br>

        <label>Биография (о себе):<label><br>
        <textarea name="bio"><?php print $values['bio']; ?></textarea>
        <br>

        <?php 
        $cl_e='';
        $ch='';
        if($values['contract'] or !empty($_SESSION['login'])){
        $ch='checked';
        }
        if ($errors['contract']) {
        $cl_e='class="error"';
        }
        if(empty($_SESSION['login'])){
        print('<div  '.$cl_e.' >
        <input name="check" type="checkbox" '.$ch.'> Вы ознакомились с контрактом? <br>
        </div>');}
        ?>

        <input type="submit" value="Отправить"/>
        </form>

        <?php
            if(empty($_SESSION['login'])){
            echo '
            <div class="login">
                <p>Если у вас есть аккаунт, вы можете <a href="login.php">войти</a></p>
            </div>';
            }
            else{
            echo '
            <div class="logout">
            <a href="logout.php" name="logout">Выйти</a>
            </div>';
            }
        ?>
    </div>
</body>