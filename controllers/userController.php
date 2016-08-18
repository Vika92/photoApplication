<?php
include_once ROOT . '/models/user.php';


class userController
{
    /**
     * Add new user's data to DB
     * @return bool
     */

    public function actionRegister()
    {
        $name = "";
        $surname = "";
        $email = "";
        $dateOfBirth = "";
        $sex = "";
        $status = "";
        $login = "";
        $password = "";
        $errors = false;
        $isRegistered = "0";
        $user = new user();
        //upload user photo to server
        $background = "";

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
            $password = $_POST['password'];
            $passwordHash = password_hash($password, PASSWORD_DEFAULT);
            $index = new index;
            $name = $index->checkString($name);
            $surname = $index->checkString($surname);
            $email = $index->checkString($email);
            $status = $index->checkString($status);
            $login = $index->checkString($login);
            $password = $index->checkString($password);

            //check weather login exists in system
            if ($user->checkLoginCorrect($login)) {
                $errors[] = "This login already exists, please change it";
            };
            //check weather email is correct
            if (!$user->checkEmail($email)) {
                $errors[] = "Your email is wrong, please check it";
            };
            //check weather password is correct
            if (!$user->checkPassword($password)) {
                $errors[] = "Password must contain from 6 to 12 symbols, digits or letters";
            };
            //register if all data is correct
            if ($errors == false) {
                $user->register($login, $passwordHash, $name, $surname, $sex, $status, $email, $dateOfBirth, $background );
                $isRegistered = "1";
            };

        }
        $index = new index;

        $index->render('user', 'registerTest', array(
            'name' => $name,
            'surname' => $surname,
            'errors' => $errors,
            'isRegisterd' => $isRegistered,
        ));
        return true;

    }

    /**
     * Upload file to a directory
     * @return bool
     */
    public function actionUploadFile(){

        $user = new user;
        if(isset($_FILES['photo']['name']) && $_FILES['photo']['name'] !== "" ){

            $uploads_dir =  ROOT . '/template/images/user/tmp/';
            $tmp_name = $_FILES['photo']['tmp_name'];
            $background = $_FILES['photo']['name'];
            move_uploaded_file($tmp_name,$uploads_dir . $background);
        }
        $user->updateTmpFile($background, $_POST['userId']);
        return true;
    }

    /**
     * Check weather users input data is correct, login user
     * @return string
     */
    public function actionLogin()
    {

        $login = "";
        $password = "";
        if (!empty($_POST) && isset($_POST['submit'])){
            $login = $_POST['login'];
            $password= $_POST['password'];
        }

        $answer = " You are not logged in, Login or Password are not correct";
        $status = "0";
        $user = new user();

        if (isset($_POST['submitLogin'])) {


            $login = $_POST['loginLogin'];
            $password = $_POST['passwordLogin'];
            $index = new index;
            //data validation
            if ($login) {

                $login = $index->checkString($login);
            }


            if ($password) {
                $password = $index->checkString($password);
            }

            //check weather user with this login exists
            $userInfo = $user->checkLoginCorrect($login);

            if($userInfo){
                //check weather upassword is correct
                if(password_verify($password, $userInfo['password'])){
                    //put UserId into session
                    $user -> auth($userInfo['userId']);
                    print_r("here");
                    $answer = "You are successfully logged in!";
                    $status = "1";
                }
            }
        }

        $index = new index;

        $index->render('user', 'loginTest', array(
            'answer' => $answer,
            'status' => $status,
            'userId' => $userInfo['userId'],
        ));
        return $answer;
    }




    /**
     * Logout user
     * @return bool
     */

    public function actionLogout(){

        unset($_SESSION['userId']);

        return true;
    }

    /**
     * Get user's data by it ID
     * @param int $userId
     * @return bool|mixed|user
     */
    public function getUserById($userId){
        $user = new user();
        $user =  $user->getUserById($userId);

        //to get user's date,month and year of birth

            $date = date("d",$user['dateOfBirth']);
            $month = date("m",$user['dateOfBirth']);
            $year = date("Y",$user['dateOfBirth']);
            $user['dateOfBirth'] = array(
                'date' => $date,
                'month' => $month,
                'year' => $year);
        return $user;
    }

    /**
     * Get list of users
     * @return bool
     */
    public function actionGetUsersList(){
        $start = $_POST['start'];
        $quantity = $_POST['quantity'];
        $user = new user();
        $res =  $user->getUsersList($start,$quantity);

        if($res){
            $index = new index;
            $index->render('user','usersList', array(
                'allUsersData' => $res,
            ));

        }
        return true;
    }

    /**
     * Get users by filtering name and surname in leftSidebar
     * @return bool
     */
    public function actionGetUsersByName(){
        $namePattern = $_POST['userName'];

        $user = new user();
        $index = new index;
        $namePattern = $index->checkString($_POST['userName']);
        $res = $user -> getUsersByName($namePattern);

        if($res){
            $index = new index;
            $index->render('user','usersList', array(
                'allUsersData' => $res,
            ));
        }
        return true;
    }

}

?>