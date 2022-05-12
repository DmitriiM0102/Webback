<style>
    table{
        text-align: center;
        border-collapse: collapse;
    }
    table,th,td{
        border: 1px solid black;
    }
    tr,td{
        padding: 25px;
    }
    th{
        padding-bottom: 6px;
    }
    .upd{
        background-color: rgba(168,255,94,0.63);

    }
    .del{
        background-color: rgba(255,72,63,0.94);
    }
</style>
<?php
/**
 * Задача 6. Реализовать вход администратора с использованием
 * HTTP-авторизации для просмотра и удаления результатов.
 **/

// Пример HTTP-аутентификации.
// PHP хранит логин и пароль в суперглобальном массиве $_SERVER.
// Подробнее см. стр. 26 и 99 в учебном пособии Веб-программирование и веб-сервисы.
if (empty($_SERVER['PHP_AUTH_USER']) ||
    empty($_SERVER['PHP_AUTH_PW']) ||
    $_SERVER['PHP_AUTH_USER'] != 'admin' ||
    md5($_SERVER['PHP_AUTH_PW']) != md5('123')) {
  header('HTTP/1.1 401 Unanthorized');
  header('WWW-Authenticate: Basic realm="My site"');
  print('<h1>401 Требуется авторизация</h1>');
  exit();
}

print('Вы успешно авторизовались и видите защищенные паролем данные.');
?>
<?php
    require 'connect.php';
?>

<body>
    <table>
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Year</th>
            <th>Sex</th>
            <th>Limbs</th>
            <th>Super powers</th>
            <th>Bio</th>
        </tr>
        <?php
            $app = $db->prepare("SELECT * FROM application");
            $app->execute();
            $app=$app->fetchAll();
            for($i=0;$i<count($app);$i++){
                ?>
                <tr>
                    <td><?= $app[$i][1] ?></td>
                    <td><?= $app[$i][2] ?></td>
                    <td><?= $app[$i][3] ?></td>
                    <td><?= $app[$i][4] ?></td>
                    <td><?= $app[$i][5] ?></td>
                        <td><?php
                            $id=$app[$i][0];
                            $pwrs = $db->prepare("SELECT name_p FROM powers WHERE id=?");
                            $pwrs->execute(array($id));
                            $pwrs=$pwrs->fetchAll();
                            for($j=0;$j<count($pwrs);$j++){
                                if($j==count($pwrs)-1){?>
                                    <?= $pwrs[$j][0] ?> <?php }
                            else{?>
                            <?= $pwrs[$j][0] ?>,<?php
                            }
                            }
                        ?></td>
                    <td><?= $app[$i][6] ?></td>
                    <td class="upd"><a href="index.php?id=<?= $id ?>">Изменить</a></td>
                    <td class="del"><a href="delete.php?id=<?= $id ?>">Удалить</td>
                </tr>
                <?php
            }
        ?>
    </table>
</body>
<?php    // *********
// Здесь нужно прочитать отправленные ранее пользователями данные и вывести в таблицу.
// Реализовать просмотр и удаление всех данных.
// *********?>