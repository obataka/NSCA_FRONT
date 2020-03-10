(function ($) {
    $(document).ready(function () {

        //合計金額
        var gokei = 0;

        var getCmControl = [];
        var getSalesCartList = [];

        //セッションの値を入れる配列
        var sesSalesCartList = [];

        if ($('#kaiin_no').val()) {
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
                        sesSalesCartList.push(getSalesCartList[i]);
                    });

                    $.each(sesSalesCartList, function (i, val) {
                        $('#product').append(`<div id="product_` + i + `">
                        <p class="product_title">` + val['hambai_title'] + `</p>
                        <section>
                            <p class="product_img"><img src="` + val['gazo_url'] + `"><button class="button delete" type="button" value="` + i + `"><span>削除</span></button></p>
                            <table>
                                <tr>
                                    <th>税込み単価(円)<span>：</span></th>
                                    <td>` + Math.floor(val['kaiin_zeikomi_kakaku']) + `円</td>
                                </tr>
                                <tr>
                                    <th>数量<span>：</span></th>
                                    <td><input id="number_` + i + `" type="number" name="number" value="` + val['suryo'] + `" min="0"></td>
                                </tr>
                                <tr>
                                    <th>小計(円)<span>：</span></th>
                                    <td id="shokei_` + i + `">` + Math.floor(val['kaiin_zeikomi_kakaku']) * val['suryo'] + `円</td>
                                </tr>
                            </table>
                        </section>
                    </div>`);

                        gokei = gokei + Math.floor(val['kaiin_zeikomi_kakaku']) * val['suryo'];
                    });

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
        } else {
            /********************
            * CMコントロール情報を取得する
            ********************/
            jQuery.ajax({
                url: '../../classes/getCmControl.php',
            }).done((rtn) => {
                //表示する商品が複数ある場合
                getCmControl = JSON.parse(rtn);
                $('#tesuryo').text(Math.floor(getCmControl['buppan_soyo']) + '円');

                if ($('#wk_hambai_id').val().split(',').length - 1 > 1) {
                    var wk_hambai_id = $('#wk_hambai_id').val().split(',');
                    var wk_hambai_title = $('#hambai_title').val().split(',');
                    var wk_hambai_title_chuigaki = $('#hambai_title_chuigaki').val().split(',');
                    var wk_hambai_kbn = $('#hambai_kbn').val().split(',');
                    var wk_gaiyo = $('#wk_gaiyo').val().split(',');
                    var wk_gazo_url = $('#gazo_url').val().split(',');
                    var wk_kaiin_zeikomi_kakaku = $('#kaiin_zeikomi_kakaku').val().split(',');
                    var wk_zeikomi_kakaku = $('#zeikomi_kakaku').val().split(',');
                    var wk_ippan_zeikomi_kakaku = $('#ippan_zeikomi_kakaku').val().split(',');
                    var wk_suryo = $('#konyusu').val().split(',');

                    //重複している要素があればなくす
                    wk_hambai_id = wk_hambai_id.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_hambai_title = wk_hambai_title.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_hambai_title_chuigaki = wk_hambai_title_chuigaki.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_hambai_kbn = wk_hambai_kbn.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_gaiyo = wk_gaiyo.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_gazo_url = wk_gazo_url.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_kaiin_zeikomi_kakaku = wk_kaiin_zeikomi_kakaku.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_zeikomi_kakaku = wk_zeikomi_kakaku.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_ippan_zeikomi_kakaku = wk_ippan_zeikomi_kakaku.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });

                    wk_suryo = wk_suryo.filter(function (x, i, self) {
                        return self.indexOf(x) === i;
                    });


                    for (let i = 0; i < wk_hambai_id.length - 1; i++) {
                        sesSalesCartListRow = {
                            'hambai_id': wk_hambai_id[i],
                            'hambai_title': wk_hambai_title[i],
                            'hambai_title_chuigaki': wk_hambai_title_chuigaki[i],
                            'hambai_kbn': wk_hambai_kbn[i],
                            'gaiyo': wk_gaiyo[i],
                            'gazo_url': wk_gazo_url[i],
                            'kaiin_zeikomi_kakaku': wk_kaiin_zeikomi_kakaku[i],
                            'zeikomi_kakaku': wk_zeikomi_kakaku[i],
                            'ippan_zeikomi_kakaku': wk_ippan_zeikomi_kakaku[i],
                            'suryo': wk_suryo[i],

                        };
                        sesSalesCartList.push(sesSalesCartListRow);
                    }

                    console.log(sesSalesCartList);

                    $.each(sesSalesCartList, function (i, val) {

                        $('#product').append(`<div id="product_` + i + `">
                                <p class="product_title">` + val['hambai_title'] + `</p>
                                <section>
                                    <p class="product_img"><img src="` + val['gazo_url'] + `"><button class="button delete" type="button" value="` + i + `"><span>削除</span></button></p>
                                    <table>
                                        <tr>
                                            <th>税込み単価(円)<span>：</span></th>
                                            <td>` + Math.floor(val['ippan_zeikomi_kakaku']) + `円</td>
                                        </tr>
                                        <tr>
                                            <th>数量<span>：</span></th>
                                            <td><input id="number_` + i + `" type="number" name="number" value="` + val['suryo'] + `" min="0"></td>
                                        </tr>
                                        <tr>
                                            <th>小計(円)<span>：</span></th>
                                            <td id="shokei_` + i + `">` + Math.floor(val['ippan_zeikomi_kakaku']) * val['suryo'] + `円</td>
                                        </tr>
                                    </table>
                                </section>
                            </div>`);
                        gokei = gokei + Math.floor(val['ippan_zeikomi_kakaku']) * val['suryo'];

                    });
                    $('#sum').text(gokei + Math.floor(getCmControl['buppan_soyo']) + '円');
                    $('#gokei_kingaku').val(gokei + Math.floor(getCmControl['buppan_soyo']));
                    return false;

                } else {
                    //表示する商品が1種類のみの場合
                    var wk_hambai_id = $('#wk_hambai_id').val().split(',');
                    var wk_hambai_title = $('#hambai_title').val().split(',');
                    var wk_hambai_title_chuigaki = $('#hambai_title_chuigaki').val().split(',');
                    var wk_hambai_kbn = $('#hambai_kbn').val().split(',');
                    var wk_gaiyo = $('#wk_gaiyo').val().split(',');
                    var wk_gazo_url = $('#gazo_url').val().split(',');
                    var wk_kaiin_zeikomi_kakaku = $('#kaiin_zeikomi_kakaku').val().split(',');
                    var wk_zeikomi_kakaku = $('#zeikomi_kakaku').val().split(',');
                    var wk_ippan_zeikomi_kakaku = $('#ippan_zeikomi_kakaku').val().split(',');
                    var wk_suryo = $('#konyusu').val().split(',');

                    sesSalesCartListRow = {
                        'hambai_id': wk_hambai_id[0],
                        'hambai_title': wk_hambai_title[0],
                        'hambai_title_chuigaki': wk_hambai_title_chuigaki[0],
                        'hambai_kbn': wk_hambai_kbn[0],
                        'gaiyo': wk_gaiyo[0],
                        'gazo_url': wk_gazo_url[0],
                        'kaiin_zeikomi_kakaku': wk_kaiin_zeikomi_kakaku[0],
                        'zeikomi_kakaku': wk_zeikomi_kakaku[0],
                        'ippan_zeikomi_kakaku': wk_ippan_zeikomi_kakaku[0],
                        'suryo': wk_suryo[0],

                    };
                    sesSalesCartList = [
                        sesSalesCartListRow
                    ];

                    console.log(sesSalesCartList);
                }

                $.each(sesSalesCartList, function (i, val) {
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

                $('#sum').text(gokei + Math.floor(getCmControl['buppan_soyo']) + '円');
                $('#gokei_kingaku').val(gokei + Math.floor(getCmControl['buppan_soyo']));

                //買い物かごが空なら、買い物を確定ボタンを無効化する
                if (!($('#product').length)) {
                    $('#next').prop('disabled', true);
                }


            }).fail((rtn) => {
                return false;
            });

        }


        //削除ボタンクリック時処理
        $(document).on('click', '.delete', function () {
            val = $(this).val();
            if ($('#kaiin_no').val() != '') {
                //DBからも削除する
                jQuery.ajax({
                    url: '../../classes/deleteSalesCartData.php',
                    type: 'POST',
                    data: {
                        konyu_id: sesSalesCartList[val]['konyu_id'],
                        hambai_id: sesSalesCartList[val]['hambai_id'],
                        size_kbn: sesSalesCartList[val]['size_kbn'],
                        color_kbn: sesSalesCartList[val]['color_kbn'],
                        buppan_soyo: sesCmControl['buppan_soyo'],
                        user_id: 'chisato',
                    }
                }).done((rtn) => {
                    if (rtn == 1) {
                        console.log(1);

                        $('#product_' + val).remove();

                        //配列からも削除する
                        sesSalesCartList.splice(val, 1);
                        console.log(sesSalesCartList);
                    } else {
                        console.log(0);
                        return false
                    }
                }).fail((rtn) => {
                    console.log(011);
                    return false;
                });
            } else {
                val = $(this).val();
                $('#product_' + val).remove();
                //配列からも削除する
                sesSalesCartList.splice(val, 1);
            }
        });

        //かごの中を空にするボタンクリック時処理
        $('#reset').click(function () {
            if ($('#kaiin_no').val()) {
                var flg = 1;

                //重複をなくした購入IDの配列を作る
                var konyu_id = [];
                $.each(sesSalesCartList, function (i, val) {
                    konyu_id.push(val['konyu_id']);
                });

                var wk_konyu_id = konyu_id.filter(function (x, i, self) {
                    return self.indexOf(x) === i;
                });
                $.each(wk_konyu_id, function (i, val) {
                    //DBからも削除する
                    jQuery.ajax({
                        url: '../../classes/deleteAllSalesCartData.php',
                        type: 'POST',
                        data: {
                            konyu_id: val[i],
                            user_id: 'chisato',
                        }
                    }).done((rtn) => {
                        if (rtn == 0) {
                            console.log(0);
                            flg = 0;
                            return false;
                        } else {
                            flg = 1;
                        }
                    }).fail((rtn) => {
                        console.log(011);
                        flg = 0;
                        return false;
                    });

                });

                if (flg == 1) {
                    console.log(1);

                    $('#product').remove();
                    sesSalesCartList = [];
                    gokei = 0;
                    $('#sum').text((gokei + Math.floor(getCmControl['buppan_soyo'])) + '円');

                    //買い物かごが空なら、買い物を確定ボタンを無効化する
                    $('#next').prop('disabled', true);
                } else {
                    console.log(011);
                    return false;
                }
            } else {
                $('#product').remove();
                sesSalesCartList = [];

                $('#konyu_id').val("");

                $('#hambai_id').val("");

                $('#wk_hambai_id').val("");

                $('#hambai_title').val("");

                $('#hambai_title_chuigaki').val("");

                $('#gazo_url').val("");

                $('#kaiin_kakaku').val("");

                $('#kaiin_zeikomi_kakaku').val("");

                $('#ippan_kakaku').val("");

                $('#ippan_zeikomi_kakaku').val("");

                $('#wk_gaiyo').val("");

                $('#hambai_kbn').val("");

                $('#hambai_settei_kbn').val("");

                $('#hambai_settei_meisho').val("");

                $('#setsumei').val("");

                $('#kakaku').val("");

                $('#konyusu').val("");

                $('#zeikomi_kakaku').val("");

                $('#color_kbn').val("");

                $('#color_meisho').val("");

                $('#size_kbn').val("");

                $('#size_meisho').val("");

                $('#shikaku_kbn').val("");

                gokei = 0;
                $('#sum').text((gokei + Math.floor(getCmControl['buppan_soyo'])) + '円');

                //買い物かごが空なら、買い物を確定ボタンを無効化する
                $('#next').prop('disabled', true);
            }

        });

        //再計算クリック時処理
        $('#keisan').click(function () {
            if ($('#kaiin_no').val()) {
                var sai_sum = 0;
                var shokei_sai = 0;
                $.each(sesSalesCartList, function (i, val) {
                    shokei_sai = Math.floor(val['zeikomi_kakaku']) * $('#number_' + i).val();
                    $('#shokei_' + i).text(shokei_sai + '円');
                    sai_sum = sai_sum + shokei_sai;

                });

                $('#sum').text(sai_sum + Math.floor(getCmControl['buppan_soyo']) + '円');
                $('#gokei_kingaku').val(sai_sum + Math.floor(getCmControl['buppan_soyo']));

                var konyu_id = "";
                var hambai_id = "";
                var konyusu = "";
                var color_meisho = "";
                var size_meisho = "";

                $.each(sesSalesCartList, function (i, val) {
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
                    console.log(011);
                    return false;
                });
            } else {
                var sai_sum = 0;
                var shokei_sai = 0;
                $.each(sesSalesCartList, function (i, val) {
                    shokei_sai = Math.floor(val['zeikomi_kakaku']) * $('#number_' + i).val();
                    $('#shokei_' + i).text(shokei_sai + '円');
                    sai_sum = sai_sum + shokei_sai;

                });
                $('#sum').text(sai_sum + Math.floor(getCmControl['buppan_soyo']) + '円');
                $('#gokei_kingaku').val(sai_sum + Math.floor(getCmControl['buppan_soyo']));

                var konyu_id = "";
                var hambai_id = "";
                var konyusu = "";
                var color_meisho = "";
                var size_meisho = "";

                $.each(sesSalesCartList, function (i, val) {
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
            }


        });

        //他の商品を見るクリック時処理
        $('#back').click(function () {
            if ($('#kaiin_no').val()) {
                var konyu_id = "";
                var hambai_id = "";
                var hambai_title = "";
                var hambai_title_chuigaki = "";
                var gazo_url = "";
                var kaiin_kakaku = "";
                var kaiin_zeikomi_kakaku = "";
                var ippan_kakaku = "";
                var ippan_zeikomi_kakaku = "";
                var gaiyo = "";
                var hambai_kbn = "";
                var hambai_settei_kbn = "";
                var hambai_settei_meisho = "";
                var setsumei = "";
                var kakaku = "";
                var konyusu = "";
                var zeikomi_kakaku = "";
                var color_kbn = "";
                var color_meisho = "";
                var size_kbn = "";
                var size_meisho = "";
                var shikaku_kbn = "";

                $.each(sesSalesCartList, function (i, val) {
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
                    $('#wk_gaiyo').val(gaiyo);

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
                        hambai_title: $('#hambai_title').val(),
                        hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                        gazo_url: $('#gazo_url').val(),
                        kaiin_kakaku: $('#kaiin_kakaku').val(),
                        kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                        ippan_kakaku: $('#ippan_kakaku').val(),
                        ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                        gaiyo: $('#wk_gaiyo').val(),
                        hambai_kbn: $('#hambai_kbn').val(),
                        hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                        hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                        setsumei: $('#setsumei').val(),
                        kakaku: $('#kakaku').val(),
                        konyusu: $('#konyusu').val(),
                        zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                        size_kbn: $('#size_kbn').val(),
                        size_meisho: $('#size_meisho').val(),
                        color_kbn: $('#color_kbn').val(),
                        color_meisho: $('#color_meisho').val(),
                        shikaku_kbn: $('#shikaku_kbn').val(),
                        gokei_kingaku: $('#gokei_kingaku').val(),
                        buppan_soyo: getCmControl['buppan_soyo'],
                        user_id: 'chisato',
                        idx: getSalesCartList.length,
                    }
                }).done((rtn) => {
                    if (rtn == 1) {
                        console.log(1);
                        //セッションに値をセットして画面遷移する
                        jQuery.ajax({
                            url: '../../classes/setSalesDataToSess.php',
                            type: 'POST',
                            data: {
                                konyu_id: $('#konyu_id').val(),
                                hambai_id: $('#hambai_id').val(),
                                wk_hambai_id: $('#hambai_id').val(),
                                hambai_title: $('#hambai_title').val(),
                                hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                                gazo_url: $('#gazo_url').val(),
                                kaiin_kakaku: $('#kaiin_kakaku').val(),
                                kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                                ippan_kakaku: $('#ippan_kakaku').val(),
                                ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                                gaiyo: $('#wk_gaiyo').val(),
                                hambai_kbn: $('#hambai_kbn').val(),
                                hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                                hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                                setsumei: $('#setsumei').val(),
                                kakaku: $('#kakaku').val(),
                                konyusu: $('#konyusu').val(),
                                zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                                size_kbn: $('#size_kbn').val(),
                                size_meisho: $('#size_meisho').val(),
                                color_kbn: $('#color_kbn').val(),
                                color_meisho: $('#color_meisho').val(),
                                shikaku_kbn: $('#shikaku_kbn').val(),
                                gokei_kingaku: $('#gokei_kingaku').val(),
                                buppan_soyo: getCmControl['buppan_soyo'],
                            }
                        }).done((rtn) => {
                            url = '../salesList/';
                            $('form').attr('action', url);
                            $('form').submit();

                        }).fail((rtn) => {
                            console.log(011);
                            return false;
                        });

                    } else {
                        console.log(0);
                        return false;
                    }

                }).fail((rtn) => {
                    console.log(011);
                    return false;
                });
            } else {


                var konyu_id = "";
                var hambai_id = "";
                var hambai_title = "";
                var hambai_title_chuigaki = "";
                var gazo_url = "";
                var kaiin_kakaku = "";
                var kaiin_zeikomi_kakaku = "";
                var ippan_kakaku = "";
                var ippan_zeikomi_kakaku = "";
                var gaiyo = "";
                var hambai_kbn = "";
                var hambai_settei_kbn = "";
                var hambai_settei_meisho = "";
                var setsumei = "";
                var kakaku = "";
                var konyusu = "";
                var zeikomi_kakaku = "";
                var color_kbn = "";
                var color_meisho = "";
                var size_kbn = "";
                var size_meisho = "";
                var shikaku_kbn = "";

                $.each(sesSalesCartList, function (i, val) {
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
                    $('#wk_gaiyo').val(gaiyo);

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

                //セッションに値をセットして画面遷移する
                jQuery.ajax({
                    url: '../../classes/setSalesDataToSess.php',
                    type: 'POST',
                    data: {
                        konyu_id: $('#konyu_id').val(),
                        hambai_id: $('#hambai_id').val(),
                        wk_hambai_id: $('#wk_hambai_id').val(),
                        hambai_title: $('#hambai_title').val(),
                        hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                        gazo_url: $('#gazo_url').val(),
                        kaiin_kakaku: $('#kaiin_kakaku').val(),
                        kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                        ippan_kakaku: $('#ippan_kakaku').val(),
                        ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                        gaiyo: $('#wk_gaiyo').val(),
                        hambai_kbn: $('#hambai_kbn').val(),
                        hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                        hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                        setsumei: $('#setsumei').val(),
                        kakaku: $('#kakaku').val(),
                        konyusu: $('#konyusu').val(),
                        zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                        size_kbn: $('#size_kbn').val(),
                        size_meisho: $('#size_meisho').val(),
                        color_kbn: $('#color_kbn').val(),
                        color_meisho: $('#color_meisho').val(),
                        shikaku_kbn: $('#shikaku_kbn').val(),
                        gokei_kingaku: $('#gokei_kingaku').val(),
                        buppan_soyo: getCmControl['buppan_soyo'],
                    }
                }).done((rtn) => {
                    url = '../salesList/';
                    $('form').attr('action', url);
                    $('form').submit();

                }).fail((rtn) => {
                    console.log(011);
                    return false;
                });
            }

        });

        //買い物を確定ボタンクリック時処理
        $('#next').click(function () {
            //セッションに値をセットして画面遷移する
            if ($('#kaiin_no').val()) {
                var konyu_id = "";
                var hambai_id = "";
                var hambai_title = "";
                var hambai_title_chuigaki = "";
                var gazo_url = "";
                var kaiin_kakaku = "";
                var kaiin_zeikomi_kakaku = "";
                var ippan_kakaku = "";
                var ippan_zeikomi_kakaku = "";
                var gaiyo = "";
                var hambai_kbn = "";
                var hambai_settei_kbn = "";
                var hambai_settei_meisho = "";
                var setsumei = "";
                var kakaku = "";
                var konyusu = "";
                var zeikomi_kakaku = "";
                var color_kbn = "";
                var color_meisho = "";
                var size_kbn = "";
                var size_meisho = "";
                var shikaku_kbn = "";
                $.each(sesSalesCartList, function (i, val) {
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
                    $('#wk_gaiyo').val(gaiyo);

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
                        hambai_title: $('#hambai_title').val(),
                        hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                        gazo_url: $('#gazo_url').val(),
                        kaiin_kakaku: $('#kaiin_kakaku').val(),
                        kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                        ippan_kakaku: $('#ippan_kakaku').val(),
                        ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                        gaiyo: $('#wk_gaiyo').val(),
                        hambai_kbn: $('#hambai_kbn').val(),
                        hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                        hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                        setsumei: $('#setsumei').val(),
                        kakaku: $('#kakaku').val(),
                        konyusu: $('#konyusu').val(),
                        zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                        size_kbn: $('#size_kbn').val(),
                        size_meisho: $('#size_meisho').val(),
                        color_kbn: $('#color_kbn').val(),
                        color_meisho: $('#color_meisho').val(),
                        shikaku_kbn: $('#shikaku_kbn').val(),
                        gokei_kingaku: $('#gokei_kingaku').val(),
                        buppan_soyo: getCmControl['buppan_soyo'],
                        user_id: 'chisato',
                        idx: getSalesCartList.length,
                    }
                }).done((rtn) => {
                    if (rtn == 1) {
                        //セッションに値をセットして画面遷移する
                        jQuery.ajax({
                            url: '../../classes/setSalesDataToSess.php',
                            type: 'POST',
                            data: {
                                konyu_id: $('#konyu_id').val(),
                                hambai_id: $('#hambai_id').val(),
                                wk_hambai_id: $('#hambai_id').val(),
                                hambai_title: $('#hambai_title').val(),
                                hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                                gazo_url: $('#gazo_url').val(),
                                kaiin_kakaku: $('#kaiin_kakaku').val(),
                                kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                                ippan_kakaku: $('#ippan_kakaku').val(),
                                ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                                gaiyo: $('#wk_gaiyo').val(),
                                hambai_kbn: $('#hambai_kbn').val(),
                                hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                                hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                                setsumei: $('#setsumei').val(),
                                kakaku: $('#kakaku').val(),
                                konyusu: $('#konyusu').val(),
                                zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                                size_kbn: $('#size_kbn').val(),
                                size_meisho: $('#size_meisho').val(),
                                color_kbn: $('#color_kbn').val(),
                                color_meisho: $('#color_meisho').val(),
                                shikaku_kbn: $('#shikaku_kbn').val(),
                                gokei_kingaku: $('#gokei_kingaku').val(),
                                buppan_soyo: getCmControl['buppan_soyo'],
                            }
                        }).done((rtn) => {
                            url = '../shoppingConfirm/';
                            $('form').attr('action', url);
                            $('form').submit();

                        }).fail((rtn) => {
                            console.log(011);
                            return false;
                        });

                    } else {
                        console.log(0);
                        return false;
                    }
                }).fail((rtn) => {
                    console.log(011);
                    return false;
                });
            } else {

                var konyu_id = "";
                var hambai_id = "";
                var hambai_title = "";
                var hambai_title_chuigaki = "";
                var gazo_url = "";
                var kaiin_kakaku = "";
                var kaiin_zeikomi_kakaku = "";
                var ippan_kakaku = "";
                var ippan_zeikomi_kakaku = "";
                var gaiyo = "";
                var hambai_kbn = "";
                var hambai_settei_kbn = "";
                var hambai_settei_meisho = "";
                var setsumei = "";
                var kakaku = "";
                var konyusu = "";
                var zeikomi_kakaku = "";
                var color_kbn = "";
                var color_meisho = "";
                var size_kbn = "";
                var size_meisho = "";
                var shikaku_kbn = "";
                $.each(sesSalesCartList, function (i, val) {

                    konyu_id = konyu_id + val['konyu_id'] + ',';
                    $('#konyu_id').val(konyu_id);

                    hambai_id = hambai_id + val['hambai_id'] + ',';
                    $('#wk_hambai_id').val(hambai_id);

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
                    $('#wk_gaiyo').val(gaiyo);

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

                //セッションに値をセットして画面遷移する
                jQuery.ajax({
                    url: '../../classes/setSalesDataToSess.php',
                    type: 'POST',
                    data: {
                        konyu_id: $('#konyu_id').val(),
                        hambai_id: $('#hambai_id').val(),
                        wk_hambai_id: $('#wk_hambai_id').val(),
                        hambai_title: $('#hambai_title').val(),
                        hambai_title_chuigaki: $('#hambai_title_chuigaki').val(),
                        gazo_url: $('#gazo_url').val(),
                        kaiin_kakaku: $('#kaiin_kakaku').val(),
                        kaiin_zeikomi_kakaku: $('#kaiin_zeikomi_kakaku').val(),
                        ippan_kakaku: $('#ippan_kakaku').val(),
                        ippan_zeikomi_kakaku: $('#ippan_zeikomi_kakaku').val(),
                        gaiyo: $('#wk_gaiyo').val(),
                        hambai_kbn: $('#hambai_kbn').val(),
                        hambai_settei_kbn: $('#hambai_settei_kbn').val(),
                        hambai_settei_meisho: $('#hambai_settei_meisho').val(),
                        setsumei: $('#setsumei').val(),
                        kakaku: $('#kakaku').val(),
                        konyusu: $('#konyusu').val(),
                        zeikomi_kakaku: $('#zeikomi_kakaku').val(),
                        size_kbn: $('#size_kbn').val(),
                        size_meisho: $('#size_meisho').val(),
                        color_kbn: $('#color_kbn').val(),
                        color_meisho: $('#color_meisho').val(),
                        shikaku_kbn: $('#shikaku_kbn').val(),
                        gokei_kingaku: $('#gokei_kingaku').val(),
                        buppan_soyo: getCmControl['buppan_soyo'],
                    }
                }).done((rtn) => {
                    url = '../shoppingConfirm/';
                    $('form').attr('action', url);
                    $('form').submit();

                }).fail((rtn) => {
                    console.log(011);
                    return false;
                });


            }


        });

    });
})(jQuery);