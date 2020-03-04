(function ($) {
    $(document).ready(function () {

        //合計金額
        var gokei = 0;

        var getCmControl = "";
        var getSalesCartList = "";

        /********************
         * TB販売購入者情報から買い物かごの内容を表示する(会員のみ)
         ********************/
        jQuery.ajax({
            url: '../../classes/getSalesCartList.php',
        }).done((rtn) => {
            getSalesCartList = JSON.parse(rtn);
            console.log(getSalesCartList);

            /********************
            * CMコントロール情報を取得する
            ********************/
            jQuery.ajax({
                url: '../../classes/getCmControl.php',
            }).done((rtn) => {
                getCmControl = JSON.parse(rtn);
                $('#tesuryo').text(Math.floor(getCmControl['buppan_soyo']) + '円');

                $.each(getSalesCartList, function (i, val) {
                    $('#product').append(`<div id="product_` + i + `">
                        <p class="product_title">` + val['hambai_title'] + `</p>
                        <section>
                            <p class="product_img"><img src="` + val['gazo_url'] + `"><button class="button delete" type="button" value="` + i + `"><span>削除</span></button></p>
                            <table>
                                <tr>
                                    <th>税込み単価(円)<span>：</span></th>
                                    <td>` + Math.floor(val['zeikomi_kakaku']) + `円</td>
                                </tr>
                                <tr>
                                    <th>数量<span>：</span></th>
                                    <td><input id="number_` + i + `" type="number" name="number" value="` + val['suryo'] + `" min="0"></td>
                                </tr>
                                <tr>
                                    <th>小計(円)<span>：</span></th>
                                    <td id="shokei_` + i + `">` + Math.floor(val['zeikomi_kakaku']) * val['suryo'] + `円</td>
                                </tr>
                            </table>
                        </section>
                    </div>`);

                    gokei = gokei + Math.floor(val['zeikomi_kakaku']) * val['suryo'];
                });

                $('#hambai_joho').val(getSalesCartList);
                $('#sum').text(gokei + Math.floor(getCmControl['buppan_soyo']) + '円');
                $('#gokei_kingaku').val(gokei + Math.floor(getCmControl['buppan_soyo']));

                //買い物かごが空なら、買い物を確定ボタンを無効化する
                if (!($('#product').length)) {
                    $('#next').prop('disabled', true);
                }
            }).fail((rtn) => {
                return false;
            });

        }).fail((rtn) => {
            return false;
        });

        //削除ボタンクリック時処理
        $(document).on('click', '.delete', function () {
            val = $(this).val();
            //DBからも削除する
            jQuery.ajax({
                url: '../../classes/deleteSalesCartData.php',
                type: 'POST',
                data: {
                    konyu_id: getSalesCartList[val]['konyu_id'],
                    hambai_id: getSalesCartList[val]['hambai_id'],
                    size_kbn: getSalesCartList[val]['size_kbn'],
                    color_kbn: getSalesCartList[val]['color_kbn'],
                    buppan_soyo: getCmControl['buppan_soyo'],
                    user_id: 'chisato',
                }
            }).done((rtn) => {
                if (rtn == 1) {
                    console.log(1);

                    $('#product_' + val).remove();

                    //配列からも削除する
                    getSalesCartList.splice(val, 1);
                    console.log(getSalesCartList);
                } else {
                    console.log(0);
                    return false
                }
            }).fail((rtn) => {
                console.log(0);
                return false;
            });
        });

        //かごの中を空にするボタンクリック時処理
        $('#reset').click(function () {
            var flg = 1;
            $.each(getSalesCartList, function (i, val) {
                //DBからも削除する
                jQuery.ajax({
                    url: '../../classes/deleteAllSalesCartData.php',
                    type: 'POST',
                    data: {
                        konyu_id: val['konyu_id'],
                        user_id: 'chisato',
                    }
                }).done((rtn) => {
                    if (rtn == 0) {
                        console.log(0);
                        flg = 0;
                        return false;
                    }
                }).fail((rtn) => {
                    flg = 0;
                    return false;
                });
            });

            if (flg == 1) {
                console.log(1);

                $('#product').remove();
                getSalesCartList = [];
                gokei = 0;
                $('#sum').text((gokei + Math.floor(getCmControl['buppan_soyo'])) + '円');

                //買い物かごが空なら、買い物を確定ボタンを無効化する
                $('#next').prop('disabled', true);
            } else {
                console.log(0);
                return false;
            }
        });

        //再計算クリック時処理
        $('#keisan').click(function () {
            sai_sum = 0;
            $.each(getSalesCartList, function (i, val) {
                shokei_sai = Math.floor(val['zeikomi_kakaku']) * $('#number_' + i).val();
                $('#shokei_' + i).text(shokei_sai + '円');
                sai_sum = sai_sum + shokei_sai;

            });
            $('#sum').text(sai_sum + Math.floor(getCmControl['buppan_soyo']) + '円');
            $('#gokei_kingaku').val(sai_sum + Math.floor(getCmControl['buppan_soyo']));

            $.each(getSalesCartList, function (i, val) {
                konyu_id = konyu_id + val['konyu_id'] + ',';
                $('#konyu_id').val(konyu_id);

                hambai_id = hambai_id + val['hambai_id'] + ',';
                $('#hambai_id').val(hambai_id);

                // 販売設定区分が販売中以外なら購入数を0
                if (val['hambai_settei_kbn'] == 1) {
                    konyusu = konyusu + $('#number_' + i).val() + ',';
                    $('#konyusu').val(konyusu);
                } else {
                    konyusu = konyusu + 0 + ',';
                    $('#konyusu').val(konyusu);
                }
                color_meisho = color_meisho + val['color_meisho'] + ',';
                $('#color_meisho').val(color_meisho);

                size_meisho = size_meisho + val['size_meisho'] + ',';
                $('#size_meisho').val(size_meisho);
            });


            //DB更新
            jQuery.ajax({
                url: '../../classes/updateAllSalesCartData.php',
                type: 'POST',
                data: {
                    konyu_id: $('#konyu_id').val(),
                    hambai_id: $('#hambai_id').val(),
                    user_id: 'chisato',
                    konyusu: $('#konyusu').val(),
                    size_kbn: $('#size_kbn').val(),
                    color_kbn: $('#color_kbn').val(),
                    buppan_soyo: getCmControl['buppan_soyo'],
                    idx: getSalesCartList.length,
                }
            }).done((rtn) => {
                if (rtn == 1) {
                    console.log(1);
                } else {
                    console.log(0);
                    return false;
                }

            }).fail((rtn) => {
                return false;
            });

        });

        //他の商品を見るクリック時処理
        $('#back').click(function () {
            //セッションに値をセットして画面遷移する
            $.each(getSalesCartList, function (i, val) {
                konyu_id = konyu_id + val['konyu_id'] + ',';
                $('#konyu_id').val(konyu_id);

                hambai_id = hambai_id + val['hambai_id'] + ',';
                $('#hambai_id').val(hambai_id);

                hambai_title = hambai_title + val['hambai_title'] + ',';
                $('#hambai_title').val(hambai_title);

                hambai_title_chuigaki = hambai_title_chuigaki + val['hambai_title_chuigaki'] + ',';
                $('#hambai_title_chuigaki').val(hambai_title_chuigaki);

                gazo_url = gazo_url + val['gazo_url'] + ',';
                $('#gazo_url').val(gazo_url);

                kaiin_kakaku = kaiin_kakaku + val['kaiin_kakaku'] + ',';
                $('#kaiin_kakaku').val(kaiin_kakaku);

                kaiin_zeikomi_kakaku = kaiin_zeikomi_kakaku + val['kaiin_zeikomi_kakaku'] + ',';
                $('#kaiin_zeikomi_kakaku').val(kaiin_zeikomi_kakaku);

                ippan_kakaku = ippan_kakaku + val['ippan_kakaku'] + ',';
                $('#ippan_kakaku').val(ippan_kakaku);

                ippan_zeikomi_kakaku = ippan_zeikomi_kakaku + val['ippan_zeikomi_kakaku'] + ',';
                $('#ippan_zeikomi_kakaku').val(ippan_zeikomi_kakaku);

                gaiyo = gaiyo + val['gaiyo'] + ',';
                $('#gaiyo').val(gaiyo);

                hambai_kbn = hambai_kbn + val['hambai_kbn'] + ',';
                $('#hambai_kbn').val(hambai_kbn);

                hambai_settei_kbn = hambai_settei_kbn + val['hambai_settei_kbn'] + ',';
                $('#hambai_settei_kbn').val(hambai_settei_kbn);

                hambai_settei_meisho = hambai_settei_meisho + val['hambai_settei_meisho'] + ',';
                $('#hambai_settei_meisho').val(hambai_settei_meisho);

                setsumei = setsumei + val['setsumei'] + ',';
                $('#setsumei').val(setsumei);

                kakaku = kakaku + val['kakaku'] + ',';
                $('#kakaku').val(kakaku);

                // 販売設定区分が販売中以外なら購入数を0
                if (val['hambai_settei_kbn'] == 1) {
                    konyusu = konyusu + $('#number_' + i).val() + ',';
                    $('#konyusu').val(konyusu);
                } else {
                    konyusu = konyusu + 0 + ', ';
                    $('#konyusu').val(konyusu);
                }

                zeikomi_kakaku = zeikomi_kakaku + val['zeikomi_kakaku'] + ',';
                $('#zeikomi_kakaku').val(zeikomi_kakaku);

                color_kbn = color_kbn + val['color_kbn'] + ',';
                $('#color_kbn').val(color_kbn);

                color_meisho = color_meisho + val['color_meisho'] + ',';
                $('#color_meisho').val(color_meisho);

                size_kbn = size_kbn + val['size_kbn'] + ',';
                $('#size_kbn').val(size_kbn);

                size_meisho = size_meisho + val['size_meisho'] + ',';
                $('#size_meisho').val(size_meisho);

                shikaku_kbn = shikaku_kbn + val['shikaku_kbn'] + ',';
                $('#shikaku_kbn').val(shikaku_kbn);

            });

            //DB更新
            jQuery.ajax({
                url: '../../classes/updateAllSalesCartData.php',
                type: 'POST',
                data: {
                    konyu_id: $('#konyu_id').val(),
                    hambai_id: $('#hambai_id').val(),
                    user_id: 'chisato',
                    konyusu: $('#konyusu').val(),
                    size_kbn: $('#size_kbn').val(),
                    color_kbn: $('#color_kbn').val(),
                    buppan_soyo: getCmControl['buppan_soyo'],
                    idx: getSalesCartList.length,
                }
            }).done((rtn) => {
                if (rtn == 1) {
                    console.log(1);
                    url = '../salesList/';
                    $('form').attr('action', url);
                    $('form').submit();
                } else {
                    console.log(0);
                    return false;
                }

            }).fail((rtn) => {
                return false;
            });



        });

        //買い物を確定ボタンクリック時処理
        $('#next').click(function () {
            //セッションに値をセットして画面遷移する
            $.each(getSalesCartList, function (i, val) {
                konyu_id = konyu_id + val['konyu_id'] + ',';
                $('#konyu_id').val(konyu_id);

                hambai_id = hambai_id + val['hambai_id'] + ',';
                $('#hambai_id').val(hambai_id);

                hambai_title = hambai_title + val['hambai_title'] + ',';
                $('#hambai_title').val(hambai_title);

                hambai_title_chuigaki = hambai_title_chuigaki + val['hambai_title_chuigaki'] + ',';
                $('#hambai_title_chuigaki').val(hambai_title_chuigaki);

                gazo_url = gazo_url + val['gazo_url'] + ',';
                $('#gazo_url').val(gazo_url);

                kaiin_kakaku = kaiin_kakaku + val['kaiin_kakaku'] + ',';
                $('#kaiin_kakaku').val(kaiin_kakaku);

                kaiin_zeikomi_kakaku = kaiin_zeikomi_kakaku + val['kaiin_zeikomi_kakaku'] + ',';
                $('#kaiin_zeikomi_kakaku').val(kaiin_zeikomi_kakaku);

                ippan_kakaku = ippan_kakaku + val['ippan_kakaku'] + ',';
                $('#ippan_kakaku').val(ippan_kakaku);

                ippan_zeikomi_kakaku = ippan_zeikomi_kakaku + val['ippan_zeikomi_kakaku'] + ',';
                $('#ippan_zeikomi_kakaku').val(ippan_zeikomi_kakaku);

                gaiyo = gaiyo + val['gaiyo'] + ',';
                $('#gaiyo').val(gaiyo);

                hambai_kbn = hambai_kbn + val['hambai_kbn'] + ',';
                $('#hambai_kbn').val(hambai_kbn);

                hambai_settei_kbn = hambai_settei_kbn + val['hambai_settei_kbn'] + ',';
                $('#hambai_settei_kbn').val(hambai_settei_kbn);

                hambai_settei_meisho = hambai_settei_meisho + val['hambai_settei_meisho'] + ',';
                $('#hambai_settei_meisho').val(hambai_settei_meisho);

                setsumei = setsumei + val['setsumei'] + ',';
                $('#setsumei').val(setsumei);

                kakaku = kakaku + val['kakaku'] + ',';
                $('#kakaku').val(kakaku);

                // 販売設定区分が販売中以外なら購入数を0
                if (val['hambai_settei_kbn'] == 1) {
                    konyusu = konyusu + $('#number_' + i).val() + ',';
                    $('#konyusu').val(konyusu);
                } else {
                    konyusu = konyusu + 0 + ', ';
                    $('#konyusu').val(konyusu);
                }

                zeikomi_kakaku = zeikomi_kakaku + val['zeikomi_kakaku'] + ',';
                $('#zeikomi_kakaku').val(zeikomi_kakaku);

                color_kbn = color_kbn + val['color_kbn'] + ',';
                $('#color_kbn').val(color_kbn);

                color_meisho = color_meisho + val['color_meisho'] + ',';
                $('#color_meisho').val(color_meisho);

                size_kbn = size_kbn + val['size_kbn'] + ',';
                $('#size_kbn').val(size_kbn);

                size_meisho = size_meisho + val['size_meisho'] + ',';
                $('#size_meisho').val(size_meisho);

                shikaku_kbn = shikaku_kbn + val['shikaku_kbn'] + ',';
                $('#shikaku_kbn').val(shikaku_kbn);

            });

            //DB更新
            jQuery.ajax({
                url: '../../classes/updateAllSalesCartData.php',
                type: 'POST',
                data: {
                    konyu_id: $('#konyu_id').val(),
                    hambai_id: $('#hambai_id').val(),
                    user_id: 'chisato',
                    konyusu: $('#konyusu').val(),
                    size_kbn: $('#size_kbn').val(),
                    color_kbn: $('#color_kbn').val(),
                    buppan_soyo: getCmControl['buppan_soyo'],
                    idx: getSalesCartList.length,
                }
            }).done((rtn) => {
                if (rtn == 1) {
                    console.log(1);
                    url = '../shoppingConfirm/';
                    $('form').attr('action', url);
                    $('form').submit();
                } else {
                    console.log(0);
                    return false;
                }
            }).fail((rtn) => {
                return false;
            });

        });

    });
})(jQuery);