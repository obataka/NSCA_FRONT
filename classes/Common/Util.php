<?php
namespace Was;

use ErrorException;

class Util
{
    public function __construct()
    {
    }

    /*
     * メール送信処理
     * @params $mailto
     * @params $subject
     * @params $message
     */
    function my_send_mail($mailto, $subject, $message) {

        $charset = "iso-2022-JP";
        mb_language("ja");
        mb_internal_encoding("utf-8");

        // 本文
        $body = mb_convert_encoding($message, $charset, "AUTO");

        $from = array("name" => "NSCAジャパン", "mail" => "info@example.com");

        $headers  = "Mime-Version: 1.0\n";
        $headers .= "Content-Transfer-Encoding: 7bit\n";
        $headers .= "Content-Type: text/plain;charset={$charset}\n";
        $headers .= "From: ".mb_encode_mimeheader($from["name"])." <".$from["mail"].">";

        try {
            mb_send_mail($mailto, $subject, $body, $headers);
            return TRUE;
        } catch (ErrorException $e) {
            error_log(print_r($e, true). PHP_EOL, '3', '/home/nls001/demo-nls02.work/public_html/app_error_log/error_log'. date("Ymd"). '.txt');
            return FALSE;
        }
    }
}