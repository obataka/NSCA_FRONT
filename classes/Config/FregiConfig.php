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



	// ■■　カード支払回数指定区分　■■

	// 一括支払い
    const PAY_MODE_LUMP = 10;
	// 2回払い
    const PAY_MODE_2 = 60;
	// 分割払い
    const PAY_MODE_INSTALLMENTS = 61;
	// リボ払い
    const PAY_MODE_REVOLVING = 80;



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

	// 店舗ID
	const SHOP_ID = "17612";

	// トークン発行キー
	const TOKEY_KEY = "794c30757b53bb2e";

	// ■■　API URL　■■同一名の上段は本番、下段がテスト

	// 承認・顧客登録処理
	// const AUTHORIZATION_API_URL = "https://ssl.f-regi.com/connect/authm.cgi";
	const AUTHORIZATION_API_URL = "https://ssl.f-regi.com/connecttest/authm.cgi";
	
	// 売上処理
	// const SALES_API_URL = "https://ssl.f-regi.com/connect/sale.cgi";
	const SALES_API_URL = "https://ssl.f-regi.com/connecttest/sale.cgi";

  // ■■　その他定数　■■

	// SHOPID
//	const SHOP_ID = 17612;
	// 文字コード
	const CHAR_CODE = "euc";
	// 有効期限
	const MAX_EXPIRE = 14;

	// コンビニ決済処理
	// const CONVENI_API_URL = "https://ssl.f-regi.com/connect/convorder.cgi";
	const CONVENI_API_URL = "https://ssl.f-regi.com/connecttest/convorder.cgi";

	// 顧客情報取得
	// const GET_CUSTOMER_INFO_API_URL = "https://ssl.f-regi.com/connect/customerinfo.cgi";
	const GET_CUSTOMER_INFO_API_URL = "https://ssl.f-regi.com/connecttest/customerinfo.cgi";
}
