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
     * getItemList Function
     *
     * Itemテーブルにあるアイテム一覧を取得するためのサンプルです。
     *
     * @return array $result 結果情報を連想配列で指定します。
     * @throws DBALException
     * @since 2019/08/14
     * @copyright Ceres inc.
     * @author y-fukumoto <y-fukumoto@ceres-inc.jp>
     */
    public function getItemList()
    {

        //全件取得するクエリを作成
        $sql = "select * from item";

        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //SQLを実行
        $statement->execute();

        //結果レコードを全件取得し、返送
        return $statement->fetchAll();

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

    public function search_plan($data)
    {

        //全件取得するクエリを作成
        $sql = "select * from plan where `title` like :word
                                      or `sub-title` like :word
                                      or `detail` like :word";
       if($data["cat_code"]){
         $sql.=" or cat_code=:cat_code";
       }

       if($data["place"]){
         $sql.=" or place like :place ";
       }



        // SQLをプリペア
        $statement = $this->db->prepare($sql);

        //idを指定します
        $statement->bindValue(":word", "%".$data["word"]."%", PDO::PARAM_STR);

        if($data["cat_code"]){
          $statement->bindValue(":cat_code", $data["cat_code"], PDO::PARAM_INT);
        }

        if($data["place"]){
          $statement->bindValue(":place", "%".$data["place"]."%", PDO::PARAM_STR);
        }
        //SQLを実行
        $statement->execute();

        //結果レコードを一件取得し、返送
        return $statement->fetchall();

    }

}
