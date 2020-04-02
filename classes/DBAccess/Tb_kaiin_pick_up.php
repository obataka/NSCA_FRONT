<?php
namespace Was;

class Tb_kaiin_pick_up
{
    public function __construct()
    {
    }


    /*
     * 会員番号から有効データを取得する
     * @param varchar $kaiinNo
     * @return array
     */
    public function findByKaiinNo($kaiinNo)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT *
FROM tb_kaiin_pick_up
WHERE sakujo_flg = 0
;
            ");
            $sth->execute([':kaiin_no' => $kaiinNo]);
            $kaiinPickup  = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            $kaiinPickup = [];
        }
        return $kaiinPickup;
    }

    /*
     * 登録（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function insertRec_noTran($db, $param)
    {

        try {
            $sql = <<<SQL
            INSERT
            INTO tb_kaiin_pick_up(
                  kaiin_no
                , pick_up_1
                , pick_up_2
                , pick_up_3
                , pick_up_4
                , pick_up_5
                , pick_up_6
                , sakujo_flg
                , sakusei_user_id
                , koshin_user_id
                , sakusei_nichiji
                , koshin_nichiji
            )
            VALUES (
                  :kaiin_no
                , :pick_up_1
                , :pick_up_2
                , :pick_up_3
                , :pick_up_4
                , :pick_up_5
                , :pick_up_6
                , :sakujo_flg
                , :sakusei_user_id
                , :koshin_user_id
                , :sakusei_nichiji
                , :koshin_nichiji
            );
SQL;
            $sth = $db->prepare($sql);
            $sth->execute([
                ':kaiin_no' => $param['kaiin_no'],
                ':pick_up_1' => $param['pick_up_1'],
                ':pick_up_2' => $param['pick_up_2'],
                ':pick_up_3' => $param['pick_up_3'],
                ':pick_up_4' => $param['pick_up_4'],
                ':pick_up_5' => $param['pick_up_5'],
                ':pick_up_6' => $param['pick_up_6'],
                ':sakujo_flg' => $param['sakujo_flg'],
                ':sakusei_user_id' => $param['sakusei_user_id'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':sakusei_nichiji' => $param['sakusei_nichiji'],
                ':koshin_nichiji' => $param['koshin_nichiji']
            ]);
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log.txt');
            return FALSE;
        }
        return TRUE;
    }

    /*
     * 削除フラグ更新処理（接続及びトランザクションは外側実施）
     * @param object $db
     * @param array $param
     * @return boolean
     */
    public function updateSakujoFlg_noTran($db, $param)
    {
        try {
            $sql = <<<SQL
            UPDATE tb_kaiin_pick_up
               SET sakujo_flg = :sakujo_flg
                 , koshin_user_id = :koshin_user_id
             WHERE sakujo_flg = 0
               AND kaiin_no = :kaiin_no;
            SQL;

            $sth = $db->prepare($sql);
            $sth->execute([
                ':sakujo_flg' => $param['sakujo_flg'],
                ':koshin_user_id' => $param['koshin_user_id'],
                ':kaiin_no' => $param['kaiin_no']
            ]);

        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/nishiyama_log.txt');
            return FALSE;
        }
        return TRUE;
    }








}
