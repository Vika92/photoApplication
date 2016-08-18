<?php
/**
 * Render data about logged user in left sidebar, header part
 * Created by PhpStorm.
 * User: Администратор
 * Date: 05.08.2016
 * Time: 22:28
 */
//print_r($result);
?>

<div class="imgContainer">
    <img src="/template/images/user/<?= $result['userData']['photo'] ?>" alt="<?= $result['userData']['firstName'] ?>">
</div>

<span class="userName"><?= $result['userData']['firstName'] . " " . $result['userData']['lastName']  ?></span><br>
<h6 class="userStatus"><?= $result['userData']['status'] ?></h6>
