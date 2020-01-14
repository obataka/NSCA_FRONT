(function($){
    $(document).ready(function(){


	/************************************************************
	*会員情報取得 
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypage.php',
        type: 'POST',
        success: function(rtn) {

           // 会員情報、該当なし
                if (rtn == 0) {
//		            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
//                    $("#pass_1").prop("disabled", true);
//                    return false;
				}else{

                        tbKaiinJoho = JSON.parse(rtn);

						// 会員情報
                        $('#kaiin_no').html(tbKaiinJoho["kaiin_no"]);
                        $('#kaiin_name').html(tbKaiinJoho["kaiin_name"]);
                        $('#kaiin_sbt').html(tbKaiinJoho["kaiin_sbt"]);
                        $('#yuko_hizuke').html(tbKaiinJoho["yuko_hizuke"]);
                        $('#eibun_option').html(tbKaiinJoho["eibun_option"]);

						// 試験
                        $('#nintei_no_c').html(tbKaiinJoho["nintei_no_c"]);
                        $('#ninteibi_c').html(tbKaiinJoho["ninteibi_c"]);
                        $('#yuko_kigen_c').html(tbKaiinJoho["yuko_kigen_c"]);
                        $('#nintei_no_n').html(tbKaiinJoho["nintei_no_n"]);
                        $('#ninteibi_n').html(tbKaiinJoho["ninteibi_n"]);
                        $('#yuko_kigen_n').html(tbKaiinJoho["yuko_kigen_n"]);

				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });

	/************************************************************
	*イベント情報取得 
	*************************************************************/

    jQuery.ajax({
        url:  '../../classes/mypageGetEvent.php',
        type: 'POST',
        success: function(rtn) {

            // イベント情報、該当なし
                if (rtn == 0) {
//		            $("#err_pass_1").html("現在イベント情報がございません");
				}else{

                        tbEventJoho = JSON.parse(rtn);

for(tbEventJoho i = 0; i < tbEventJoho.length; i++) {
//  tbEventJoho[i]["ceu_id"]
//  tbEventJoho[i]["shutoku_naiyo"]
}
//                        $('#kaiin_no').html(tbKaiinJoho["kaiin_no"]);
//alert("---");
//alert(tbEventJoho[0]["shutoku_naiyo"]);
				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });





    });
})(jQuery);

