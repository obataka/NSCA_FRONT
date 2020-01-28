(function ($) {
    $(document).ready(function () {

        /********************************
        * 試験情報明細取得
        ********************************/
        //区分を格納する変数
        // var shiken_sbt_kbn = [];
        // var juken_jotai_kbn = [];
        // var kamoku_sentaku_kbn = [];
        // var uketsukebi = [];
        // var juribi = [];

        var shiken_sbt_kbn = "";
        var juken_jotai_kbn = "";
        var kamoku_sentaku_kbn = "";
        var nonyu_hoho_kbn = "";
        var nonyubi = "";
        var uketsukebi = "";
        var juribi = "";

        jQuery.ajax({
            url: '../../classes/getShutuganJokyo.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getShutuganJokyo = JSON.parse(rtn);
                console.log(getShutuganJokyo);
                shiken_sbt_kbn = getShutuganJokyo['shiken_sbt_kbn'];
                juken_jotai_kbn = getShutuganJokyo['juken_jotai_kbn'];
                kamoku_sentaku_kbn = getShutuganJokyo['kamoku_sentaku_kbn'];
                nonyu_hoho_kbn = getShutuganJokyo['nonyu_hoho_kbn'];
                nonyubi = getShutuganJokyo['nonyubi'];
                uketsukebi = getShutuganJokyo['uketsukebi'];
                juribi = getShutuganJokyo['juribi'];

                //受付日を表示する
                if (juken_jotai_kbn == 1) {
                    cellJokyo3.innerHTML = uketsukebi.slice(0, 10);
                } else if (juken_jotai_kbn == 7) {
                    cellEncho3.innerHTML = uketsukebi.slice(0, 10);
                } else {
                    cellStatus3.innerHTML = uketsukebi.slice(0, 10);
                }

            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 会員情報取得
        ********************************/
        //区分を格納する配列
        var CPRAED_kakunin_kbn = "";
        var sotsugyo_shomeisho_kbn = "";
        jQuery.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getKaiinJoho = JSON.parse(rtn);
                console.log(getKaiinJoho);
                CPRAED_kakunin_kbn = getKaiinJoho['cpraed_kakunin_kbn'];
                sotsugyo_shomeisho_kbn = getKaiinJoho['sotsugyo_shomeisho_kakunin_kbn'];

            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 名称を取得
        ********************************/
        //名称を格納する変数
        var ShikenSbt = "";
        var JukenJotai = "";
        var KamokuSentaku = "";
        var NonyuHoho = "";
        var SotsugyoShomeisho = "";
        var CPRAED = "";

        //試験種別
        jQuery.ajax({
            url: '../../classes/getShikenSbt.php',
        }).done((rtn) => {
            getShikenSbt = JSON.parse(rtn);
            $.each(getShikenSbt, function (i, val) {
                if (val['meisho_cd'] == shiken_sbt_kbn) {
                    ShikenSbt = val['meisho'] + '認定試験';
                }
                cellJokyo1.innerHTML = ShikenSbt;
                cellStatus1.innerHTML = ShikenSbt;
                cellEncho1.innerHTML = ShikenSbt;
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
            $.each(getJukenJotai, function (i, val) {
                if (val['meisho_cd'] == juken_jotai_kbn) {
                    JukenJotai = val['meisho'];
                }
                if (juken_jotai_kbn == 1) {
                    cellJokyo2.innerHTML = JukenJotai;
                } else if (juken_jotai_kbn == 7) {
                    cellEncho2.innerHTML = JukenJotai;
                } else {
                    cellStatus2.innerHTML = JukenJotai;
                }

                //状況が空白の場合追加したテーブルを削除する
                if (cellJokyo2.innerHTML == "") {
                    idx = tableJokyo.rows.length - 1;
                    tableJokyo.deleteRow(idx);
                }
                if (cellStatus2.innerHTML == "") {
                    idx = tableStatus.rows.length - 1;
                    tableStatus.deleteRow(idx);
                }
                if (cellEncho2.innerHTML == "") {
                    idx = tableEncho.rows.length - 1;
                    tableEncho.deleteRow(idx);
                }

            });
        }).fail((rtn) => {
            return false;
        });

        //科目選択
        jQuery.ajax({
            url: '../../classes/getKamokuSentaku.php',
        }).done((rtn) => {
            getKamokuSentaku = JSON.parse(rtn);
            //取得した区分をもとに名称を検索する
            $.each(getKamokuSentaku, function (i, val) {
                if (val['meisho_cd'] == kamoku_sentaku_kbn) {
                    KamokuSentaku = val['meisho'];
                    cellJokyo5.innerHTML = KamokuSentaku + '<br>';
                }
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
            $.each(getSotsugyoShomeisho, function (i, val) {
                if (val['meisho_cd'] == sotsugyo_shomeisho_kbn) {
                    SotsugyoShomeisho = val['meisho'];
                    cellJokyo5.innerHTML = SotsugyoShomeisho + '<br>';
                }

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
            $.each(getCPRAED, function (i, val) {
                if (val['meisho_cd'] == CPRAED_kakunin_kbn) {
                    CPRAED = val['meisho'];
                    cellJokyo5.innerHTML = CPRAED + '<br>';
                }
            });
        }).fail((rtn) => {
            return false;
        });

        //納入方法
        jQuery.ajax({
            url: '../../classes/getNonyuHoho.php',
        }).done((rtn) => {
            getNonyuHoho = JSON.parse(rtn);
            //取得した区分をもとに名称を検索する
            $.each(NonyuHoho, function (i, val) {
                if (val['meisho_cd'] == nonyu_hoho_kbn) {
                    NonyuHoho = val['meisho'];
                    if ((NonyuHoho == 2 || NonyuHoho == 4) && nonyubi == "") {
                        cellJokyo4.innerHTML = '<button class="button" type="button" value="" onclick="location.href=\'#\'"><span>支払番号表示</span></button>';
                    }
                }
            });
        }).fail((rtn) => {
            return false;
        });


        /******************************
       * 初期表示処理
       ********************************/
        //出願状況確認
        // IDからテーブルを取得
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

        cellJokyo6.innerHTML = '<button class="button cancel" type="button" id="cancel" value="" onclick="location.href=\'#\'"><span>受験キャンセル</span></button>';

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
            '<span class="blue">NSCAジャパン受理日:' + juribi.slice(0, 10); +'</span>';

        cellStatus5.innerHTML = '<button class="button irai" type="button" id="irai" value="" onclick="location.href=\'#\'"><span>延長依頼</span></button>' +
            '<button class="button cancel" type="button" id="cancel" value="" onclick="location.href=\'#\'"><span>受験キャンセル</span></button>';
        
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
        cellEncho5.innerHTML = '<button class="button kessai" type="button" id="kessai" value="" onclick="location.href=\'#\'"><span>決済</span>';

        /********************************
       * 受験キャンセルボタン押下時
       ********************************/
        $(document).on("click", "#cancel", function () {
            location.href = '../entryCancel/';
        });

        /********************************
        * 延長依頼ボタン押下時
        ********************************/
        $(document).on("click", "#irai", function () {
            location.href = '../entryCancel/';
        });

        /********************************
        * 支払番号ボタン押下時
        ********************************/
        $(document).on("click", "#payment_num", function () {
            location.href = '../entryCancel/';
        });
        /********************************
        * 決済ボタン押下時
        ********************************/
        $(document).on("click", "#kessai", function () {
            location.href = '../entryCancel/';
        });

    });
})(jQuery);
