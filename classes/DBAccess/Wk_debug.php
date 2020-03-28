<?php
namespace Was;

class Wk_debug
{
    public function __construct()
    {
    }

    /**
     * @return bool
     */
    public function deleteAllRec_deleteWkDebug($db)
    {
        try {
            $sth = $db->prepare("DELETE FROM wk_debug");
            $sth->execute();
        } catch (\PDOException $e) {
            error_log(print_r($e, true) . PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/batch_error_log/error.txt');
            $db->rollBack();
            return FALSE;
        }

        return TRUE;
    }
}