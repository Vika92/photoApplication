<?php
//include_once ROOT. '/models/photo.php';
class photoController
{
    /**
     * Get info about photos in album for logged user
     * @return bool
     */
    public function actionIndex()
    {

        $albumId = $_POST['id'];


        $user = new user;
        //get user's id
        $userId = $user->checkLogged();

        $photo =  new photo();
        $result = $photo->getPhotoList($albumId);

        $album = new album();
        $albumData = $album->getAlbumById($albumId);


        $index = new index;
        $index->render('photo', 'index', array(
            'result'  => $result,
            'albumId'  => $albumId,
            'albumData' => $albumData,

        ));
        return true;
    }

    /**
     * Get info about photos in album of not logged in users
     * @return bool
     */

    public function actionIndexUsers()
    {

        $albumId = $_POST['id'];

        //check weather user is logged in
        $user = new user;
        //get user's id
        $userId = $user->checkLogged();

        $photo =  new photo();
        $result = $photo->getPhotoList($albumId);

        $album = new album();
        $albumData = $album->getAlbumById($albumId);


        $index = new index;
        $index->render('photo', 'indexUsers', array(
            'result'  => $result,
            'albumId'  => $albumId,
            'albumData' => $albumData,

        ));
        return true;
    }

    /**
     * Update data about photo
     * @return bool
     */

    public function actionEdit(){


        $photoId = $_POST['photoId'];

        //get user's id
        $user = new user;
        $userId = $user->checkLogged();

        $photo = new photo();
        $result = $photo->getPhotoById($photoId);

        $background = $result[0]['photo'];

        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !== "" ){
            $uploads_dir =   ROOT . '/template/images/photo/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            //check whether photo with this name exists in DB and change the name
            $index = new index;
            $background = $index-> prepareBackground($background);
            move_uploaded_file($tmp_name,$uploads_dir . $background );
        }

        if (!empty($_POST)) {

            $title =$_POST['title'];
            $description =$_POST['description'];
            $date = time();
            $index = new index;
            $title = $index->checkString($title);
            $description = $index->checkString($description);

            $photo->editPhoto($title, $description, $date, $background, $photoId);
        }

        return true;
    }

    /**
     * Deelte photo from DB
     * @return bool
     */
    public function actionDelete()
    {
        $photoId = $_POST['photoId'];
        $photo = new photo();
        $result = $photo->getPhotoById($photoId);

        $photo->deletePhoto($photoId);
        unlink(ROOT ."/template/images/photo/".$result[0]['photo']);
        return true;

    }

    /**
     * Add new photo to DB
     * @return bool
     */
    public function actionAdd()
    {

        //check weather user is logged in
        $user = new user;
        //get user's id
        $userId = $user->checkLogged();

        $photo =  new photo();
        //upload user photo to server
        $background = "";
        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !== "" ){

            $uploads_dir =  ROOT . '/template/images/photo/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            $index = new index;
            $background = $index -> prepareBackground($background);
            move_uploaded_file($tmp_name,$uploads_dir . $background);
        }
        //get data for run sql query
        if (!empty($_POST)) {
            $title =$_POST['title'];
            $description =$_POST['description'];
            $date = time();
            $index = new index;
            $title = $index->checkString($title);
            $description = $index->checkString($description);


            $photo->addPhoto($title, $description, $date, $background, $_POST['albumId']);
        }

        $index= new index;
        $index->render('photo','add', array(
            'photo' => $title,
        ));

        return true;
    }

    /**
     * Get data about photo in DB with a possibility to edit data in Private Cabinet
     * @return bool
     */
    public function actionView(){
        $photoId = $_POST['photoId'];
        $photo =  new photo();
        $feedback =  new feedback();
        $like=  new like();

        $result = $photo->getPhotoById($photoId);

        $feedbacks = $feedback->getFeedbacks($photoId, 0, 3);

        $likes = $like->getLikes($photoId);


        $index= new index;
        $index->render('photo','viewOfOnePhoto', array(
            'photo' => $result,
            'like' => $likes,
            'feedback' => $feedbacks,
        ));
        return true;
    }

    /**
     * Get data about photo in DB without a possibility to edit data
     * @return bool
     */
    public function actionViewUsers(){
        $photoId = $_POST['photoId'];
        $photo =  new photo();
        $feedback =  new feedback();
        $like=  new like();

        $result = $photo->getPhotoById($photoId);

        $feedbacks = $feedback->getFeedbacks($photoId, 0, 3);

        $likes = $like->getLikes($photoId);
        $user = new user;
        $userId = $user -> checkLogged();

        $index= new index;
        $index->render('photo','viewOfOnePhotoUsers', array(
            'photo' => $result,
            'like' => $likes,
            'feedback' => $feedbacks,
            'userId' => $userId,
        ));
        return true;
    }

    /**
     * Get data about one photo and render it
     * @return bool
     */
    public function actionGetPhotoInfo(){
        $photoId = $_POST['photoId'];
        $photo =  new photo();
        $result = $photo->getPhotoById($photoId);


        $index= new index;
        $index->render('photo','showOnePhotoData', array(
            'photo' => $result,
        ));
        return true;
    }

}

?>