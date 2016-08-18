<?php
class album{
    /**
     * Get list of albums of one user or of all users
     * @param $userId
     * @return array|bool
     */
    public function getAlbumList($userId){
        $db =  Db::getConnection();
        if($userId){
            $sql = 'SELECT `albums`.`title`, `albums`.`description`, `albums`.`albumId`, `albums`.`background`, `albums`.`dateOfCreation`,
		            `users`.`firstName`, `users`.`lastName`, `users`.`dateOfBirth`, `users`.`sex`
                    FROM `albums`,`users` WHERE `albums`.`userId` = `users`.`userId` AND `albums`.`userId`= :userId' ;
        }else{

            $sql = 'SELECT `albums`.`title`, `albums`.`description`, `albums`.`albumId`, `albums`.`background`, `albums`.`dateOfCreation`,
		            `users`.`firstName`, `users`.`lastName`, `users`.`dateOfBirth`, `users`.`sex`
                    FROM `albums`,`users` WHERE `albums`.`userId` = `users`.`userId`' ;
        }


        $result = $db->prepare($sql);

        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();

        $albums = $result->fetchAll();

        //to get user's date,month and year of birth
        for($i=0; $i< count($albums);$i++){
            $date = date("d",$albums[$i]['dateOfBirth']);
            $month = date("m",$albums[$i]['dateOfBirth']);
            $year = date("Y",$albums[$i]['dateOfBirth']);
            $albums[$i]['dateOfBirth'] = array(
                'date' => $date,
                'month' => $month,
                'year' => $year);
        }


        if($albums){
            return $albums;
        }else{
            return false;
        }



    }

    /**
     * Add album data
     * @param $title
     * @param $description
     * @param $date
     * @param $background
     * @param $userId
     * @return bool
     */
    public function addAlbum($title, $description, $date, $background, $userId){
        $db =  Db::getConnection();

        $sql = 'INSERT INTO `albums`(`title`, `description`, `dateOfCreation`, `userId`, `background`)
                VALUES ( :title, :description, :dateOfCreation, :userId, :background)';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':dateOfCreation', $date, PDO::PARAM_STR);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':background', $background, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Update album data
     * @param $title
     * @param $description
     * @param $date
     * @param $background
     * @param $albumId
     * @return bool
     */
    public function editAlbum($title, $description, $date, $background, $albumId){

        $db =  Db::getConnection();

        $sql = 'UPDATE `albums` SET `title`= :title,`description`= :description,
                `dateOfCreation`= :dateOfCreation, `background` = :background WHERE `albumId` = :albumId';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':dateOfCreation', $date, PDO::PARAM_STR);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_INT);
        $result->bindParam(':background', $background, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Delete album from db
     * @param int $albumId
     * @return bool
     */
    public function deleteAlbum($albumId){

        $db =  Db::getConnection();

        $sql = 'DELETE FROM `albums` WHERE `albumId` = :albumId';
        $result = $db->prepare($sql);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_INT);
        $result->execute();

        return true;
    }


    public function updateTmpFile($photoTmp, $albumId){
        $db =  Db::getConnection();

        $sql ='UPDATE `albums` SET `photoTmp`=:photoTmp WHERE `albumId` = :albumId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':photoTmp', $photoTmp, PDO::PARAM_INT);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_INT);
        $result->execute();
    }



    /**
     * Gets data abot album from db
     * @param int $albumId
     * @return bool|mixed
     */
    public function getAlbumById($albumId){

        $db =  Db::getConnection();
        $sql ='SELECT * FROM `albums` WHERE `albumId` = :albumId' ;
        $result = $db->prepare($sql);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_STR);

        $result->execute();
        $album= $result->fetchAll();

        if($album){
            return $album;
        }else{
            return false;
        }
    }

    /**
     * Get users albums
     * @param $userId
     * @return array|bool|PDOStatement
     */
    public function getUsersAlbums($userId){
        $db =  Db::getConnection();
        $sql = 'SELECT `albums`.`albumId` FROM `albums` WHERE `albums`.`userId` = :userId
                ';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetchAll();

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /**
     * Check wether photos owner is logged user
     * @param $userId
     * @param $albumId
     * @return array|bool|PDOStatement
     */
    public function isAlbumUsers($userId,$albumId){
        $db =  Db::getConnection();
        $sql = 'SELECT `albums`.`albumId` FROM `albums`
        WHERE `albums`.`userId`= :userId AND `albums`.`albumId` = :albumId';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_INT);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetchAll();

        if($result){
            return $result;
        }else{
            return false;
        }
    }

    /**
     * Calculate user's age
     * @param $y
     * @param $m
     * @param $d
     * @return bool|string
     */
    public function getAge($y, $m, $d) {
        if($m > date('m') || $m == date('m') && $d > date('d'))
            return (date('Y') - $y - 1);
        else
            return (date('Y') - $y);
    }

    /**
     * Get neme of tmp file from albums table
     * @param int $albumId
     * @return mixed|PDOStatement
     */
    public function getTmpFile($albumId){

        $db =  Db::getConnection();
        $sql ='SELECT `photoTmp` FROM `albums` WHERE `albumId` = :albumId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetch();
        return $result;
    }


}

?>