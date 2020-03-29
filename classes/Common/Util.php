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

    /**
     * 決済処理CGIリクエスト
     * $url CGI URL
     * $param パラメータ
     * 
     * curlでFREGI CGIへリクエストし、
     * CGIの結果を改行コードで分割した配列を返却する
     * レスポンスで返却される値はFREGI APIの各仕様書参照
     */
    static function payment_post_request($url, $param) {
        $ch = curl_init();

        //配列をhttp_build_queryでエンコード
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($param));

        //相手側からのデータの返り値を文字列で取得
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        //送信先の指定
        curl_setopt($ch, CURLOPT_URL, $url);

        $result = curl_exec($ch);
        curl_close($ch);

        return explode("\n", $result);
    }
}