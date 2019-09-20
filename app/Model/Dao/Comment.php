<?php

namespace Model\Dao;

/**
 * Class User
 *
 * Userテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2018/08/28
 * @package Model\Dao
 */
class Comment extends Dao
{
  public function get_detailcomment($planid){
    $sql = "select * from comment left join user on comment.user_id = user.id where comment.plan_id=:planid";
    // SQLをプリペア
    $statement = $this->db->prepare($sql);

    $statement->bindValue(":planid", $planid, \PDO::PARAM_INT);
    //SQLを実行
    $statement->execute();

    $result = $statement->fetchAll();

    return $result;

  }

}
