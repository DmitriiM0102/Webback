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
    <div class="form">
        <form action="index.php" method="POST">

        <label>Введите своё имя:</label><br>
        <input name="name" <?php if ($errors['name']) {print 'class="error"';} ?> value="<?php print $values['name']; ?>" ><br>

        <label>Введите свой адрес электронной почты (Email):</label><br>
        <input name="email" type="email" <?php if ($errors['mail']) {print 'class="error"';} ?> value="<?php print $values['mail']; ?>" ><br>

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
            <option value="Бессмертие" <?php if($values['']==1){print 'selected';} ?>>Бессмертие</option>
            <option value="Прохождение сквозь стены" <?php if($values['']==1){print 'selected';} ?>>Прохождение сквозь стены</option>
            <option value="Левитация" <?php if($values['']==1){print 'selected';} ?>>Левитация</option>
        </select>
        <br>

        <label>Биография (о себе):<label><br>
        <textarea name="bio"><?php print $values['bio']; ?></textarea>
        <br>

        <label>С контрактом ознакомлены?</label><br>
        <div <?php if ($errors['privacy']) {print 'class="error"';} ?>>
            <input type="checkbox" name="check" <?php if($values['privacy']==TRUE){print 'checked';} ?>>С контрактом ознакомлен
        </div>
        <br>

        <input type="submit" value="Отправить">

        </form>
    </div>
</body>