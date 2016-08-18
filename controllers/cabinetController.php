<?php
class cabinetController
{
    /**
     * Update user info
     * @return bool
     */
    public function actionEdit()
    {
        $user = new user;
        //get user's id
        $userId = $user->checkLogged();
        //get user's data from db
        $userData = $user->getUserById($userId);

        $name = $userData['firstName'];
        $surname = $userData['lastName'];
        $email = $userData['email'];
        $dateOfBirth = $userData['dateOfBirth'];
        $sex = $userData['sex'];
        $status = $userData['status'];
        $login = $userData['login'];
        $errors = false;
        $background = $userData['photo'];
        $isUpdated = "0";

        //upload new photo
        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !== "" ){

            $uploads_dir =  ROOT . '/template/images/user/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            $index = new index;
            $background = $index -> prepareBackground($background);
            move_uploaded_file($tmp_name,$uploads_dir . $background);
        }


        if (!empty($_POST) && isset($_POST['submit'])) {
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $email = $_POST['email'];
            $dateOfBirth = $user->convertDataToTimestamp($_POST['dateOfBirth']);
            $sex = $_POST['sex'];
            $status = $_POST['status'];
            $login = $_POST['login'];
            $index = new index;
            $name = $index->checkString($name);
            $surname = $index->checkString($surname);
            $email = $index->checkString($email);
            $status = $index->checkString($status);
            $login = $index->checkString($login);


            //check weather email is correct
            if (!$user->checkEmail($email)) {
                $errors[] = "Your email is wrong, please check it";
            };

            //update if all data is correct
            if ($errors == false) {
                $user->update($userId, $login, $name, $surname, $sex, $status, $email, $dateOfBirth,
                              $background);
                $isUpdated = "1";
            };
            $index = new index;
            $index->render('cabinet', 'editCabinet', array(
                'name' => $name,
                'surname' => $surname,
                'errors' => $errors,
                'isUpdated' => $isUpdated,
            ));
            return true;
        }
    }

    /**
     * Get data for rendering user's cabinet
     * @return bool
     */
    public function actionViewCabinet()
    {

        $user = new user;
        //get user's id
        $userId = $user->checkLogged();
        //get user's data from db
        $userData = $user->getUserById($userId);
        //getListof albums by id
        $album = new album;
        $albums = $album->getAlbumList($userId);

        $index = new index;
        //render userCabinet
        $index->render('cabinet', 'viewCabinet', array(
            'userData' => $userData,
            'albums' => $albums,

        ));
        return true;
    }

    /**
     * Get data about users to render left sidebar
     * @return bool
     */

    public function actionUserInfo()
    {
        $user = new user;
        //get user's id
        $userId = $user->checkLogged();
        //get user's data from db
        $userData = $user->getUserById($userId);
        $index = new index;
        //render user info in leftSidebar
        $index->render('cabinet', 'leftSidebarInfo', array(
            'userData' => $userData,

        ));
        return true;
    }



}


?>