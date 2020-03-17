(function($){

    $(document).ready(function(){


    // 電子ブック、物販はペンディング（実装まで非表示）
	$('#denshi_book').hide();
	$('#buppan').hide();

	/************************************************************
	*会員情報取得
	*************************************************************/
    $.ajax({
        url:  '../../classes/mypage.php',
        type: 'POST'
        })
        .done( (rtn) => {

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

						// CEU(cscs)
						if(tbKaiinJoho["hitsuyo_ceusu_c"] != null){
							$wk_hitsuyo_ceusu= tbKaiinJoho["hitsuyo_ceusu_c"].substr(0,tbKaiinJoho["hitsuyo_ceusu_c"].length-2);
							$wk_shutoku_ceusu= tbKaiinJoho["genzai_shutoku_ceusu_c"].substr(0,tbKaiinJoho["genzai_shutoku_ceusu_c"].length-2);
	                        $('#cscs_kazu').html($wk_shutoku_ceusu + "/" + $wk_hitsuyo_ceusu);
							$cscs_hiritu = Math.round($wk_shutoku_ceusu / $wk_hitsuyo_ceusu *100);
	                        $('#cscs_hiritu').html($cscs_hiritu + "％");
							if($wk_shutoku_ceusu >= $wk_hitsuyo_ceusu){
								$("#cscs_msg").html("「CEU報告」の手続きを行って資格を更新してください");
							}else{
								$("#cscs_msg").html("");
							}
						}else{ // cscs認定情報なし　============(要実装)====================

						}
						// CEU(nsca)
						if(tbKaiinJoho["hitsuyo_ceusu_n"] != null){
							$wk_hitsuyo_ceusu= tbKaiinJoho["hitsuyo_ceusu_n"].substr(0,tbKaiinJoho["hitsuyo_ceusu_n"].length-2);
							$wk_shutoku_ceusu= tbKaiinJoho["genzai_shutoku_ceusu_n"].substr(0,tbKaiinJoho["genzai_shutoku_ceusu_n"].length-2);
	                        $('#nsca_kazu').html($wk_shutoku_ceusu + "/" + $wk_hitsuyo_ceusu);
							$nsca_hiritu = Math.round($wk_shutoku_ceusu / $wk_hitsuyo_ceusu *100);
	                        $('#nsca_hiritu').html($nsca_hiritu + "％");
							if($wk_shutoku_ceusu >= $wk_hitsuyo_ceusu){
								$("#nsca_msg").html("「CEU報告」の手続きを行って資格を更新してください");
							}else{
								$("#nsca_msg").html("");
							}
						}else{ // nsca認定情報なし　============(要実装)====================

						}
				}

				/************************************************************
				*お知らせ情報取得
				*************************************************************/
				getDataInfoList(1);

				/************************************************************
				*申込状況情報取得
				*************************************************************/
				getDataApplyList();

				/************************************************************
				*支払情報取得
				*************************************************************/
				getDataPaymentList();

			// **********************************************************
			// 有効期限フラグ=TRUEの場合　イベント情報,求人情報表示

			if(tbKaiinJoho["yukokigenFlg"]){

				/************************************************************
				*イベント情報取得
				*************************************************************/
				getDataEventList();

				/************************************************************
				*求人情報取得
				*************************************************************/
				getDataJobList(1);


			// **********************************************************
			// 有効期限フラグ=FALSEの場合　CEU
			}else{

//                    ' 有効期限が切れた→継続処理以外は行わせない
//                    ' ①　CEU取得状況
//                    .lbtnCeuReport.Visible = False  ' CEU報告
//                    .lbtnCeuState.Visible = False   ' CEU詳細画面へのリンク(詳しくはこちら)
//                    .lblExamEntry.Visible = False   ' 認定資格無の場合の試験申込ボタンキャプション
//                    .lbtnExamEntry.Visible = False  ' 認定資格無の場合の試験申込ボタン
//                    .pnlCeuQuiz.Visible = False     ' クイズ一覧画面へのリンク
//                    .pnlPersonal.Visible = False    ' パーソナルデベロップメント申告へのリンク

//                    ' ②　会員限定コンテンツ
						$('#kaiin_contents').hide();
//                    .lbtnContents.Visible = False   ' 限定コンテンツへのリンクボタン(パネル毎消すと空白が空きすぎる)
//                    '.pnlPremiere.Visible = False

//                    ' ③　セミナー一覧
						$('#event').hide();
//                    .pnlSeminar.Visible = False
//                    ' ④　求人一覧
						$('#kyujin_joho').hide();
			}

		})
		.fail( (rtn) => {
//			$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		.always( (rtn) => {
		});



/************************************************************
*申込情報データ取得・画面表示
*************************************************************/
function getDataApplyList(){

		$.ajax({
        url:  '../../classes/mypageGetApply.php',
        type: 'POST'
		})
		.done( (rtn) => {
//alert(rtn);
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

                        tbApplyJoho = JSON.parse(rtn);

					// 申込状況表示件数4件分ループ処理する
					for(var i = 0; i < 4 ; i++) {
						// データがある場合はデータをセットする
						if(i < tbApplyJoho.length){
							$("#apply_list"+(i+1)).show();
				            $("#apply_naiyo"+(i+1)).html(tbApplyJoho[i]["shutoku_naiyo"]);
				            $("#apply_kakunin"+(i+1)).html(tbApplyJoho[i]["kakunin"]);
							if(tbApplyJoho[i]["tetuzuki"] == "キャンセルはこちら"){
					            $("#apply_cancel"+(i+1)).show();
					            $("#apply_cancel"+(i+1)).data('id',i);
					            $("#apply_tetuzuki"+(i+1)).hide();
							}else{
					            $("#apply_cancel"+(i+1)).hide();
					            $("#apply_tetuzuki"+(i+1)).html(tbApplyJoho[i]["tetuzuki"]);
					            $("#apply_tetuzuki"+(i+1)).show();
							}

							if(tbApplyJoho[i]["shiharai_button"] != ""){
					            $("#apply_button"+(i+1)).text(tbApplyJoho[i]["shiharai_button"]);
								$("#apply_button"+(i+1)).show();
								$("#apply_payment"+(i+1)).hide();
							}else{
								$("#apply_button"+(i+1)).hide();
					            $("#apply_payment"+(i+1)).html(tbApplyJoho[i]["shiharai"]);
								$("#apply_payment"+(i+1)).show();
								
							}
							if(tbApplyJoho[i]["shosai"] == ""){
								$("#apply_shosai_button"+(i+1)).hide();
								$("#apply_shosai"+(i+1)).hide();
							}else{
								if(tbApplyJoho[i]["shosai"] == "不合格"){
									$("#apply_shosai_button"+(i+1)).hide();
									$("#apply_shosai"+(i+1)).show();
								}else{
									$("#apply_shosai_button"+(i+1)).show();
									$("#apply_shosai_button"+(i+1)).data('id',i);
									$("#apply_shosai"+(i+1)).hide();
								}
							}
							if(tbApplyJoho[i]["kakunin_class"] != ""){
								$("#apply_kakunin"+(i+1)).addClass(tbApplyJoho[i]["kakunin_class"]);
							}

						// データがない場合は非表示にする
						}else{
							$("#apply_list"+(i+1)).hide();
						}
					}
				}
			})
		.fail( (rtn) => {
//			$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		// Ajaxリクエストが成功・失敗どちらでも発動
		.always( (rtn) => {
		});

}

/************************************************************
*支払情報データ取得・画面表示
*************************************************************/
function getDataPaymentList(pageNo){

		$.ajax({
        url:  '../../classes/mypageGetPayment.php',
        type: 'POST'
		})
		.done( (rtn) => {

            // 支払状況情報、該当なし
                if (rtn == 0) {
					$("#payment_list1").show();
		            $("#payment_naiyo1").html("今年度のお支払情報はございません");
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
				            $("#payment_button"+(i+1)).data('id',tbKeiriJoho[i]["keiri_id"]);
							$("#payment_button"+(i+1)).show();
						// データがない場合は非表示にする
						}else{
							$("#payment_list"+(i+1)).hide();
						}
					}
				}
		})
		.fail( (rtn) => {
//						$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		.always( (rtn) => {
		});

}

/************************************************************
*お知らせ情報データ取得・画面表示（ページングあり）
*************************************************************/
function getDataInfoList(pageNo){

	// 画面表示件数
	infoData_show_count = 3;
	first_infoData_count = (pageNo - 1) * infoData_show_count;

	$.ajax({
    url:  '../../classes/mypageGetInformation.php',
    type: 'POST'
	})
	.done( (rtn) => {

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
				j=first_infoData_count;

				// 表示件数分ループ処理する
				for(var i = 1; i <= infoData_show_count ; i++) {
					// データがある場合はデータをセットする
					if(j < infoJoho.length){
						$("#info_list"+(i)).show();
			            $("#info_naiyo"+(i)).html(infoJoho[j]["naiyo"]);
						if(infoJoho[j]["button_text"] == ""){
							$("#info_button"+(i)).hide();
						}else{
						$("#info_button"+(i)).show();
			            $("#info_button"+(i)).text(infoJoho[j]["button_text"]);
			            $("#info_button"+(i)).data('id',infoJoho[j]["url"]);
						}
					// データがない場合は非表示にする
					}else{
						$("#info_list"+(i)).hide();
					}
					j++;
				}

				$("#infoList_page_before").show();
				$("#infoList_page2").show();
				$("#infoList_page3").show();
				$("#infoList_page_next").show();

				if(pageNo <= 3){
					$("#infoList_page_before").hide();
				}

				if(pageNo == 1){
					$("#infoList_pageNo_1").val(1);
					$("#infoList_pageNo_2").val(2);
					$("#infoList_pageNo_3").val(3);
					$("#infoList_pageNo_n").val(4);
					$("#infoList_page1").html(1);
					$("#infoList_page2").html(2);
					$("#infoList_page3").html(3);
					$('#infoList_page1').css('pointer-events', 'none');
					$('#infoList_page1').css('pointer-events', 'auto');
					$('#infoList_page1').css('pointer-events', 'auto');
				}else if(pageNo != 2 && (pageNo + 1) * infoData_show_count > infoJoho.length){
					$("#infoList_pageNo_b").val(pageNo - 3);
					$("#infoList_pageNo_1").val(pageNo - 2);
					$("#infoList_pageNo_2").val(pageNo - 1);
					$("#infoList_pageNo_3").val(pageNo);
					$("#infoList_pageNo_n").val(pageNo + 1);
					$("#infoList_page1").html(pageNo - 2);
					$("#infoList_page2").html(pageNo - 1);
					$("#infoList_page3").html(pageNo);
					$('#infoList_page1').css('pointer-events', 'auto');
					$('#infoList_page1').css('pointer-events', 'auto');
					$('#infoList_page1').css('pointer-events', 'none');
				}else{
					$("#infoList_pageNo_b").val(pageNo - 2);
					$("#infoList_pageNo_1").val(pageNo - 1);
					$("#infoList_pageNo_2").val(pageNo);
					$("#infoList_pageNo_3").val(pageNo + 1);
					$("#infoList_pageNo_n").val(pageNo + 2);
					$("#infoList_page1").html(pageNo - 1);
					$("#infoList_page2").html(pageNo);
					$("#infoList_page3").html(pageNo + 1);
					$('#infoList_page1').css('pointer-events', 'auto');
					$('#infoList_page1').css('pointer-events', 'none');
					$('#infoList_page1').css('pointer-events', 'auto');
				}
						

				if($("#infoList_pageNo_1").val() * infoData_show_count > infoJoho.length){
					$("#infoList_page2").hide();
				}
				if($("#infoList_pageNo_2").val() * infoData_show_count > infoJoho.length){
					$("#infoList_page3").hide();
				}
				if($("#infoList_pageNo_3").val() * infoData_show_count >= infoJoho.length){
					$("#infoList_page_next").hide();
				}

			}
        })
        .fail( (rtn) => {
                $('#err_msg').html('システムエラーが発生しました。');
                return false;
        })
        .always( (rtn) => {
        });
}


/************************************************************
*イベントデータ取得・画面表示
*************************************************************/
function getDataEventList(){

		$.ajax({
        url:  '../../classes/mypageGetEvent.php',
        type: 'POST'
		})
		.done( (rtn) => {

            // イベント情報、該当なし
                if (rtn == 0) {
					$("#event_list1").show();
		            $("#event_meisho1").hide();
		            $("#event_naiyo1").html("現在イベント情報がございません");
					$("#event_button1").hide();
					$("#event_nokori1").hide();
					// イベント表示件数3件分ループ処理する
					for(var i = 1; i < 4 ; i++) {
						// データがない場合は非表示にする
						$("#event_list"+(i+1)).hide();
					}
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
				            $("#event_button"+(i+1)).data('id',tbEventJoho[i]["ceu_id"]);
							if(tbEventJoho[i]["nokori"] == 0){
								$("#event_nokori"+(i+1)).hide();
							}else{
								$("#event_nokori"+(i+1)).show();
							}
						// データがない場合は非表示にする
						}else{
							$("#event_list"+(i+1)).hide();
						}
					}
				}
		})
		.fail( (rtn) => {
//						$('#pass_1').html('システムエラーが発生しました。');
			return false;
		})
		.always( (rtn) => {
		});

}

