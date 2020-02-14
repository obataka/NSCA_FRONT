(function($){
    $(document).ready(function(){

// 未ログインの場合は、ログインボタン表示、ログインすると・・・のお知らせ表示、

    /********************************
     * 販売情報取得(初期表示)
     ********************************/
     jQuery.ajax({
		url:  '../../classes/salesList.php',
	    type: 'POST',
	    success: function(rtn) {

	        // 該当なし
	        if (rtn == 0) {
	//		            $("#err_pass_1").html("有効期限が過ぎています。パスワード変更依頼メール画面からもう一度やり直してください。");
	//                    $("#pass_1").prop("disabled", true);
	//                    $("#pass_2").prop("disabled", true);
	//			        $('button[type="submit"]').prop("disabled", true);
	            return false;
			}else{
	            tbHanbaiJoho = JSON.parse(rtn);
				var count_1 = 0;
				var count_2 = 0;
				var count_3 = 0;
				var count_4 = 0;
				var count_5 = 0;
				var count_6 = 0;
				var count_7 = 0;
				var count_8 = 0;
				var count_9 = 0;

				for(var i = 0; i < tbHanbaiJoho.length ; i++) {
					var kakaku = Number(tbHanbaiJoho[i]["kakaku_zeikomi"]).toLocaleString();
                   //動的に<table>を作成
                    var tbody = '<tr>' 
                              + '<td>'
                              + '<div>'
                              + '<img src="' + tbHanbaiJoho[i]["gazo_url"] + '">'
                              + '<p class="product_name"><span id="cscs_title_' + [i] + '">' + tbHanbaiJoho[i]["hambai_title"] + '</span></p>' 
                              + '</div>'
                              + '<button class="button  pc_bl" type="button" id=cscs_button_' + [i] + '"><span>詳細</span></button>'
                              + '</td>'
                              + '<td data-label="販売価格" class="price">' + tbHanbaiJoho[i]["kakaku_title"] + '価格：<span id="cscs_price_' + [i] + '">' + kakaku + '円</span></td>'
                              + '<td class="sp_bl">'
                              + '<button class="button" type="button" onClick="goSyosai(' + tbHanbaiJoho[i]["hambai_id "] + ')"><span>詳細</span></button>'
                              + '</td>'
                              + '</tr>';

					if(tbHanbaiJoho[i]["hambai_kbn"] == 1){ // cscs
		                $("#table_cscs").append(tbody);
						count_1++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 2){ // NSCA-CPT
		                $("#table_nsca").append(tbody);
						count_2++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 3){ // エクササイズDVD
		                $("#table_dvd").append(tbody);
						count_3++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 4){ // その他書籍
		                $("#table_other").append(tbody);
						count_4++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 5){ // オリジナル商品
		                $("#table_original").append(tbody);
						count_5++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 6){ // ホームスタディ
		                $("#table_homestudy").append(tbody);
						count_6++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 7){ // 名刺タイプA
		                $("#table_meishi_a").append(tbody);
						count_7++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 8){ // 名刺タイプB
		                $("#table_meishi_b").append(tbody);
						count_8++;
					}else if(tbHanbaiJoho[i]["hambai_kbn"] == 9){ // 英語版認定証
		                $("#table_english").append(tbody);
						count_9++;
					}
				}

				// 0件時の実装


			}
	    },
		fail: function(rtn) {
//		$('#err_pass_1').html('システムエラーが発生しました。');
			return false;
	    },
	    error: function(rtn) {
	        return false;
	    }
	 });



    });
})(jQuery);
