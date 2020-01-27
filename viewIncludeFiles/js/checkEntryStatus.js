(function ($) {
    $(document).ready(function () {
        /********************************
        * 試験情報明細取得
        ********************************/
        //区分を格納する配列
        var shiken_sbt_kbn = [];
        var juken_jotai_kbn = [];
        var kamoku_sentaku_kbn = [];
        var uketsukebi = [];
        var juribi = [];
        jQuery.ajax({
            url: '../../classes/getShutuganJokyo.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getShutuganJokyo = JSON.parse(rtn);
                $.each(getShutuganJokyo, function (i, val) {
                    shiken_sbt_kbn.push(val['shiken_sbt_kbn']);
                    juken_jotai_kbn.push(val['juken_jotai_kbn']);
                    kamoku_sentaku_kbn.push(val['kamoku_sentaku_kbn']);
                    uketsukebi.push(val['uketsukebi']);
                    juribi.push(val['juribi']);
                });

            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 会員情報取得
        ********************************/
        //区分を格納する配列
        var CPRAED_kakunin_kbn = [];
        var sotsugyo_shomeisho_kbn = [];
        jQuery.ajax({
            url: '../../classes/getTbkaiinJoho.php',
        }).done((rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {
                return false;
            } else {
                getKaiinJoho = JSON.parse(rtn);
                $.each(getKaiinJoho, function (i, val) {
                    CPRAED_kakunin_kbn.push(val['cpraed_kakunin_kbn']);
                    sotsugyo_shomeisho_kbn.push(val['sotsugyo_shomeisho_kakunin_kbn']);
                });
            }
        }).fail((rtn) => {
            return false;
        });

        /********************************
        * 名称を取得
        ********************************/
        //名称を格納する配列
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
            console.log(getShikenSbt);

            $.each(shiken_sbt_kbn, function (i) {
                var temp = $(this); //データを比較するため一時的に格納
                $.each(getShikenSbt, function (i, val) {
                    if (val['meisho_cd'] == temp) {
                        ShikenSbt.push(val['meisho']);
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
            console.log(getJukenJotai);

            $.each(juken_jotai_kbn, function (i) {
                var temp = $(this); //データを比較するため一時的に格納
                $.each(getJukenJotai, function (i, val) {
                    if (val['meisho_cd'] == temp) {
                        JukenJotai.push(val['meisho']);
                    }
                });
            });
        }).fail((rtn) => {
            return false;
        });

        //科目選択
        jQuery.ajax({
            url: '../../classes/getKamokuSentaku.php',
        }).done((rtn) => {
            getKamokuSentaku = JSON.parse(rtn);
            console.log(getKamokuSentaku);

            $.each(kamoku_sentaku_kbn, function (i) {
                var temp = $(this); //データを比較するため一時的に格納
                $.each(getKamokuSentaku, function (i, val) {
                    if (val['meisho_cd'] == temp) {
                        KamokuSentaku.push(val['meisho']);
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
            console.log(getSotsugyoShomeisho);

            $.each(sotsugyo_shomeisho_kbn, function (i) {
                var temp = $(this); //データを比較するため一時的に格納
                $.each(getSotsugyoShomeisho, function (i, val) {
                    if (val['meisho_cd'] == temp) {
                        SotsugyoShomeisho.push(val['meisho']);
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
            console.log(getCPRAED);

            $.each(CPRAED_kakunin_kbn, function (i) {
                var temp = $(this); //データを比較するため一時的に格納
                $.each(getCPRAED, function (i, val) {
                    if (val['meisho_cd'] == temp) {
                        CPRAED.push(val['meisho']);
                    }
                });
            });
        }).fail((rtn) => {
            return false;
        });

        /*******************************
       * 初期表示処理
       ********************************/
        //出願状況確認
        var jokyo = [];
        jokyo.push(ShikenSbt, JukenJotai, uketsukebi, CPRAED, SotsugyoShomeisho);
        // $.each(jokyo, function (i, val) {
        //     $('#jokyo').append('<tr>' +
        //         '<td data-label="試験名">' + val[0][0] + '</td>' +
        //         '<td data-label="状況">' + val[1][0] + '</td>' +
        //         '<td data-label="受付日">' + val[2][0] + '</td>' +
        //         '<td data-label="支払">' + val[3][0] + '</td>' +
        //         '<td data-label="確認事項">' + val[4][0] + '</td>' +
        //         '<td data-label="手続き">' + val[5][0] + '</td>' +
        //         '</tr>');
        // });

        //試験ステータス
        //試験期間延長手続き

        /********************************
       * 受験キャンセルボタン押下時
       ********************************/
        $("#cancel").click(function () {
            url = '../entryCancel/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************************
        * 延長依頼ボタン押下時
        ********************************/
        $("#irai").click(function () {
            url = '../entryCancel/';
            $('form').attr('action', url);
            $('form').submit();
        });

    });
})(jQuery);