/************************************************************
*会員情報データ取得・画面表示（ページングあり）
*************************************************************/
function getDataJobList(pageNo){

	// 画面表示件数
	deta_show_count = 5;
	first_data_count = (pageNo - 1) * deta_show_count;

   $.ajax({
        url:  '../../classes/mypageGetJobList.php',
        type: 'POST'
        })
        .done( (rtn) => {

            // 求人情報、該当なし
            if (rtn == 0) {
				$("#jobList_list1").show();
	            $("#jobList_naiyo1").html("求人情報がございません");
				$("#jobList_button1").hide();
				$("#jobList_new1").hide();
				// イベント表示件数5件分ループ処理する
				for(var i = 1; i < 5 ; i++) {
					// データがない場合は非表示にする
					$("#jobList_list"+(i+1)).hide();
					$("#jobList_new"+(i+1)).hide();
				}
			} else {

                jobList = JSON.parse(rtn);
				
				j=first_data_count;

				// 求人表示件数分ループ処理する
				for(var i = 1; i <= deta_show_count ; i++) {

					// データがある場合はデータをセットする
					if(j < jobList.length){
						$("#jobList_list"+(i)).show();
			            $("#jobList_naiyo"+(i)).html(jobList[j]["naiyo"]);
						if(jobList[j]["shinchaku"] == 0){
							$("#jobList_new"+(i)).hide();
						}else{
						$("#jobList_new"+(i)).show();
						}
						if(jobList[j]["betsugamen"] == 1){$wkWindow ="_blank";}else{$wkWindow ="_self";}
						if(jobList[j]["size_shitei_kbn"] == 1){
							$wkWindowSize ="width=" + jobList[j]["yokohaba"] + ",height=" + jobList[j]["tatehaba"];
						}else{
							$wkWindowSize ="";
						}
						$wk="window.open('" + jobList[j]["url"] + "', '" + $wkWindow + "', '" + $wkWindowSize + "')";
						$("#jobList_naiyo"+(i)).attr("onClick", $wk);
					// データがない場合は非表示にする
					}else{
						$("#jobList_list"+(i)).hide();
						$("#jobList_new"+(i)).hide();
					}
					j++;
				}

				$("#jobList_page_before").show();
				$("#jobList_page2").show();
				$("#jobList_page3").show();
				$("#jobList_page_next").show();

				if(pageNo <= 3){
					$("#jobList_page_before").hide();
				}

				if(pageNo == 1){
					$("#jobList_pageNo_1").val(1);
					$("#jobList_pageNo_2").val(2);
					$("#jobList_pageNo_3").val(3);
					$("#jobList_pageNo_n").val(4);
					$("#jobList_page1").html(1);
					$("#jobList_page2").html(2);
					$("#jobList_page3").html(3);
					$('#jobList_page1').css('pointer-events', 'none');
					$('#jobList_page2').css('pointer-events', 'auto');
					$('#jobList_page3').css('pointer-events', 'auto');
				}else if(pageNo != 2 && (pageNo + 1) * deta_show_count > jobList.length){
					$("#jobList_pageNo_b").val(pageNo - 3);
					$("#jobList_pageNo_1").val(pageNo - 2);
					$("#jobList_pageNo_2").val(pageNo - 1);
					$("#jobList_pageNo_3").val(pageNo);
					$("#jobList_pageNo_n").val(pageNo + 1);
					$("#jobList_page1").html(pageNo - 2);
					$("#jobList_page2").html(pageNo - 1);
					$("#jobList_page3").html(pageNo);
					$('#jobList_page1').css('pointer-events', 'auto');
					$('#jobList_page2').css('pointer-events', 'auto');
					$('#jobList_page3').css('pointer-events', 'none');
				}else{
					$("#jobList_pageNo_b").val(pageNo - 2);
					$("#jobList_pageNo_1").val(pageNo - 1);
					$("#jobList_pageNo_2").val(pageNo);
					$("#jobList_pageNo_3").val(pageNo + 1);
					$("#jobList_pageNo_n").val(pageNo + 2);
					$("#jobList_page1").html(pageNo - 1);
					$("#jobList_page2").html(pageNo);
					$("#jobList_page3").html(pageNo + 1);
					$('#jobList_page1').css('pointer-events', 'auto');
					$('#jobList_page2').css('pointer-events', 'none');
					$('#jobList_page3').css('pointer-events', 'auto');
				}
				

				if($("#jobList_pageNo_1").val() * deta_show_count > jobList.length){
					$("#jobList_page2").hide();
				}
				if($("#jobList_pageNo_2").val() * deta_show_count > jobList.length){
					$("#jobList_page3").hide();
				}
				if($("#jobList_pageNo_3").val() * deta_show_count >= jobList.length){
					$("#jobList_page_next").hide();
				}
			}

        })
        .fail( (rtn) => {
//                    $('#err_msg').html('システムエラーが発生しました。');
                return false;
        })
        .always( (rtn) => {
        });

}

