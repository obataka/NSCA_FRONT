<?php
namespace Was;

class FregiConfig
{

// 現行クラスclsFregiCompsettleより定数部分を移行
// （暫定的にマイページで使用分のみ移行）


	// ■■　決済方法　■■

	// カード決済
    const PAY_TYPE_CARD = 10;
	// コンビ二決済
    const PAY_TYPE_CONVENIENCE = 20;
	// Pay-easy決済
    const PAY_TYPE_PAYEASY = 50;



	// ■■　処理成否　■■

	// 成功
    const STATUS_OK = "OK";
	// 失敗
    const STATUS_NG = "NG";
	// キャンセル
    const STATUS_CANCEL = "CANCEL";



	// ■■　取引ステータス区分　■■

	// 発行受付
    const DEALSTATUS_SETTLEACCEPT = "1";
	// 発行取消
    const DEALSTATUS_SETTLECANCEL = "2";
	// 決済開始
    const DEALSTATUS_PAYMENTSTART = "3";
	// 決済完了
    const DEALSTATUS_PAYMENTEND = "4";
	// 決済中断
    const DEALSTATUS_PAYMENTSTOP = "5";
	// 決済完了後取消
    const DEALSTATUS_PAYMENTENDCANCEL = "6";
	// 有効期限切れ
    const DEALSTATUS_EXPIREOVER = "7";









}
