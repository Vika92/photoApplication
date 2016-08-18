<?php

/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 28.07.2016
 * Time: 16:11
 */
class feedbackController
{
    /**
     * Add feedback to db and render answer
     * @return bool
     */
    public function actionAdd(){

        $photoId = $_POST['photoId'];
        $feedback = new feedback();
        //get user's id
        $user = new user;
        $userId = $user->checkLogged();

        $date = time();
        $answer = "Your comment can't be added, because you are not logged in";
        if($userId){
            if (!empty($_POST)) {
                $index = new index;
                $title = $index->checkString($_POST['feedback']);
                $feedback -> feedbackAdd($photoId,$userId, $title, $date);
                $answer = "Your comment is successfully added!";
            }
        }

        $index = new index;
        $index->render('feedback','add', array(
            'answer' => $answer,

        ));

        return true;
    }

    /**
     * Get info about feedbacks and users, that wrote it
     * @return bool
     */
    public function actionAllFeedback(){
        if($_POST['limit']){
            $limit = $_POST['limit'];
        }
        if($_POST['start']){
            $start = $_POST['start'];
        }


        $photoId = $_POST['photoId'];
        //get user's id
        $user = new user;
        $userId = $user->checkLogged();

        $feedback = new feedback($photoId);
        $result =  $feedback->getFeedbacks($photoId, $_POST['start'], $limit);


        $index= new index;
        $index->render('feedback','feedback', array(
            'feedback' => $result,
            'photoId' => $photoId,
            'userId'  => $userId,
        ));
        return true;

    }

    /**
     * Deelte feedback from DB
     * @return bool
     */

    public function actionDeleteFeedback(){

        $feedbackId = $_POST['feedbackId'];
        $feedback = new feedback();
        $feedback->deleteFeedback($feedbackId);
        return true;

    }
}