/************************************************************
	// お知らせ情報ページング処理
*************************************************************/
     $("#infoList_page1").click(function() {
		getDataInfoList(parseInt($("#infoList_pageNo_1").val()));
        });

     $("#infoList_page2").click(function() {
		getDataInfoList(parseInt($("#infoList_pageNo_2").val()));
        });

     $("#infoList_page3").click(function() {
		getDataInfoList(parseInt($("#infoList_pageNo_3").val()));
        });

     $("#infoList_page_before").click(function() {
		getDataInfoList(parseInt($("#infoList_pageNo_b").val()));
        });

     $("#infoList_page_next").click(function() {
		getDataInfoList(parseInt($("#infoList_pageNo_n").val()));
        });

/************************************************************
	// 求人情報ページング処理
*************************************************************/

     $("#jobList_page1").click(function() {
		getDataJobList(parseInt($("#jobList_pageNo_1").val()));
        });

     $("#jobList_page2").click(function() {
		getDataJobList(parseInt($("#jobList_pageNo_2").val()));
        });

     $("#jobList_page3").click(function() {
		getDataJobList(parseInt($("#jobList_pageNo_3").val()));
        });

     $("#jobList_page_before").click(function() {
		getDataJobList(parseInt($("#jobList_pageNo_b").val()));
        });

     $("#jobList_page_next").click(function() {
		getDataJobList(parseInt($("#jobList_pageNo_n").val()));
        });



