<?php
class photo
{

    /**
     * Returns single photo item with specified id
     * $param integer $id
     */

    public function getPhotoById($photoId){

        $db =  Db::getConnection();
        $sql ='SELECT * FROM `photos` WHERE `photoId` = :photoId' ;
        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);

        $result->execute();
        $photo = $result->fetchAll();
        if($photo){
            return $photo;
        }else{
            return false;
        }
    }

    /**
     * Get data about photos in album
     * $param integer $id
     */
    public function getPhotoList($albumId)
    {
        $db =  Db::getConnection();
        if($albumId){
            $sql = 'SELECT `photos`.`title`, `photos`.`description`, `photos`.`albumId`,
                    `photos`.`photoId`, `photos`.`photo`,`photos`.`dateOfCreation`
                    FROM `photos`
                    WHERE `photos`.`albumId`= :albumId
                    ORDER BY `photos`.`dateOfCreation` DESC';
//            $sql = 'SELECT `photos`.`title`, `photos`.`description`, `photos`.`albumId`,
//                    COUNT(`photos`.`photoId`), `photos`.`photoId`, `photos`.`photo`,`photos`.`dateOfCreation`
//                    FROM `photos`,`likes`
//                    WHERE `albumId`= :albumId AND `photos`.`photoId`=`likes`.`photoId`
//                    GROUP BY `likes`.`photoId`';
        }else{
            $sql = 'SELECT `photos`.`title`, `photos`.`description`, `photos`.`albumId`,
                    COUNT(`photos`.`photoId`), `photos`.`photoId`, `photos`.`photo`,`photos`.`dateOfCreation`
                    FROM `photos`,`likes`
                    WHERE `photos`.`photoId`=`likes`.`photoId`
                    GROUP BY `likes`.`photoId`';
        }

//        $sql = 'SELECT `photos`.`title`, `photos`.`description`, `photos`.`albumId`, `photos`.`photoId`,
//                `photos`.`photo`, `photos`.`dateOfCreation`, `albums`.`title`, `albums`.`description`
//                FROM `photos`,`albums`
//                WHERE `photos`.`albumId` = `albums`.`albumId`
//                AND `albums`.`albumId` = :albumId';

        $result = $db->prepare($sql);
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
     * Delete photo from DB by it id
     * $param integer $id
     */
    public function deletePhoto($photoId){

        $db =  Db::getConnection();

        $sql = 'DELETE FROM `photos` WHERE `photoId` = :photoId';
        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        print_r($result);
        $result->execute();

        return true;
    }

    /**
     * Add new photo to db
     * @param string $title
     * @param string $description
     * @param int $date
     * @param string $photo
     * @param int $albumId
     * @return bool
     */
    public function addPhoto($title, $description, $date, $photo, $albumId)
    {
        $db =  Db::getConnection();

        $sql = 'INSERT INTO `photos`(`title`, `description`, `albumId`, `photo`, `dateOfCreation`)
          VALUES ( :title, :description, :albumId, :photo, :dateOfCreation)';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':albumId', $albumId, PDO::PARAM_STR);
        $result->bindParam(':photo', $photo, PDO::PARAM_STR);
        $result->bindParam(':dateOfCreation', $date, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Update photo info in DB
     * @param string $title
     * @param string $description
     * @param int $date
     * @param string $background
     * @param int $photoId
     * @return bool
     */
    public function editPhoto($title, $description, $date, $background, $photoId){

        $db =  Db::getConnection();

        $sql = 'UPDATE `photos` SET `title`= :title,`description`= :description,
                `dateOfCreation`= :dateOfCreation, `photo` = :background WHERE `photoId` = :photoId';
        $result = $db->prepare($sql);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':description', $description, PDO::PARAM_STR);
        $result->bindParam(':dateOfCreation', $date, PDO::PARAM_STR);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $result->bindParam(':background', $background, PDO::PARAM_STR);

        $result->execute();
        return true;
    }

    /**
     * Update name of tmp file in table Photos
     * @param string $photoTmp
     * @param int $photoId
     * @return bool
     */
    public function updateTmpFile($photoTmp, $photoId){
        $db =  Db::getConnection();
        $sql ='UPDATE `photos` SET `photoTmp`=:photoTmp WHERE `photoId` = :photoId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':photoTmp', $photoTmp, PDO::PARAM_INT);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $result->execute();
        return true;
    }

    /**
     * Get name of tmp file from table users
     * @param int $photoId
     * @return mixed|PDOStatement
     */

    public function getTmpFile($photoId){

        $db =  Db::getConnection();
        $sql ='SELECT `photoTmp` FROM `photos` WHERE `photoId` = :photoId' ;

        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetch();
        return $result;
    }

}

?>