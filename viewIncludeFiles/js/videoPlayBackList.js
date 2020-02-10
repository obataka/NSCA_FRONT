(function ($) {
    $(document).ready(function () {

        /*********************
         * 動画一覧表示処理
         *********************/
        jQuery.ajax({
            url: '../../classes/getTbDogaJoho.php',
        }).done((rtn) => {
            getDogaList = JSON.parse(rtn);
            
        }).fail((rtn) => {
            return false;
        });
        
    });
})(jQuery);