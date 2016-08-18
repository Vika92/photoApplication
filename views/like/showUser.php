
<?php  foreach($result['showUser'] as $elem):  ?>
    <div class= "showLikeAuthor" style="">
        <img src="<?= "/template/images/user/". $elem['photo'] ?>" width="50" alt="">
    </div>


 <?php endforeach; ?>