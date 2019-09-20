<?php

namespace Model\Dao;

use Doctrine\DBAL\DBALException;
use PDO;

/**
 * Class Item
 *
 * Itemテーブルを扱う Classです
 * DAO.phpに用意したCRUD関数以外を実装するときに、記載をします。
 *
 * @copyright Ceres inc.
 * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
 * @since 2019/08/14
 * @package Model\Dao
 */
class Plan extends Dao
{

    /**
     * getItem Function
     *
     * Itemテーブルから指定idのレコードを一件取得するクエリです。
     *
     * @param int $id 引数として、取得したい商品のアイテムIDを指定します。
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     * @since 2019/08/14
     */

    public function search_plan($data)
    {

        //全件取得するクエリを作成
        $sql = "select * from plan where `title` like :word
                                      or `sub_title` like :word
                                      or `detail` like :word";
       if(isset($data["cat_code"])){
         $sql.=" or cat_code=:cat_code";
       }

       if(isset ($data["place"])){
         $sql.=" or place like :place ";
       }



        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //idを指定します
        $statement->bindValue(":word", "%".$data["word"]."%", PDO::PARAM_STR);

        if(isset($data["cat_code"])){
          $statement->bindValue(":cat_code", $data["cat_code"], PDO::PARAM_INT);
        }

        if(isset($data["place"])){
          $statement->bindValue(":place", "%".$data["place"]."%", PDO::PARAM_STR);
        }
        //SQLを実行
        $statement->execute();

        //結果レコードを一件取得し、返送
        return $statement->fetchall();

    }

    /**
     * getItem Function
     *
     * Itemテーブルから指定idのレコードを一件取得するクエリです。
     *
     * @param int $id 引数として、取得したい商品のアイテムIDを指定します。
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     * @since 2019/08/14
     */

    public function select_plan()
    {

        //全件取得するクエリを作成
        $sql = "select * from plan";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);


        //SQLを実行
        $statement->execute();

        //結果レコードを一件取得し、返送
        return $statement->fetchall();

    }

    public function add_good($planid){

      $sql = "update plan set good=good+1 where id=:planid";
            // SQLをプリペア
      $statement = $this->db->prepare($sql);

      $statement->bindValue(":planid", $planid, PDO::PARAM_INT);


      //SQLを実行
      $statement->execute();

      $sql = "select * from plan where id=:planid";
      // SQLをプリペア
      $statement = $this->db->prepare($sql);

      $statement->bindValue(":planid", $planid, PDO::PARAM_INT);
      //SQLを実行
      $statement->execute();

      $result = $statement->fetch();


      return $result["good"];


    }

    public function get_detailplan($planid){
      $sql = "select *,plan.id as plan_id from plan left join user on plan.user_id = user.id where plan.id=:planid";
      // SQLをプリペア
      $statement = $this->db->prepare($sql);

      $statement->bindValue(":planid", $planid, PDO::PARAM_INT);
      //SQLを実行
      $statement->execute();

      $result = $statement->fetch();

      return $result;

    }
}
