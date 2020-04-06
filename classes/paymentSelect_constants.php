<?php
namespace Was;

/*************************************************************************************************************************************
* PaymentSelect内で使用する定数を定義するクラス
*************************************************************************************************************************************/
Class paymentSelect_constants {

    /*****************************************************************
    * USER_IDとして使用する文字列
    ******************************************************************/
    const USER_ID = 'paymentSelect';

    /*****************************************************************
    * 会員種別
    ******************************************************************/
    // 非会員
    const PROC_TYPE_VISITOR = 0;
    // 会員
    const PROC_TYPE_MEMBER = 1;
    // 会員（再決済選択：カード決済失敗からの戻り）
    const PROC_TYPE_RESELECT_MEMBER = 2;

    /*****************************************************************
    * F-REGI編集区分
    ******************************************************************/
    // 金額
    const FREGI_EDIT_MONEY = 0;
    // お客様名（姓）
    const FREGI_EDIT_USERNAME1 = 1;
    // お客様名（名）
    const FREGI_EDIT_USERNAME2 = 2;
    // お客様名カナ（姓）
    const FREGI_EDIT_USERNAMEKANA1 = 3;
    // お客様名カナ（名）
    const FREGI_EDIT_USERNAMEKANA2 = 4;
    // 商品名
    const FREGI_EDIT_ITEMNAME = 5;
    // Pay-easy用商品名
    const FREGI_EDIT_PAYEASYNAME = 6;
    // Pay-easy用商品名カナ
    const FREGI_EDIT_PAYEASYNAMEKANA = 7;

    /*****************************************************************
    * 画面編集区分
    ******************************************************************/
    // 電話番号・FAX
    const EDIT_PHONE = 0;
    // 郵便番号
    const EDIT_POSTCODE = 1;
    // 名前(漢字/カナ)
    const EDIT_NAME = 2;

    /*****************************************************************
    * カンファレンス　講演区分
    ******************************************************************/
    // 講演
    const CONFERENCE_LECTURE = 1;
    // 実技
    const CONFERENCE_DEMONSTRATION = 2;
    // 懇親会
    const CONFERENCE_MEETING = 3;
    // 休憩
    const CONFERENCE_BREAK = 4;

    /*****************************************************************
    * 遷移元の画面名
    ******************************************************************/
    const MENU_CONFIRM_MEMBER = 'confirmMember';
}