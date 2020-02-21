(function($){
    $(document).ready(function(){

    /******************************************
     * ジャーナルは表示項目不明のため非表示にする
     ******************************************/

	$('#table_journal').hide();
	$('#title_journal').hide();

    /********************************
     * 販売情報取得(初期表示)
     ********************************/

	var count_1 = 0;
	var count_2 = 0;
	var count_3 = 0;
	var count_4 = 0;
	var count_5 = 0;
	var count_6 = 0;
	var count_7 = 0;
	var count_8 = 0;
	var count_9 = 0;
	var count_99 = 0;

     jQuery.ajax({
		url:  '../../classes/salesList.php',
	    type: 'POST',
	    success: function(rtn) {
	            tbHanbaiJoho = JSON.parse(rtn);

	        // 該当なし
	        if (tbHanbaiJoho[0]["hambai_id"] == "") {


			}else{
				for(var i = 0; i < tbHanbaiJoho.length ; i++) {
					var kakaku = Number(tbHanbaiJoho[i]["kakaku_zeikomi"]).toLocaleString();
					var kaiin_kakaku = Number(tbHanbaiJoho[i]["kaiin_kakaku_zeikomi"]).toLocaleString();
                   //動的に<table>を作成
					if(tbHanbaiJoho[i]["shurui"] == 2){ // 動画
	                    var tbody = '<tr>' 
	                              + '<td>'
	                              + '<div>'
	                              + '<iframe width="280" height="157.5" src="' + tbHanbaiJoho[i]["gazo_url"] + '" frameborder="0" allowfullscreen></iframe>'
	                              + '<p class="product_name"><span id="product_title_' + [i] + '">' + tbHanbaiJoho[i]["hambai_title"] + '</span>' 		                            + '<br><br>'
	                              + '<span id="product_chuigaki_' + [i] + '" class="red">' + tbHanbaiJoho[i]["chuigaki"] + '</span></p>'
	                              + '</div>'
	                              + '<button class="button  pc_bl" type="button"  data-id="' + tbHanbaiJoho[i]["hambai_id"] + '"><span>詳細</span></button>'
	                              + '</td>'
	                              + '<td data-label="販売価格" class="price">' + tbHanbaiJoho[i]["kakaku_title"] 
								  + '価格：<span id="cscs_price_' + [i] + '">' + kakaku + '円</span></td>'
	                              + '<td class="sp_bl">'
	                              + '<button class="button" type="button" onClick="goSyosai(' + tbHanbaiJoho[i]["hambai_id "] + ')"><span>詳細</span></button>'
	                              + '</td>'
	                              + '</tr>';


					}else{ //  動画以外
	                    var tbody = '<tr>' 
	                              + '<td>'
	                              + '<div>'
	                              + '<img src="' + tbHanbaiJoho[i]["gazo_url"] + '">'
	                              + '<p class="product_name"><span id="product_title_' + [i] + '">' + tbHanbaiJoho[i]["hambai_title"] + '</span>' 
	                              + '<br><br>'
	                              + '<span id="product_chuigaki_' + [i] + '" class="red">' + tbHanbaiJoho[i]["chuigaki"] + '</span></p>'
	                              + '</div>'
	                              + '<button class="button  pc_bl" type="button"  data-id="' + tbHanbaiJoho[i]["hambai_id"] + '"><span>詳細</span></button>'
	                              + '</td>'
	                              + '<td data-label="販売価格" class="price">' + tbHanbaiJoho[i]["kakaku_title"] 
								  + '価格：<span id="cscs_price_' + [i] + '">' + kakaku + '円</span>';
						if(tbHanbaiJoho[0]["kaiin_no"] == ""){ // 一般の場合は会員価格も表示する
							tbody += '<br><br><br>' + tbHanbaiJoho[i]["kaiin_kakaku_title"] + '価格：<span id="cscs_price_' + [i] + '">' + kaiin_kakaku + '円</span>';
						}
	                    tbody += '</td><td class="sp_bl">'
	                              + '<button class="button" type="button" onClick="goSyosai(' + tbHanbaiJoho[i]["hambai_id "] + ')"><span>詳細</span></button>'
	                              + '</td>'
	                              + '</tr>';
					}
					if(tbHanbaiJoho[i]["shurui"] == 2){ // 動画
		                $("#table_doga").append(tbody);
						count_99++;
					}else{ // 動画以外
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
				}
			}

			// 0件時の実装
			if(count_1 == 0){
				$('#table_cscs').hide();
				$('#title_cscs').hide();
			}
			if(count_2 == 0){
				$('#table_nsca').hide();
				$('#title_nsca').hide();
			}
			if(count_3 == 0){
				$('#table_dvd').hide();
				$('#title_dvd').hide();
			}
			if(count_4 == 0){
				$('#table_other').hide();
				$('#title_other').hide();
			}
			if(count_5 == 0){
				$('#table_original').hide();
				$('#title_original').hide();
			}
			if(count_6 == 0){
				$('#table_homestudy').hide();
				$('#title_homestudy').hide();
			}
			if(count_7 == 0){
				$('#table_meishi_a').hide();
				$('#title_meishi_a').hide();
			}
			if(count_8 == 0){
				$('#table_meishi_b').hide();
				$('#title_meishi_b').hide();
			}
			if(count_9 == 0){
				$('#table_english').hide();
				$('#title_english').hide();
			}
			if(count_99 == 0){
				$('#table_doga').hide();
				$('#title_doga').hide();
			}

			if(tbHanbaiJoho[0]["kaiin_no"] == ""){ // 未ログイン
				$('#login_button').show();
				$('#no_login_info').show();
				$('#table_doga').hide();
				$('#title_doga').hide();
			}else{ // ログイン中
				$('#login_button').hide();
				$('#no_login_info').hide();
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


/************************************************************
	*詳細ボタン押下時（動画以外）
*************************************************************/

$('.buttons-area').on('click', 'button', function() {
 
//			url = '../product/';
//			$('form').attr('action', url);
	var hambai_id = $(this).data('id');
	$("#hambai_id").val(hambai_id);
    $("#hambai_form").submit();
});

/************************************************************
	*詳細ボタン押下時（動画）
*************************************************************/

$('.buttons-doga-area').on('click', 'button', function() {
 
	var doga_id = $(this).data('id');
	$("#doga_id").val(doga_id);
    $("#doga_form").submit();
});

    });
})(jQuery);
