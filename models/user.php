<?php

class user{

    /**
     * Add new user to db
     * @param string $login
     * @param string $password
     * @param string $name
     * @param string $surname
     * @param string $sex
     * @param string $status
     * @param string $email
     * @param int $dateOfBirth
     * @param string $background
     * @return bool
     */
    public function register( $login, $password, $name, $surname, $sex, $status, $email, $dateOfBirth, $background){
        $db =  Db::getConnection();
        $sql ='INSERT INTO `users`(`login`, `password`, `firstName`, `lastName`, `sex`, `status`,`dateOfBirth`, `email`, `photo`)
                            VALUES (:login, :password, :name, :surname, :sex, :status, :dateOfBirth, :email, :background)';
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':password', $password, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':sex', $sex, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':background', $background, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Update User info in table Users
     * @param int $userId
     * @param string $login
     * @param string $password
     * @param string $name
     * @param string $surname
     * @param string $sex
     * @param string $status
     * @param string $email
     * @param int $dateOfBirth
     * @param string $photo
     */
    public function update($userId, $login, $name, $surname, $sex, $status, $email, $dateOfBirth, $photo){
        $db =  Db::getConnection();
        $sql = "UPDATE `users` SET `firstName`= :name,`lastName`= :surname,`email`= :email,`dateOfBirth`=:dateOfBirth,
                `sex`= :sex, `status`= :status,`login`= :login, `photo`=:photo,
                `photoTmp` = '' WHERE `userId`= :userId";

        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);
        $result->bindParam(':name', $name, PDO::PARAM_STR);
        $result->bindParam(':surname', $surname, PDO::PARAM_STR);
        $result->bindParam(':sex', $sex, PDO::PARAM_STR);
        $result->bindParam(':status', $status, PDO::PARAM_STR);
        $result->bindParam(':dateOfBirth', $dateOfBirth, PDO::PARAM_STR);
        $result->bindParam(':email', $email, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':photo', $photo, PDO::PARAM_INT);
        $result->execute();
    }

    /**
     * Email validation
     * @param $email
     * @return mixed
     */
    public function checkEmail($email){

        return filter_var($email, FILTER_VALIDATE_EMAIL);
    }

    /**
     * Password validation
     * @param int $password
     * @return bool
     */
    public function checkPassword($password){

        if(preg_match("/[\d\w]{6,12}/i",trim($password))){
            return true;
        }else{
            return false;
        }
    }
       /**
     * Get user's hashed password by login
     * @param string $login
     * @return bool|mixed
     */
    public function checkLoginCorrect($login){
        $db =  Db::getConnection();
        $sql ='SELECT * FROM `users` WHERE `login` = :login' ;
        $result = $db->prepare($sql);
        $result->bindParam(':login', $login, PDO::PARAM_STR);

        $result->execute();
        $user = $result->fetch();

        if($user){
            return $user;
        }else{

            return false;
        }
    }

    /**
     * Save user Id in Session
     * @param $userId
     */
    public function auth($userId){

        $_SESSION['userId'] = $userId;

    }

    /**
     * Check weather user is logged in
     * @return mixed
     */
    public function checkLogged(){

        if(isset($_SESSION['userId'])){
            return $_SESSION['userId'];
        }else{
            return false;
        }
    }

    /**
     * check weather user is logged in
     * @return bool
     */
    public function isGuest(){
        if(isset($_SESSION['userId'])){
            return false;
        }
        return true;
    }

    /**
     * Select user's data from DB, convert date of birth to date, month, year
     * @param $userId
     * @return bool|mixed
     */
    public function getUserById($userId){
        $db =  Db::getConnection();
        $sql ='SELECT * FROM `users` WHERE `userId` = :userId' ;
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();
        $user = $result->fetch();

        $date = date("d",$user['dateOfBirth']);
        $month = date("m",$user['dateOfBirth']);
        $year = date("Y",$user['dateOfBirth']);
        $monthName = date("F",$user['dateOfBirth']);
        $user['dateOfBirthUp'] = array(
            'date' => $date,
            'monthName' =>$monthName,
            'month' => $month,
            'year' => $year);

        //get user age
        if($month > date('m') || $month == date('m') && $date > date('d'))
            $age = (date('Y') - $year - 1);
        else
            $age = (date('Y') - $year);
        $user['age'] = $age;

        if($user){
            return $user;
        }else{
            return false;
        }
    }

