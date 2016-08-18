<?php //print_r($result['allUsersData']);die(); ?>
<?php if($result['allUsersData']): ?>
    <?php foreach($result['allUsersData'] as $user): ?>
        <div class = "col-xs-12 userInfo" user-id="<?= $user['userId'] ?>">
            <div class = "imgContainer col-xs-3">
                <img src="/template/images/user/<?= $user['photo'] ?>"  width="40" alt="<?= $user['firstName'] . " " . $user['lastName'] ?>">
            </div>
            <div class="aboutUser col-xs-9">
                <span class="allUsersName"><?= $user['firstName'] . " " . $user['lastName'] . ", " . $user['sex'] . ", " . $user['age'] ?></span><br>
                <h6 class="allUsersStatus"><?= $user['status'] ?></h6>
            </div>

        </div>
    <?php endforeach; ?>
<?php endif; ?>