/************************************************************
	*【会員種別の変更】リンク押下時
*************************************************************/
$('#goChangeSbt').on('click', function() {

	window.location.href = '../changeSbt/';

});
/************************************************************
	*【パスワード再発行】ボタン押下時
*************************************************************/
$('#goReissuePassword').on('click', function() {

	window.location.href = '../reissuePassword/';

});
/************************************************************
	*【パスワード再発行】ボタン押下時
*************************************************************/
$('#goReissuePassword').on('click', function() {

	window.location.href = '../reissuePassword/';

});

/************************************************************
	*【登録情報修正】ボタン押下時
*************************************************************/
$('#goChangeMember').on('click', function() {

	window.location.href = '../changeMember/';

});

/************************************************************
	*【メールアドレスの変更】ボタン押下時
*************************************************************/
$('#goChangeMail').on('click', function() {

alert("メールアドレスの変更");
//	window.location.href = '../changeMember/';

});

/************************************************************
	*【保険に入る】ボタン押下時
*************************************************************/
$('#goInsurance').on('click', function() {

alert("保険に入る");
//	window.location.href = '../changeMember/';

});

/************************************************************
	*【試験申込】ボタン押下時
*************************************************************/
$('#goSelectCSCSCPT').on('click', function() {

	window.location.href = '../selectCSCSCPT/';

});

