<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<style>
    div.form{
    max-width:960px;
    margin:0 auto;
    background-color: #bbbb;}
</style>
<body>
    <div class="form">
        <form action="index.php" method="POST">

        <label>Введите своё имя:<br>
        <input name="name">
        </label><br>

        <label>Введите свой адрес электронной почты (Email):<br>
        <input name="email" type="email">
        </label><br>

        <label>Дата рождения:<br>
        <select name="year">
        <option value="god"> Выбрать год </option>
        <?php 
        for($i=1800;$i<=2022;$i++){
            printf("<option value=%d>%d</option>",$i,$i);
        } ?> </select>
        </label><br>

        Ваш пол:<br>
        <label><input type="radio" name="g" value="m">Мужчина</label>
        <label><input type="radio" name="g" value="w">Женщина</label><br>

        Количество конечностей:<br>
        <label><input type="radio" name="limb">0</label>
        <label><input type="radio" name="limb">1</label>
        <label><input type="radio" name="limb">2</label>
        <label><input type="radio" name="limb">3</label>
        <label><input type="radio" name="limb">4</label><br>

        <label>Список сверхспособностей:<br>
        <select name="sp[]" multiple="multiple">
            <option value="immortal">Бессмертие</option>
            <option value="ghost">Прохождение сквозь стены</option>
            <option value="levitation">Левитация</option>
        </select>
        </label><br>

        <label>Биография (о себе):<br>
        <textarea name="bio"></textarea>
        </label><br>

        С контрактом ознакомлены?<br>
        <label>
            <div><input type="checkbox" name="check">С контрактом ознакомлен</div>
        </label><br>

        <input type="submit" value="Отправить">

        </form>
    </div>
</body>
</html>