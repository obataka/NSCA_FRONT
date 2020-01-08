(function($){
    $(document).ready(function(){


    jQuery.ajax({
        url:  '../../classes/mypage.php',
        type: 'POST',
        success: function(rtn) {

//alert("suc");

            // 会員情報、該当なし
                if (rtn == 0) {
//		            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
//                    $("#pass_1").prop("disabled", true);
//                    return false;
				}else{

                        tbKaiinJoho = JSON.parse(rtn);
// tbKaiinJoho["kaiin_sbt_kbn"]
                        $('#kaiin_no').html(tbKaiinJoho["kaiin_no"]);
                        $('#kaiin_name').html(tbKaiinJoho["kaiin_name"]);
                        $('#kaiin_sbt').html(tbKaiinJoho["kaiin_sbt"]);
                        $('#yuko_hizuke').html(tbKaiinJoho["yuko_hizuke"]);
                        $('#eibun_option').html(tbKaiinJoho["eibun_option"]);

				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });
//alert(rtn);

//            $("#kaiin_no").html("99999999");
            $("#joho_kaiin_no").html(tbKaiinJoho["kaiin_no"]);



    });
})(jQuery);

