<?php
class feedback{
    /**
     * Add feedback to DB
     * @param int $photoId
     * @param int $userId
     * @param string $title
     * @param int $date
     * @return bool
     */
    public function feedbackAdd($photoId,$userId, $title, $date){
        $db =  Db::getConnection();

        $sql = 'INSERT INTO `feedbacks` (`userId`, `photoId`, `title`, `date`)
          VALUES ( :userId, :photoId, :title, :date)';
        $result = $db->prepare($sql);
        $result->bindParam(':userId', $userId, PDO::PARAM_STR);
        $result->bindParam(':photoId', $photoId, PDO::PARAM_STR);
        $result->bindParam(':title', $title, PDO::PARAM_STR);
        $result->bindParam(':date', $date, PDO::PARAM_STR);

        $result->execute();

        return true;
    }

    /**
     * Delete feedback from DB
     * @param int $feedbackId
     * @return bool
     */
    public function deleteFeedback( $feedbackId){
        $db =  Db::getConnection();
        $sql = 'DELETE FROM `feedbacks` WHERE `feedbackId`= :feedbackId ';
        $result = $db->prepare($sql);
        $result->bindParam(':feedbackId', $feedbackId, PDO::PARAM_INT);


        $result->execute();

        return true;
    }



    /**
     * get all feedbacks
     * @return array|bool|PDOStatement
     */
    public function getFeedbacks($photoId, $start = 0 , $limit = null){
        $db =  Db::getConnection();
        $lim =  'LIMIT ' . $start . ', ' . $limit . ' ' ;
        if($limit == null){
            $lim = " ";
        }

        $sql = 'SELECT  `feedbacks`.`title`, `feedbacks`.`date`,`feedbacks`.`photoId`, `feedbacks`.`userId`,
                `users`.`firstName`, `users`.`lastName`, `users`.`photo`, `feedbacks`.`feedbackId`
                FROM `feedbacks`,`photos`,`users`
                WHERE `feedbacks`.`photoId`=`photos`.`photoId` AND `feedbacks`.`userId` = `users`.`userId` AND
                `photos`.`photoId` = :photoId
                ORDER BY `feedbacks`.`date` DESC ' . $lim . ' ';


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


?>