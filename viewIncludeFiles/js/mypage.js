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

						// CEU
						$wk_hitsuyo_ceusu= tbKaiinJoho["hitsuyo_ceusu"].substr(0,tbKaiinJoho["hitsuyo_ceusu"].length-2);
						$wk_shutoku_ceusu= tbKaiinJoho["genzai_shutoku_ceusu"].substr(0,tbKaiinJoho["genzai_shutoku_ceusu"].length-2);
                        $('#cscs_kazu').html($wk_shutoku_ceusu + "/" + $wk_hitsuyo_ceusu);
						$cscs_hiritu = Math.round(tbKaiinJoho["genzai_shutoku_ceusu"] / tbKaiinJoho["hitsuyo_ceu_zansu"] *100);
                        $('#cscs_hiritu').html($cscs_hiritu + "％");
						if(tbKaiinJoho["genzai_shutoku_ceusu"] >= tbKaiinJoho["hitsuyo_ceusu"]){
							$("#cscs_msg").html("「CEU報告」の手続きを行って資格を更新してください");
						}else{
							$("#cscs_msg").html("");
						}

						// NSCA-CAP
//						$wk_hitsuyo_nscasu= tbKaiinJoho["hitsuyo_nscasu"].substr(0,tbKaiinJoho["hitsuyo_nscasu"].length-2);
//						$wk_shutoku_nscasu= tbKaiinJoho["genzai_shutoku_nscasu"].substr(0,tbKaiinJoho["genzai_shutoku_nscasu"].length-2);
//                        $('#nsca_kazu').html($wk_shutoku_nscasu + "/" + $wk_hitsuyo_nscasu);
//						$nsca_hiritu = Math.round(tbKaiinJoho["genzai_shutoku_nscasu"] / tbKaiinJoho["hitsuyo_nsca_zansu"] *100);
//                        $('#nsca_hiritu').html($nsca_hiritu + "％");
//						if(tbKaiinJoho["genzai_shutoku_nscasu"] >= tbKaiinJoho["hitsuyo_nscasu"]){
//							$("#nsca_msg").html("NSCA-CAP報告」の手続きを行って資格を更新してください");
//						}else{
//							$("#nsca_msg").html("");
//						}

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

