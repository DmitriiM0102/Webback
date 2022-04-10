<style>
    div.form{
    max-width:960px;
    text-align: center;
    margin:0 auto;
    background-color: #bbbb;}
</style>
<body>
    <div class="form">
        <form action="index.php" method="POST">

        <label>Введите своё имя:</label><br>
        <input name="name"><br>

        <label>Введите свой адрес электронной почты (Email):</label><br>
        <input name="email" type="email"><br>

        <label>Дата рождения:</label><br>
        <select name="year">
        <option value="god"> Выбрать год </option>
        <?php 
        for($i=1800;$i<=2022;$i++){
            printf("<option value=%d>%d</option>",$i,$i);
        } ?> </select>
        <br>

        <label>Ваш пол:</label><br>
        <input type="radio" name="g" value="M">Мужчина
        <input type="radio" name="g" value="W">Женщина<br>

        <label>Количество конечностей:</label><br>
        <input type="radio" name="limb" value="0">0
        <input type="radio" name="limb" value="1">1
        <input type="radio" name="limb" value="2">2
        <input type="radio" name="limb" value="3">3
        <input type="radio" name="limb" value="4">4<br>

        <label>Список сверхспособностей:</label><br>
        <select name="sp[]" multiple>
            <option value="immortal">Бессмертие</option>
            <option value="ghost">Прохождение сквозь стены</option>
            <option value="levitation">Левитация</option>
        </select>
        <br>

        <label>Биография (о себе):<label><br>
        <textarea name="bio"></textarea>
        <br>

        <label>С контрактом ознакомлены?</label><br>
        <div><input type="checkbox" name="check">С контрактом ознакомлен</div>
        <br>

        <input type="submit" value="Отправить">

        </form>
    </div>
</body>