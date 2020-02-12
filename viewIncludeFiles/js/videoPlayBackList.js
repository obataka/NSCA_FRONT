(function ($) {
    $(document).ready(function () {

        /*********************
         * 動画一覧表示処理
         *********************/
        jQuery.ajax({
            url: '../../classes/getTbDogaJoho.php',
        }).done((rtn) => {
            getDogaList = JSON.parse(rtn);
            console.log(getDogaList);
            jQuery.ajax({
                url: '../../classes/getTbDogaKonyushaMeisai.php',
            }).done((rtn) => {
                getDogaKonyushaMeisaiList = JSON.parse(rtn);
                console.log(getDogaKonyushaMeisaiList);
                $.each(getDogaList, function (i, val) {
                    //値比較のため動画IDを一時的に変数に格納する
                    var tmpId = val['doga_id'];

                    //タイトル、動画URLを一時的に変数に格納する
                    var tmpTitle = val['doga_title'];
                    var tmpUrl = val['sample_doga_url'];

                    $.each(getDogaKonyushaMeisaiList, function (i, val) {
                        if (val['doga_id'] == tmpId) {
                            $('#movie').append('<tr>' +
                                                    '<td data-label="タイトル"><a href="../videoPlayBack/" class="video">' + tmpTitle + '</a></td>'+
                                                    '<td data-label="ご視聴開始日" class="date">' + val['shicho_kaishibi'].slice(0, 10).split('-').join('/') + '</td>'+
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
            location.href='../../contentsList/';
        });

        /*********************
         * 動画タイトルクリック時処理
         *********************/
        $('.video').click(function () {
            
        });
    });
})(jQuery);