// **********************************************************
// 有効期限フラグ=TRUEの場合　イベント情報表示

    jQuery.ajax({
        url:  '../../classes/mypageGetEvent.php',
        type: 'POST',
        success: function(rtn) {

            // イベント情報、該当なし
                if (rtn == 0) {
					$("#event_list1").show();
		            $("#event_meisho1").hide();
		            $("#event_naiyo1").html("現在イベント情報がございません");
					$("#event_button1").hide();
					// イベント表示件数3件分ループ処理する
					for(var i = 1; i < 4 ; i++) {
						// データがない場合は非表示にする
						$("#event_list"+(i+1)).hide();
					}
//		            $("#err_pass_1").html("現在イベント情報がございません");
				} else {

                        tbEventJoho = JSON.parse(rtn);

					// イベント表示件数2件分ループ処理する
					for(var i = 0; i < 2 ; i++) {
						// データがある場合はデータをセットする
						if(i < tbEventJoho.length){
							$("#event_list"+(i+1)).show();
							$("#event_meisho"+(i+1)).show();
				            $("#event_meisho"+(i+1)).html(tbEventJoho[i]["meisho"]);
				            $("#event_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
							if(tbEventJoho[i]["nokori"] == 0){
								$("#event_nokori"+(i+1)).hide();
							}else{
								$("#event_nokori"+(i+1)).show();
							}
						// データがない場合は非表示にする
						}else{
							$("#event_list"+(i+1)).hide();
//							$("#event_meisho"+(i+1)).hide();
//							$("#event_naiyo"+(i+1)).hide();
//							$("#event_nokori"+(i+1)).hide();
//							$("#event_button"+(i+1)).hide();
						}
					}
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
	*申込状況情報取得
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetApply.php',
        type: 'POST',
        success: function(rtn) {

            // 申込状況情報、該当なし
                if (rtn == 0) {
					$("#apply_list1").show();
		            $("#apply_naiyo1").html("現在申込情報がございません");
					$("#apply_button1").hide();
					// イベント表示件数3件分ループ処理する
					for(var i = 1; i < 4 ; i++) {
						// データがない場合は非表示にする
						$("#apply_list"+(i+1)).hide();
					}
				} else {

                        tbEventJoho = JSON.parse(rtn);

					// イベント表示件数4件分ループ処理する
					for(var i = 0; i < 4 ; i++) {
						// データがある場合はデータをセットする
						if(i < tbEventJoho.length){
							$("#apply_list"+(i+1)).show();
				            $("#apply_naiyo"+(i+1)).html(tbEventJoho[i]["shutoku_naiyo"]);
				            $("#apply_button"+(i+1)).text(tbEventJoho[i]["button_text"]);
						// データがない場合は非表示にする
						}else{
							$("#apply_list"+(i+1)).hide();
//							$("#apply_naiyo"+(i+1)).hide();
//							$("#apply_button"+(i+1)).hide();
						}
					}
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
	*支払情報取得
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetPayment.php',
        type: 'POST',
        success: function(rtn) {

            // 支払状況情報、該当なし
                if (rtn == 0) {
					$("#payment_list1").show();
		            $("#payment_naiyo1").html("現在支払い情報がございません");
					$("#payment_button1").hide();
					// イベント表示件数3件分ループ処理する
					for(var i = 1; i < 4 ; i++) {
						// データがない場合は非表示にする
						$("#payment_list"+(i+1)).hide();
					}
				} else {

                        tbKeiriJoho = JSON.parse(rtn);

					// イベント表示件数4件分ループ処理する
					for(var i = 0; i < 4 ; i++) {
						// データがある場合はデータをセットする
						if(i < tbKeiriJoho.length){
							$("#payment_list"+(i+1)).show();
				            $("#payment_naiyo"+(i+1)).html(tbKeiriJoho[i]["uchiwake"]);
							$("#payment_button"+(i+1)).show();
						// データがない場合は非表示にする
						}else{
							$("#payment_list"+(i+1)).hide();
						}
					}
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
	*お知らせ情報取得
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetInformation.php',
        type: 'POST',
        success: function(rtn) {

            // お知らせ情報、該当なし
                if (rtn == 0) {
					$("#info_list1").show();
		            $("#info_naiyo1").html("お知らせ情報がございません");
					$("#info_button1").hide();
					// イベント表示件数3件分ループ処理する
					for(var i = 1; i < 3 ; i++) {
						// データがない場合は非表示にする
						$("#info_list"+(i+1)).hide();
					}
				} else {

                        infoJoho = JSON.parse(rtn);

					// イベント表示件数3件分ループ処理する
					for(var i = 0; i < 3 ; i++) {
						// データがある場合はデータをセットする
						if(i < infoJoho.length){
							$("#info_list"+(i+1)).show();
				            $("#info_naiyo"+(i+1)).html(infoJoho[i]["naiyo"]);
							if(infoJoho[i]["button_text"] == ""){
								$("#info_button"+(i+1)).hide();
							}else{
							$("#info_button"+(i+1)).show();
				            $("#info_button"+(i+1)).text(infoJoho[i]["button_text"]);
							}
						// データがない場合は非表示にする
						}else{
							$("#info_list"+(i+1)).hide();
						}
					}
				}
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
    });

// **********************************************************
// 有効期限フラグ=TRUEの場合　求人情報表示

	/************************************************************
	*求人情報取得
	*************************************************************/
    jQuery.ajax({
        url:  '../../classes/mypageGetJobList.php',
        type: 'POST',
        success: function(rtn) {

            // 求人情報、該当なし
                if (rtn == 0) {
					$("#jobList_list1").show();
		            $("#jobList_naiyo1").html("求人情報がございません");
					$("#jobList_button1").hide();
					// イベント表示件数5件分ループ処理する
					for(var i = 1; i < 5 ; i++) {
						// データがない場合は非表示にする
						$("#jobList_list"+(i+1)).hide();
					}
				} else {

                        jobList = JSON.parse(rtn);

					// イベント表示件数5件分ループ処理する
					for(var i = 0; i < 5 ; i++) {
						// データがある場合はデータをセットする
						if(i < jobList.length){
							$("#jobList_list"+(i+1)).show();
				            $("#jobList_naiyo"+(i+1)).html(jobList[i]["naiyo"]);
							if(jobList[i]["shinchaku"] == 0){
								$("#jobList_new"+(i+1)).hide();
							}else{
							$("#jobList_new"+(i+1)).show();
							}
							if(jobList[i]["betsugamen"] == 1){$wkWindow ="_blank";}else{$wkWindow ="_self";}
							if(jobList[i]["size_shitei_kbn"] == 1){
								$wkWindowSize ="width=" + jobList[i]["yokohaba"] + ",height=" + jobList[i]["tatehaba"];
							}else{
								$wkWindowSize ="";
							}
							$wk="window.open('" + jobList[i]["url"] + "', '" + $wkWindow + "', '" + $wkWindowSize + "')";
							$("#jobList_naiyo"+(i+1)).attr("onClick", $wk);
						// データがない場合は非表示にする
						}else{
							$("#jobList_list"+(i+1)).hide();
						}
					}
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

