(function ($) {
    $(document).ready(function () {

        /*********************
         * 動画一覧表示処理
         *********************/
        $.ajax({
            url: '../../classes/getTbDogaJoho.php',
        }).done((rtn) => {
            getDogaList = JSON.parse(rtn);
            $.ajax({
                url: '../../classes/getTbDogaKonyushaMeisai.php',
            }).done((rtn) => {
                getDogaKonyushaMeisaiList = JSON.parse(rtn);
                $.each(getDogaList, function (i, val) {
                    //値比較のため動画IDを一時的に変数に格納する
                    var tmpId = val['doga_id'];

                    //タイトルを一時的に変数に格納する
                    var tmpTitle = val['doga_title'];

                    $.each(getDogaKonyushaMeisaiList, function (i, val) {
                        if (val['doga_id'] == tmpId) {
                            $('#movie').append('<tr>' +
                                '<td data-label="タイトル"><a href="#" data-value="' + tmpId +'">' + tmpTitle + '</a></td>' +
                                '<td data-label="ご視聴開始日" class="date">' + val['shicho_kaishibi'].slice(0, 10).split('-').join('/') + '</td>' +
                                '</tr>');
                        }
                    });
                });

            }).fail((rtn) => {
                return false;
            });

        }).fail((rtn) => {
            return false;
        });

        /*********************
         * 会員限定コンテンツへボタンクリック時処理
         *********************/
        $('#contents').click(function () {
            location.href = '../../contentsList/';
        });

        /*********************
         * 動画タイトルクリック時処理
         *********************/
        $(document).on("click","a",function () {
            
            //動画IDをhiddenタグにセット
            $('#doga_id').val($(this).attr("data-value"));
            url = '../../videoPlayBack/';
            $('form').attr('action', url);
            $('form').submit();
        });
    });
})(jQuery);