/************************************************************
	*【試験申込内容状況】ボタン押下時
*************************************************************/
$('#goCheckEntryStatus').on('click', function() {

	window.location.href = '../checkEntryStatus/';

});

/************************************************************
	*【CEU報告はこちら】リンク押下時
*************************************************************/
$('#goCeuReport').on('click', function() {

	window.location.href = '../ceuReport/';

});

/************************************************************
	*【CEUクイズ】ボタン押下時
*************************************************************/
$('#goCeuQuizlist').on('click', function() {

	window.location.href = '../ceuQuizlist/';

});

/************************************************************
	*【内訳詳細を見る】ボタン押下時
*************************************************************/
$('#goCeuGetList').on('click', function() {

	window.location.href = '../ceuGetList/';

});

/************************************************************
	*お知らせ　ボタン押下時
*************************************************************/

$('.info-buttons-area').on('click', 'button', function() {
 
	var url = $(this).data('id');
	window.location.href = url;

});

/************************************************************
	*もっと見る（イベント）　リンク押下時
*************************************************************/

$('#goSeminarList').on('click', function() {
 
	window.location.href = '../seminarList/';

});

/************************************************************
	*お申込（イベント）　ボタン押下時
*************************************************************/

$('.event-buttons-area').on('click', 'button', function() {
 
	var ceu_id = $(this).data('id');
	$("#ceu_id").val(ceu_id);
    $('#event_form').attr('action', '../seminarEntryVis');
    $("#event_form").submit();

});

