(function ($) {
    $(document).ready(function () {
        /********************
        * 初期表示処理
        ********************/
        //合計金額
        var gokei = 0;

        var getCmControl = [];

        //セッションの値を入れる配列
        var sesSalesCartList = [];
        /********************
        * CMコントロール情報を取得する
        ********************/
        $.ajax({
            url: '../../classes/getCmControl.php',
        }).done((rtn) => {
            getCmControl = JSON.parse(rtn);
            $('#tesuryo').text(Math.floor(getCmControl['buppan_soryo']) + '円');

            var wk_hambai_id = "";
            var wk_hambai_title = "";
            var wk_hambai_title_chuigaki = "";
            var wk_hambai_kbn = "";
            var wk_gaiyo = "";
            var wk_kakaku = "";
            var wk_suryo = "";

            //表示する商品が複数ある場合
            if ($('#wk_hambai_id').val().split(',').length - 1 > 1) {
                wk_hambai_id = $('#wk_hambai_id').val().split(',');
                wk_hambai_title = $('#hambai_title').val().split(',');
                wk_hambai_title_chuigaki = $('#hambai_title_chuigaki').val().split(',');
                wk_hambai_kbn = $('#hambai_kbn').val().split(',');
                wk_gaiyo = $('#wk_gaiyo').val().split(',');
                wk_gazo_url = $('#gazo_url').val().split(',');

                if ($('#kaiin_no').val()) {
                    wk_kakaku = $('#kaiin_kakaku').val().split(',');
                } else {
                    wk_kakaku = $('#ippan_kakaku').val().split(',');
                }
                wk_suryo = $('#konyusu').val().split(',');

                for (let i = 0; i < wk_hambai_id.length; i++) {
                    sesSalesCartListRow = {
                        'hambai_id': wk_hambai_id[i],
                        'hambai_title': wk_hambai_title[i],
                        'hambai_title_chuigaki': wk_hambai_title_chuigaki[i],
                        'hambai_kbn': wk_hambai_kbn[i],
                        'gaiyo': wk_gaiyo[i],
                        'gazo_url': wk_gazo_url[i],
                        'kakaku': wk_kakaku[i],
                        'suryo': wk_suryo[i],

                    };
                    sesSalesCartList.push(sesSalesCartListRow);
                }

            } else {
                //表示する商品が1種類のみの場合
                wk_hambai_id = $('#wk_hambai_id').val().split(',');
                wk_hambai_title = $('#hambai_title').val().split(',');
                wk_hambai_title_chuigaki = $('#hambai_title_chuigaki').val().split(',');
                wk_hambai_kbn = $('#hambai_kbn').val().split(',');
                wk_gaiyo = $('#wk_gaiyo').val().split(',');
                wk_gazo_url = $('#gazo_url').val().split(',');

                if ($('#kaiin_no').val()) {
                    wk_kakaku = $('#kaiin_zeikomi_kakaku').val().split(',');
                } else {
                    wk_kakaku = $('#ippan_zeikomi_kakaku').val().split(',');
                }

                wk_suryo = $('#konyusu').val().split(',');

                sesSalesCartListRow = {
                    'hambai_id': wk_hambai_id[0],
                    'hambai_title': wk_hambai_title[0],
                    'hambai_title_chuigaki': wk_hambai_title_chuigaki[0],
                    'hambai_kbn': wk_hambai_kbn[0],
                    'gaiyo': wk_gaiyo[0],
                    'gazo_url': wk_gazo_url[0],
                    'kakaku': wk_kakaku[0],
                    'suryo': wk_suryo[0],

                };
                sesSalesCartList = [
                    sesSalesCartListRow
                ];
            }

            $.each(sesSalesCartList, function (i, val) {
                if (i == sesSalesCartList.length - 1) {
                    return false;
                } else {
                    $('#product_list').append(`<tr>
                                        <td data-label="商品名">
                                            <p><img src="` + val['gazo_url'] + `">` + val['hambai_title'] + `</p>
                                        </td>
                                        <td data-label="数量">` + val['suryo'] + `</td>
                                        <td data-label="税込み単価">` + val['kakaku'] * val['suryo'] + `</td>
                                    </tr>`);
                    gokei = gokei + Math.floor(val['zeikomi_kakaku']) * val['suryo'];
                }

            });
            $('#sum').text(gokei + Math.floor(getCmControl['buppan_soyo']) + '円');
            $('#gokei_kingaku').val(gokei + Math.floor(getCmControl['buppan_soyo']));
        }).fail((rtn) => {
            return false;
        });


        /********************
        * カート画面へボタンクリック時処理
        ********************/
        $('#return').click(function () {
            url = '../shoppingBasket/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /********************
        * 決済方法選択へ
        ********************/
        $('#next').click(function () {
            $.ajax({
                url: '../../classes/setSalesDataToSess.php',
                data: {
                    tranScreen: 'shoppingConfirm'
                }
            }).done((rtn) => {
                url = '../paymentSelectNoLogin/';
                $('form').attr('action', url);
                $('form').submit();
            }).fail((rtn) => {
                return false;
            });
        });


    });
})(jQuery);