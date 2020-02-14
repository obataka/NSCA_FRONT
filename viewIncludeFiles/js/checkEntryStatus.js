(function ($) {
    $(document).ready(function () {

        /********************************
        * 試験情報明細取得
        ********************************/
        //DBから取得した値を格納する配列の宣言
        var getShutuganJokyo = [];
        var getKaiinJoho = [];

        //区分を格納する変数
        var shiken_sbt_kbn = [];
        var juken_jotai_kbn = [];
        var kamoku_sentaku_kbn = [];
        var nonyu_hoho_kbn = [];
        var nonyubi = [];
        var uketsukebi = [];
        var juribi = [];

        //試験明細を格納する変数
        var shiken_meisai_id = [];

        jQuery.ajax({
            url: '../../classes/getShutuganJokyo.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getShutuganJokyo = JSON.parse(rtn);
                console.log(getShutuganJokyo);
                var idx = 0;
                $.each(getShutuganJokyo, function (i, val) {
                    shiken_sbt_kbn[idx] = val['shiken_sbt_kbn'];
                    juken_jotai_kbn[idx] = val['juken_jotai_kbn'];
                    kamoku_sentaku_kbn[idx] = val['kamoku_sentaku_kbn'];
                    nonyu_hoho_kbn[idx] = val['nonyu_hoho_kbn'];
                    nonyubi[idx] = val['nonyubi'];
                    uketsukebi[idx] = val['uketsukebi'];
                    juribi[idx] = val['juribi'];

                    shiken_meisai_id[idx] = val['shiken_meisai_id'];

                    //初期表示処理
                    if (juken_jotai_kbn[idx] == 1) {

                        //出願状況確認
                        //IDからテーブルを取得
                        var tableJokyo = document.getElementById("jokyo");

                        //行追加
                        var row = tableJokyo.insertRow(-1);
                        //セル追加
                        var cellJokyo1 = row.insertCell(-1);
                        var cellJokyo2 = row.insertCell(-1);
                        var cellJokyo3 = row.insertCell(-1);
                        var cellJokyo4 = row.insertCell(-1);
                        var cellJokyo5 = row.insertCell(-1);
                        var cellJokyo6 = row.insertCell(-1);

                        cellJokyo6.innerHTML = '<button class="button cancel" type="button" id="cancel" value="' + shiken_meisai_id[idx] + '"><span>受験キャンセル</span></button>';
                        cellJokyo3.innerHTML = uketsukebi[idx].slice(0, 10).split('-').join('/');

                        if ((nonyu_hoho_kbn == 2 || nonyu_hoho_kbn == 4) && nonyubi == "") {
                            cellJokyo4.innerHTML = '<button class="button" type="button" id="payment_num" value="' + shiken_meisai_id[idx] + '"><span>支払番号表示</span></button>';
                        }

                    } else if (juken_jotai_kbn[idx] == 7) {

                        //試験期間延長手続き
                        // IDからテーブルを取得
                        var tableEncho = document.getElementById("encho");
                        //行追加
                        var row = tableEncho.insertRow(-1);
                        //セル追加
                        var cellEncho1 = row.insertCell(-1);
                        var cellEncho2 = row.insertCell(-1);
                        var cellEncho3 = row.insertCell(-1);
                        var cellEncho4 = row.insertCell(-1);
                        var cellEncho5 = row.insertCell(-1);

                        cellEncho4.innerHTML = '<span class="mb_10">左記認定試験の出願を承りました。</span>' +
                            '試験代行会社 PEARSON VUE よりメールが送信されます。メール内容に従って、試験日・試験会場の予約手続きを進めてください。';
                        cellEncho5.innerHTML = '<button class="button kessai" type="button" id="kessai" value="' + shiken_meisai_id[idx] + '"><span>決済</span>';
                        cellEncho3.innerHTML = uketsukebi[idx].slice(0, 10).split('-').join('/');

                    } else {
                        //試験ステータス
                        // IDからテーブルを取得
                        var tableStatus = document.getElementById("status");

                        //行追加
                        var row = tableStatus.insertRow(-1);
                        //セル追加
                        var cellStatus1 = row.insertCell(-1);
                        var cellStatus2 = row.insertCell(-1);
                        var cellStatus3 = row.insertCell(-1);
                        var cellStatus4 = row.insertCell(-1);
                        var cellStatus5 = row.insertCell(-1);

                        cellStatus4.innerHTML = '<span class="mb_10">左記認定試験の出願を承りました。</span>' +
                            'NSCAジャパン受理日より、2～3週間後に、試験代行会社 PEARSON VUE よりメールが送信されます。メール内容に従って、試験日・試験会場の予約手続きを進めてください。<br>' +
                            '<span class="blue">NSCAジャパン受理日:' + juribi[idx].slice(0, 10).split('-').join('/'); +'</span>';

                        cellStatus5.innerHTML = '<button class="button irai" type="button" id="irai" value="' + shiken_meisai_id[idx] + '"><span>延長依頼</span></button>' +
                            '<button class="button cancel" type="button" id="cancel" value="' + shiken_meisai_id[idx] + '"><span>受験キャンセル</span></button>';

                        cellStatus3.innerHTML = uketsukebi[idx].slice(0, 10).split('-').join('/');
                    }

                    /********************************
                    * 会員情報取得
                    ********************************/
                    //区分を格納する配列
                    var cpraed_kakunin_kbn = [];
                    var sotsugyo_shomeisho_kbn = [];
                    jQuery.ajax({
                        url: '../../classes/getTbkaiinJoho.php',
                    }).done((rtn) => {
                        // rtn = 0 の場合は、該当なし
                        if (rtn == 0) {
                            return false;
                        } else {
                            getKaiinJoho = JSON.parse(rtn);
                            console.log(getKaiinJoho);
                            cpraed_kakunin_kbn[0] = val['cpraed_kakunin_kbn'];
                            sotsugyo_shomeisho_kbn[0] = val['sotsugyo_shomeisho_kakunin_kbn'];
                        }
                    }).fail((rtn) => {
                        return false;
                    });

                    /********************************
                    * 名称を取得
                    ********************************/
                    //名称を格納する変数
                    var ShikenSbt = [];
                    var JukenJotai = [];
                    var KamokuSentaku = [];
                    var SotsugyoShomeisho = [];
                    var CPRAED = [];

                    //試験種別
                    jQuery.ajax({
                        url: '../../classes/getShikenSbt.php',
                    }).done((rtn) => {
                        getShikenSbt = JSON.parse(rtn);
                        //取得した区分をもとに名称を検索する
                        $.each(shiken_sbt_kbn, function (i, val) {
                            //データを比較するため一時的に格納
                            var tmp = val[i];       //比較する値
                            var tmpi = i;           //インデックス番号
                            $.each(getShikenSbt, function (i, val) {
                                if (val['meisho_cd'] == tmp) {
                                    ShikenSbt[tmpi] = val['meisho'] + '認定試験';

                                    if (juken_jotai_kbn[i] == 1) {
                                        cellJokyo1.innerHTML = ShikenSbt[tmpi];
                                    } else if (juken_jotai_kbn[i] == 7) {
                                        cellEncho1.innerHTML = ShikenSbt[tmpi];
                                    } else {
                                        cellStatus1.innerHTML = ShikenSbt[tmpi];
                                    }

                                }

                            });
                        });

                    }).fail((rtn) => {
                        return false;
                    });

                    //受験状態
                    jQuery.ajax({
                        url: '../../classes/getJukenJotai.php',
                    }).done((rtn) => {
                        getJukenJotai = JSON.parse(rtn);
                        //取得した区分をもとに名称を検索する
                        $.each(juken_jotai_kbn, function (i, val) {
                            //データを比較するため一時的に格納
                            var tmp = val[i];       //比較する値
                            var tmpi = i;           //インデックス番号
                            $.each(getJukenJotai, function (i, val) {
                                if (val['meisho_cd'] == tmp) {
                                    JukenJotai[tmpi] = val['meisho'];
                                }
                                if (tmp == 1) {
                                    cellJokyo2.innerHTML = JukenJotai[tmpi];
                                    
                                    //科目選択
                                    jQuery.ajax({
                                        url: '../../classes/getKamokuSentaku.php',
                                    }).done((rtn) => {
                                        getKamokuSentaku = JSON.parse(rtn);
                                        //取得した区分をもとに名称を検索する
                                        $.each(kamoku_sentaku_kbn, function (i, val) {
                                            //データを比較するため一時的に格納
                                            var tmp = val[i];       //比較する値
                                            var tmpi = i;           //インデックス番号
                                            $.each(getKamokuSentaku, function (i, val) {
                                                if (val['meisho_cd'] == tmp) {
                                                    KamokuSentaku[tmpi] = val['meisho'];
                                                    cellJokyo5.innerHTML = KamokuSentaku[tmpi] + '<br>';
                                                }
                                            });
                                        });

                                    }).fail((rtn) => {
                                        return false;
                                    });

                                    //卒業証明書
                                    jQuery.ajax({
                                        url: '../../classes/getSotsugyoShomeisho.php',
                                    }).done((rtn) => {
                                        getSotsugyoShomeisho = JSON.parse(rtn);
                                        //取得した区分をもとに名称を検索する
                                        $.each(sotsugyo_shomeisho_kbn, function (i, val) {
                                            //データを比較するため一時的に格納
                                            var tmp = val[i];       //比較する値
                                            var tmpi = i;           //インデックス番号
                                            $.each(getSotsugyoShomeisho, function (i, val) {
                                                if (val['meisho_cd'] == tmp) {
                                                    SotsugyoShomeisho[tmpi] = val['meisho'];
                                                    if (tmp == 1) {
                                                        cellJokyo5.innerHTML = '卒業証明書確認済み<br>';
                                                    }

                                                }

                                            });
                                        });

                                    }).fail((rtn) => {
                                        return false;
                                    });

                                    //CPRAED
                                    jQuery.ajax({
                                        url: '../../classes/getCPRAED.php',
                                    }).done((rtn) => {
                                        getCPRAED = JSON.parse(rtn);
                                        //取得した区分をもとに名称を検索する
                                        $.each(cpraed_kakunin_kbn, function (i, val) {
                                            //データを比較するため一時的に格納
                                            var tmp = val[i];       //比較する値
                                            var tmpi = i;           //インデックス番号
                                            $.each(getCPRAED, function (i, val) {
                                                if (val['meisho_cd'] == tmp) {
                                                    CPRAED[tmpi] = val['meisho'];
                                                    if (tmp == 1) {
                                                        cellJokyo5.innerHTML = 'CPRAED確認済み<br>';
                                                    }

                                                }
                                            });
                                        });

                                    }).fail((rtn) => {
                                        return false;
                                    });
                                } else if (tmp == 7) {
                                    cellEncho2.innerHTML = JukenJotai[tmpi];
                                } else {
                                    cellStatus2.innerHTML = JukenJotai[tmpi];
                                }

                            });
                        });

                    }).fail((rtn) => {
                        return false;
                    });

                    idx = idx + 1;
                });
            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
       * 受験キャンセルボタン押下時
       ********************************/
        $(document).on("click", "#cancel", function () {

            //試験明細IDをhiddenタグにセット
            $('#shiken_meisai_id').val($(this).val());
            url = '../../entryCancel/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 延長依頼ボタン押下時
        ********************************/
        $(document).on("click", "#irai", function () {

            //試験明細IDをhiddenタグにセット
            $('#shiken_meisai_id').val($(this).val());
            url = '../../extensionApplication/';
            $('form').attr('action', url);
            $('form').submit();

        });

        /********************************
        * 支払番号ボタン押下時
        ********************************/
        $(document).on("click", "#payment_num", function () {

            //試験明細IDをhiddenタグにセット
            $('#shiken_meisai_id').val($(this).val());
            url = '../../paymentNumber/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 決済ボタン押下時
        ********************************/
        $(document).on("click", "#kessai", function () {

            //試験明細IDをhiddenタグにセット
            $('#shiken_meisai_id').val($(this).val());
            url = '../../unpaidConfirm/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });
})(jQuery);
