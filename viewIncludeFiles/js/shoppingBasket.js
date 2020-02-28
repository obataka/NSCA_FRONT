(function ($) {
    $(document).ready(function () {
        /********************
         * 買い物かごの内容を表示する
         ********************/
        jQuery.ajax({
            url: '../../classes/getSalesCartList.php',
        }).done((rtn) => {
            getSalesCartList = JSON.parse(rtn);
            

        }).fail((rtn) => {
            return false;
        });
        
    });
})(jQuery);