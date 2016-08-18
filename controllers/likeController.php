<?php
class likeController
{
    /**
     * Insert Like to DB, or remove it, if like from this person to this photo already exists in DB
     * @return bool
     */
    public function actionPush()
    {
        $photoId = $_POST['photoId'];

        //get user's id
        $user = new user;
        $userId = $user->checkLogged();

        $like = new like();
        if(!$like->likeExists($userId,$photoId) && $userId){
            $like->likeAdd($userId,$photoId);

        } else{
            $like->likeRemove($userId, $photoId);

        }
        $likeCount = $like->countLikes($photoId);

        $index = new index;
        $index->render('like','likeCount', array(
            'likeCount' => $likeCount[0],

        ));

        return true;

    }

    /**
     * Get info about users that put like to a photo
     * @return bool
     */

    public function actionShowUser(){
        $photoId = $_POST['photoId'];
        $like = new like();
        $likes = $like->showLikeAuthor($photoId);

        $index = new index;
        $index->render('like','showUser', array(
            'showUser' => $likes,

        ));

        return true;
    }
}

?>