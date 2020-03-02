(function ($) {
    $(document).ready(function () {

        //合計金額
        var gokei = 0;

        var getCmControl = "";
        var getSalesCartList = "";

        /********************
         * TB販売購入者情報から買い物かごの内容を表示する
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
                                    <td><input id="number_` + i + `" type="number" name="number" value="1" min="0"></td>
                                </tr>
                                <tr>
                                    <th>小計(円)<span>：</span></th>
                                    <td id="shokei_` + i + `">` + Math.floor(val['zeikomi_kakaku']) + `円</td>
                                </tr>
                            </table>
                        </section>
                    </div>`);

                    gokei = gokei + Math.floor(val['zeikomi_kakaku']);
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
            $('#product_' + val).remove();
        });

        //かごの中を空にするボタンクリック時処理
        $('#reset').click(function () {
            $('#product').remove();
            gokei = 0;
            $('#sum').text((gokei + Math.floor(getCmControl['buppan_soyo'])) + '円');
        });

        //再計算クリック時処理
        $('#keisan').click(function () {
            sai_sum = 0;
            for (let i = 0; i < getSalesCartList.length; i++) {
                shokei_sai = getSalesCartList[i]['zeikomi_kakaku'] * $('#number_' + i).val();
                $('#shokei_' + i).val(shokei_sai)
                sai_sum = sai_sum + shokei_sai;
            }
            $('#sum').text(sai_sum + Math.floor(getCmControl['buppan_soyo']) + '円');
            $('#gokei_kingaku').val(sai_sum + Math.floor(getCmControl['buppan_soyo']));
        });

        //他の商品を見るクリック時処理
        $('#back').click(function () {


            url = '../salesList/';
            $('form').attr('action', url);
            $('form').submit();
        });

        //買い物を確定ボタンクリック時処理
        $('#next').click(function () {

        });

    });
})(jQuery);