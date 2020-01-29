(function ($) {
    $(document).ready(function () {
        jQuery.ajax({
            url: '../../classes/getTbKessaiHakko.php',
        }).done((rtn) => {
            if (rtn == 0) {
                // rtn = 0 の場合は、該当なしs
                return false;
            } else {
                getKessaiHakko = JSON.parse(rtn);
                console.log(getKessaiHakko);

                $.each(getKessaiHakko, function (i, val) {
                    $('#kessai').append('<tr><th>' + val['item_title'] + '</th><td>' + Math.floor(val['pay']) + '円</td></tr>');
                });
            }
        }).fail((rtn) => {
            return false;
        });
    });

})(jQuery);