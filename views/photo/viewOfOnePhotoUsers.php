<?php //print_r($result); ?>


        <div class="photoInfo">
            <div class="editPhotoInfo"  >

            </div>
            <div class="photoTitle clearfix">
                <h4><?= $result['photo'][0]['title'] ?></h4>
                <i class="fa fa-times" id="closePopup" aria-hidden="true"></i>
            </div>
            <div class="photoDescription"><?= $result['photo'][0]['description'] ?></div>
            <div class="photoPicture">
                <?php $photo = $result['photo'][0]['photo'] ? $result['photo'][0]['photo'] : "undefined.jpg" ?>
                <img src="<?=  "/template/images/photo/". $photo ?>">
                <i class="fa fa-arrow-left" aria-hidden="true" photo-id="<?= $result['photo'][0]['photoId'] ?>" user-id="<?= $result['userId'] ?>"></i>
                <i class="fa fa-arrow-right" aria-hidden="true" photo-id="<?= $result['photo'][0]['photoId'] ?>" user-id="<?= $result['userId'] ?>"></i>
            </div>
            <div class="photoDateLike">
                <div class = "dateContainer">
                    <span class="photoDate"><?= "Last updated: " . date("F j, Y, g:i a",$result['photo'][0]['dateOfCreation'])?></span>
                    <span>|</span>
                </div>
                <div class = "likeContainer">
                    <span class="photoLike" photo-id="<?= $result['photo'][0]['photoId'] ?>">I like this photo! <i class="fa fa-thumbs-o-up" aria-hidden="true"></i></span>
                    <span class="photoCountLike photoLike"><?= $result['like'][0]['COUNT(`likes`.`photoId`)']?></span>

                </div>
                <div class="likeAuthor"></div>


            </div>
            <div class="writeFeedback col-xs-12 no-padding">
                <div class="feedbackTitle"><span>Write your comment</span></div>
                <div class="col-sm-9 feedbackInput no-padding" >
                    <input type="text" class="form-control inputStyle" id="feedback" name="feedback" value=""
                           placeholder="Write your comment here">
                </div>
                <div class="col-xs-3 feedbackButton no-padding">
                    <div class="btnStyle" id="addFeedback" photo-id ="<?= $result['photo'][0]['photoId'] ?>">Add</div>
                </div>
                <div class="error clearfix"></div>
            </div>
            <div class="photoFeedbacks">
                <?php if($result['feedback']): ?>
               <?php foreach($result['feedback'] as $feedback): ?>
                        <div class="feedback clearfix">
                            <?php if($result['userId'] == $feedback['userId']): ?>
                            <i class="fa fa-times hiddenElement" id="deleteFeedback" aria-hidden="true" photo-id ="<?= $result['photo'][0]['photoId'] ?>"
                               feedback-id="<?= $feedback['feedbackId'] ?>"></i>
                            <?php  endif; ?>
                            <div class="feedbackAuthorPhoto  col-xs-1 no-padding">
                                <?php $photo = $feedback['photo'] ? $feedback['photo'] : "undefined.jpg" ?>
                                <img src="<?=  "/template/images/user/". $photo ?>" alt="<?= $feedback['firstName'] ?>">
                            </div>
                            <div class="feedbackAuthorInfo col-xs-10">
                                <span class="authorName"><?= $feedback['firstName'] . " " . $feedback['lastName']?></span>
                                <span class="feedbackText"><?= $feedback['title'] ?></span>
                                <span class="feedbackDate"><?= "Created: " . date("F j, Y, g:i a",$feedback['date'])?></span>
                            </div>
                        </div>
                <?php endforeach;?>
                <?php  endif; ?>


                <span class="hideFeedbacks hiddenElement" data-id = "<?= $result['photoId']?>"> Hide</span>
                <span class="allFeedbacks" data-id = "<?= $result['photo'][0]['photoId']?>"> Show all</span>
                <span class="moreFeedbacks" data-id = "<?= $result['photo'][0]['photoId']?>"> Show more</span>
            </div>



        </div>