/************************************************************
	*申込情報　キャンセルはこちらリンク押下時
*************************************************************/

$('.apply-buttons-area').on('click', 'a', function() {
 
	var i = $(this).data('id');
	$("#id").val(tbApplyJoho[i]["id"]);
	$("#settleno").val(tbApplyJoho[i]["settleno"]);
	$("#ceu_id").val(tbApplyJoho[i]["ceu_id"]);
	$("#event_kbn").val(tbApplyJoho[i]["event_kbn"]);
	$("#shutoku_naiyo").val(tbApplyJoho[i]["shutoku_naiyo"]);

    $('#cancel_form').attr('action', '../entryCancel');
    $("#cancel_form").submit();

});

/************************************************************
	*支払情報　領収書ボタン押下時
*************************************************************/

$('.payment-buttons-area').on('click', 'button', function() {
 
	window.open("about:blank", 'printReceipt',"width=600,height=800");
	var keiri_id = $(this).data('id');
	$("#keiri_id").val(keiri_id);
    $('#printReceipt_form').attr('action', '../printReceipt');
    $("#printReceipt_form").submit();

});

/************************************************************
	*【パーソナルトレーナーサポートツール】ボタン押下時
*************************************************************/
$('#goPTSTool').on('click', function() {

//	window.location.href = '../ceuGetList/';
alert("パーソナルトレーナーサポートツール");

});

/************************************************************
	*【S&C資料集】ボタン押下時
*************************************************************/
$('#goSAndCDocument').on('click', function() {

//	window.location.href = '../ceuGetList/';
alert("S&C資料集");

});

/************************************************************
	*【HPC施設利用申込手続きへ】ボタン押下時
*************************************************************/
$('#goHpcUse').on('click', function() {

	window.location.href = '../useHpcList/';

});








    });

})(jQuery);

