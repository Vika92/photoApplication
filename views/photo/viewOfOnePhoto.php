<?php //print_r($result); ?>


        <div class="photoInfo">
            <div class="editPhotoInfo"  >
                <span id="deletePhotoBtn" data-toggle="modal" data-target="#myModalPhotoDelete"
                      data-id="<?= $result['photo'][0]['photoId'] ?>"
                      data-pic-name = "<?= $result['photo'][0]['title'] ?>"
                      album-id="<?= $result['photo'][0]['albumId'] ?>">Delete Photo</span>
                <span id="editPhotoBtn" data-toggle="modal" data-target="#myModalPhotoEdit"
                      data-id="<?= $result['photo'][0]['photoId'] ?>">Edit Photo Info</span>
            </div>
            <div class="photoTitle clearfix">
                <h4><?= $result['photo'][0]['title'] ?></h4>
                <i class="fa fa-times" id="closePopup" aria-hidden="true"></i>
            </div>
            <div class="photoDescription"><?= $result['photo'][0]['description'] ?></div>
            <div class="photoPicture">
                <?php $photo = $result['photo'][0]['photo'] ? $result['photo'][0]['photo'] : "undefined.jpg" ?>
                <img src="<?=  "/template/images/photo/". $photo ?>">
                <i class="fa fa-arrow-left" aria-hidden="true" photo-id="<?= $result['photo'][0]['photoId'] ?>"></i>
                <i class="fa fa-arrow-right" aria-hidden="true" photo-id="<?= $result['photo'][0]['photoId'] ?>"></i>
            </div>
            <div class="photoDateLike">
                <div class = "dateContainer">
                    <span class="photoDate"><?= "Last updated: " . date("F j, Y, g:i a",$result['photo'][0]['dateOfCreation'])?></span>

                </div>




        </div>



