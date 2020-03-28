(function ($) {
    $(document).ready(function () {
        /*********************
         * 購入済み動画一覧へボタンクリック時処理
         *********************/
        $('#videoList').click(function () {
            location.href = '../../videoPlayBackList/';
        });

        /*********************
         * 動画情報取得
         *********************/
        $.ajax({
            url: '../../classes/getTbDogaJoho.php',
        }).done((rtn) => {
            getDogaList = JSON.parse(rtn);
            console.log(getDogaList);
            var doga_id = $('#doga_id').val();

            $.each(getDogaList, function (i, val) {
                if (val['doga_id'] == doga_id) {
                    $('#video').append(val['umekomi_tag']);
                    return false;
                }
            });

        }).fail((rtn) => {
            return false;
        });
    });
})(jQuery);