    /**
     * Select users from DB
     * @param $start
     * @param $quantity
     * @return array|bool
     */
    public function getUsersList($start, $quantity){
        $db =  Db::getConnection();
        $sql ='SELECT * FROM `users` LIMIT ' .  $start . ', ' . $quantity ;
        $result = $db->prepare($sql);
        $result->execute();
        $res= $result->fetchAll();

        //get date, month, year of birth
        for($i=0; $i< count($res);$i++){
            $date = date("d",$res[$i]['dateOfBirth']);
            $month = date("m",$res[$i]['dateOfBirth']);
            $year = date("Y",$res[$i]['dateOfBirth']);
            $res[$i]['dateOfBirth'] = array(
                'date' => $date,
                'month' => $month,
                'year' => $year);
         //to get age of user
            if($month > date('m') || $month == date('m') && $date > date('d'))
                $age = (date('Y') - $year - 1);
            else
                $age = (date('Y') - $year);
            $res[$i]['age'] = $age;
        }



        if($res){
            return $res;
        }else{
            return false;
        }

    }

    /**
     * Set the name of uploaded album photo to Users table
     * @param $photoTmp
     * @param $userId
     */
    public function updateTmpFile($photoTmp, $userId){
        $db =  Db::getConnection();
        $sql ='UPDATE `users` SET `photoTmp`=:photoTmp WHERE `userId` = :userId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':photoTmp', $photoTmp, PDO::PARAM_INT);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();

    }

    /**
     * Get neme of tmp file from users table
     * @param $userId
     * @return mixed|PDOStatement
     */
    public function getTmpFile($userId){
        print_r("inside");
        print_r($userId);
        $db =  Db::getConnection();
        $sql ='SELECT `photoTmp` FROM `users` WHERE `userId` = :userId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();
        print_r($result);
        $result = $result->fetch();
        print_r($result);
        return $result;
    }

    /**
     * Convert date of birth to timestamp
     * @param $date
     * @return int
     */
    public function convertDataToTimestamp($date){
        $array = explode("-",$date);
        return mktime(0, 0, 0, $array[1], $array[2], $array[0]);
    }


    public function getAge($y, $m, $d) {
        if($m > date('m') || $m == date('m') && $d > date('d'))
            return (date('Y') - $y - 1);
        else
            return (date('Y') - $y);
    }


    /**
     * Select users from DB, filter by name and surname
     * @param $namePattern
     * @return array
     */
    public function getUsersByName($namePattern){
        $namePieces = explode(" ", $namePattern);

        $db =  Db::getConnection();
        if(count($namePieces) == 1){

            $sql = "SELECT * FROM `users`
            WHERE `firstName` LIKE '%" . $namePattern . "%' OR `lastName` LIKE '%" . $namePattern . "%'";
        }else{

            $sql = "SELECT * FROM `users`
            WHERE
               `firstName` LIKE '%" . $namePieces[0] . "%'  AND `lastName` LIKE '%" . $namePieces[1] . "%'
            OR `firstName` LIKE '%" . $namePieces[1] . "%'  AND `lastName` LIKE '%" . $namePieces[0] . "%'";
        }


        $result = $db->prepare($sql);

        $result->execute();
        $res = $result->fetchAll();

        if($res){
            //get date, month, year of birth
            for($i=0; $i< count($res);$i++){
                $date = date("d",$res[$i]['dateOfBirth']);
                $month = date("m",$res[$i]['dateOfBirth']);
                $year = date("Y",$res[$i]['dateOfBirth']);
                $res[$i]['dateOfBirth'] = array(
                    'date' => $date,
                    'month' => $month,
                    'year' => $year);
                //to get age of user
                if($month > date('m') || $month == date('m') && $date > date('d'))
                    $age = (date('Y') - $year - 1);
                else
                    $age = (date('Y') - $year);
                $res[$i]['age'] = $age;
            }


        }
        return $res;
    }
}



?>