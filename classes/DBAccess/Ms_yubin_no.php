<?php
namespace Was;

class Ms_yubin_no
{
    public function __construct()
    {
    }

    /*
     * 郵便番号で検索
     * @param varchar $yubin_no
     * @return array|mixed
     */
    public function findByYubinno($yubin_no)
    {
        try {
            $db = Db::getInstance();
            $sth = $db->prepare("SELECT * FROM ms_yubin_no WHERE yubin_no = :yubin_no;");
            $sth->execute([':yubin_no' => $yubin_no,]);
            $msYubinNo = $sth->fetch();
        } catch (\PDOException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', 'error_log.txt');
            $msYubinNo = [];
        }

        return $msYubinNo;
    }
}
