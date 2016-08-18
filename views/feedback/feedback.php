<?php //print_r($result) ?>

<?php if($result['feedback']): ?>
    <?php foreach($result['feedback'] as $feedback): ?>
        <div class="feedback clearfix">
            <?php if($result['userId'] == $feedback['userId']):?>
                <i class="fa fa-times hiddenElement" id="deleteFeedback" aria-hidden="true"
                   photo-id ="<?= $result['photoId']?>" feedback-id="<?= $feedback['feedbackId'] ?>"></i>
            <?php endif; ?>
            <div class="feedbackAuthorPhoto col-xs-1 no-padding">
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
<span class="allFeedbacks" data-id = "<?= $result['photoId']?>"> Show all</span>
<span class="moreFeedbacks" data-id = "<?= $result['photoId']?>"> Show more</span>


