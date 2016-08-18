<?php
class albumController{

    /**
     * Add album to DB
     * @return bool
     */
    public function actionAdd(){
        $album = new album;

        $user = new user;
        //get user's id
        $userId = $user->checkLogged();
        $background = "";

        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !== "" ){
            $uploads_dir =  ROOT . '/template/images/album/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            $index = new index;
            $background = $index -> prepareBackground($background);

            move_uploaded_file($tmp_name,$uploads_dir . $background);
        }

        if (!empty($_POST)) {
            $title =$_POST['title'];
            $description =$_POST['description'];
            $date = time();
            $index = new index;
            $title = $index->checkString($title);
            $description = $index->checkString($description);
            $album->addAlbum($title, $description, $date, $background, $userId);

            $index= new index;
            $index->render('album','add', array(
                'album' => $title,
            ));
        }
        return true;
    }

    /**
     * Edit album to DB
     * @return bool
     */
    public function actionEdit(){

        $album = new album;
        $result = $album->getAlbumById($_POST['albumId']);

        $user = new user;
        //get user's id
        $userId = $user->checkLogged();
        $photo = $_FILES['photo']['name'];
        $background = $result[0]['background'];

        if(isset($photo) &&  $photo  !== "" ){
            $uploads_dir =  str_replace(" ","", ROOT . '\ template\images\album' . ' \ ');
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            // change the name of photo
            $index = new index;
            $background = $index -> prepareBackground($background);
            move_uploaded_file($tmp_name,$uploads_dir . $background );
        }

        if (!empty($_POST) ) {

            $title =$_POST['title'];
            $description =$_POST['description'];
            $date = time();
            $index = new index;
            $title = $index->checkString($title);
            $description = $index->checkString($description);
            $album->editAlbum($title, $description, $date, $background, $_POST['albumId']);
        }


        //delete photo from tmp directory
        $index = new index;
        $index->deleteFiles($photo,$_POST['directory']);
        return true;
    }

    /**
     * Delete album from DB
     * @return bool
     */

    public function actionDelete()
    {
        $albumId = $_POST['albumId'];
        $album = new album;
        $albumPhoto = $album->getAlbumById($albumId);

        $album->deleteAlbum($albumId);
        $path = "/template/images/album/";
        unlink(ROOT .$path.$albumPhoto[0]['background']);

        return true;

    }

    /**
     * Get album data from DB
     * @return bool
     */

    public function actionGetAlbumData()
    {

        $album = new album;
        $result = $album->getAlbumById($_POST['albumId']);

        $index= new index;
        if($result){
            $index->render('album','showOneAlbumData', array(
                'album' => $result[0],
            ));
        }
        return true;
    }

}


?>