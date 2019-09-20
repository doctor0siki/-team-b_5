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
class User extends Dao
{
  public function get_user($id){
    $sql = "select * from user";

    $statement = $this->db->prepare($sql);
    $statement->bindValue(":planid", $planid, PDO::PARAM_INT);
  }
}
