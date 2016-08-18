<?php

class indexController
{
    public function actionIndex() {
        //to get Id of logged user
        $user = new user;
        $userId = $user -> checkLogged();
        //to get all data of logged user
        $userData = false;
        if($userId){
            $userData = $user->getUserById($userId);
        }
        //to get data about all logged users
        $allUsersData = $user->getUsersList(0,20);


        $index= new index;

        $index->render('index','index', array(
         'userData' => $userData,
         'userId' => $userId,
         'allUsersData' => $allUsersData,


        ));

    }

    //upload temporary file to a directory, before info is updated
    public function actionUploadFile(){
        $directory = $_POST['directory'];
        $photo = $_FILES['photo']['name'];

        $user = new user;
        if(isset($photo) && $photo !== "" ){

            $uploads_dir =  ROOT . '/template/images/' . $directory. '/tmp/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            $index = new index;
            $background = $index -> prepareBackground($background);
            move_uploaded_file($tmp_name,$uploads_dir . $background);
        }
        switch ($directory) {
            case 'user':
                $user->updateTmpFile($background, $_POST['id']);
                break;
            case 'album':
                $album = new album;
                if($_POST['id']){
                    //delete uploaded earlier file from tmp directory
                    $tmpFile = $album->getTmpFile($_POST['id']);
                    unlink(ROOT . "/template/images/album/tmp/" . $tmpFile['photoTmp']);
                    //set uploaded file name to Album table
                    $album->updateTmpFile($background, $_POST['id']);
                }else{
                    $user = new user;
                    //delete uploaded earlier file from tmp directory

                    $tmpFile = $user->getTmpFile($_POST['userId']);
                    unlink(ROOT . "/template/images/album/tmp/" . $tmpFile['photoTmp']);
                    //set uploaded file name to Users table
                    $user->updateTmpFile($background,$_POST['userId']);
                }
                break;

            case 'photo':
                $photo = new photo;
                //delete uploaded earlier file from tmp directory
                $tmpFile = $photo->getTmpFile($_POST['photoId']);
                unlink(ROOT . "/template/images/photo/tmp/" . $tmpFile['photoTmp']);
                //set uploaded file name to photo table
                $photo->updateTmpFile($background, $_POST['photoId']);



        }
        $index = new index;
        //render userCabinet
        $index->render('index', 'uploadedFile', array(
            'uploadedFileName' => $background,
        ));
        return true;
    }

    public function actionViewUserInfo()
    {

        $user = new user;
        //get user's id
        $userId = $_POST['userId'];
        //get user's data from db
        $userData = $user->getUserById($userId);
        //getListof albums by id
        $album = new album;
        $albums = $album->getAlbumList($userId);

        $index = new index;
        //render userCabinet
        $index->render('cabinet', 'viewUsersCabinet', array(
            'userData' => $userData,
            'albums' => $albums,

        ));
    }


}