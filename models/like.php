<?php

/**
 * Created by PhpStorm.
 * User: Администратор
 * Date: 27.07.2016
 * Time: 22:17
 */
class like
{
    /**
     * Put like to DB
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public function likeAdd($userId,$photoId){
        $db =  Db::getConnection();

        $sql = 'INSERT INTO `likes` (`userId`, `photoId`)
          VALUES ( :userId, :photoId)';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Remove like from db
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public function likeRemove($userId,$photoId){
        $db =  Db::getConnection();

        $sql = 'DELETE FROM `likes` WHERE `userId` = :userId AND `photoId`=:photoId';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $result->execute();

        return true;
    }

    /**
     * Get info about users that put like
     * @param int $photoId
     * @return array
     */
    public function showLikeAuthor($photoId){
        $db =  Db::getConnection();

        $sql = 'SELECT `users`.`firstName`, `users`.`lastName`, `users`.`photo`
                FROM `users`,`likes`
                WHERE `users`.`userId`=`likes`.`userId` AND `likes`.`photoId` = :photoId ';
        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $result->execute();

        return $result->fetchAll();
    }

    /**
     * Get quantity of likes from db
     * @param int $photoId
     * @return mixed
     */
    public function countLikes($photoId){
        $db =  Db::getConnection();

        $sql = 'SELECT COUNT(*) FROM `likes` WHERE `photoId` = :photoId';

        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $result->execute();

        return $result->fetch();
    }

    /**
     * Check whether like exists in DB
     * @param int $userId
     * @param int $photoId
     * @return bool
     */
    public function likeExists($userId,$photoId){
        $db =  Db::getConnection();

        $sql = 'SELECT * FROM `likes` WHERE `photoId` = :photoId AND `userId` = :userId';

        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $result->execute();


        if($result->fetch()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * Get info about likes
     * @param int $photoId
     * @return array|bool|PDOStatement
     */

    public function getLikes($photoId){
        $db =  Db::getConnection();
        $sql = 'SELECT COUNT(`likes`.`photoId`), `likes`.`photoId`
                FROM `likes`
                WHERE `likes`.`photoId` = :photoId
                GROUP BY `likes`.`photoId`';
        $result = $db->prepare($sql);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_INT);
        $result->execute();
        $result = $result->fetchAll();
        if($result){
            return $result;
        }else{
            return false;
        }
    }

}