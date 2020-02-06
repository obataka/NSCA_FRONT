(function ($) {

	$(document).ready(function () {

		/********************************
        * イベント情報表示処理
        ********************************/
		jQuery.ajax({
			url: '../../classes/getEventJoho.php',
			type: 'POST',
			data: {
				tb_name: $('#tb_name').val(),
				ceu_id: $('#ceu_id').val(),
			}
		}).done((rtn) => {
			getEventJoho = JSON.parse(rtn);
			//イベント区分表示
			jQuery.ajax({
				url: '../../classes/getEventSbt.php',
			}).done((rtn) => {
				getEventSbt = JSON.parse(rtn);
				$.each(getEventSbt, function (i, val) {
					if (val['meisho_cd'] == getEventJoho[0]['event_kbn']) {
						$('#event_sbt').after(val['meisho']);
					}
				});
			}).fail((rtn) => {
				return false;
			});

			//イベント名、開催日、参加費
			if ($('#tb_name').val() == 'tb_toreken_joho') {
				$('#event_name').append(getEventJoho[0]['kentei_title']);
				$('#event_day').append(getEventJoho[0]['kaisaibi'].slice(0, 10).split('-').join('/'));
				$('#event_hiyo').append(getEventJoho[0]['ippan_sankaryo'] + '円');
			} else {
				$('#event_name').append(getEventJoho[0]['shutoku_naiyo']);
				$('#event_day').append(getEventJoho[0]['shutokubi'].slice(0, 10).split('-').join('/'));

				if ($('#tb_name').val() == 'tb_ceu_conference_joho') {

					//会員種別によって、表示内容を変える
					if ($('#kaiin_no').val() != "") {
						//会員種別取得
						jQuery.ajax({
							url: '../../classes/getKaiinSbt.php',
							type: 'POST',
						}).done((rtn) => {
							wk_kaiin_sbt = JSON.parse(rtn);
							switch (wk_kaiin_sbt['kaiin_sbt_kbn']) {
								//利用会員の場合
								case "0":
									$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['riyo_toroku_ryojitsu_sankaryo']) + '円<br>');
									$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['riyo_toroku_1_nichime_sankaryo']) + '円<br>');
									$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['riyo_toroku_2_nichime_sankaryo']) + '円<br>');
									break;
								//正会員の場合
								case "1":
									$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_ryojitsu_sankaryo']) + '円<br>');
									$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_1_nichime_sankaryo']) + '円<br>');
									$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_2_nichime_sankaryo']) + '円<br>');
									break;
								//学生会員の場合
								case "2":
									$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_ryojitsu_sankaryo']) + '円<br>');
									$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_1_nichime_sankaryo']) + '円<br>');
									$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_2_nichime_sankaryo']) + '円<br>');
									break;
							}
						}).fail((rtn) => {
							return false;
						});

					} else {
						//一般の場合
						$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['ippan_ryojitsu_sankaryo']) + '円<br>');
						$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['ippan_1_nichime_sankaryo']) + '円<br>');
						$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['ippan_2_nichime_sankaryo']) + '円<br>');
					}
					$('#event_hiyo').append('懇親会参加料:' + Math.floor(getEventJoho[0]['konshinkai_sankaryo']) + '円<br>');
				} else {
					$('#event_hiyo').append(Math.floor(getEventJoho[0]['ippan_sankaryo']) + '円');
				}
			}

		}).fail((rtn) => {
			return false;
		});

		/********************************
        * 会員情報表示処理
        ********************************/
	   //イベント一覧から遷移してきた場合、DBの会員情報を表示させる。
		if ($('#kaiin_no').val() != "") {
			jQuery.ajax({
				url: '../../classes/getTbkaiinJoho.php',
			}).done((rtn) => {
				// rtn = 0 の場合は、該当なし
				if (rtn == 0) {
					return false;
				} else {
					
				}
			}).fail((rtn) => {
				return false;
			});
		}

		/********************************
		* 登録情報修正画面に画面遷移する
		********************************/
		$("#change").click(function () {
			location.href = '../changeMember/';
		});

		/********************************
		* 遷移元がイベント一覧の場合、イベント一覧に、
		* イベント申込入力の場合、イベント申込入力に画面遷移する。
		********************************/
		$("#return").click(function () {
			url = '../' + $('#screen_name').val() + '/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/*********************************
		* 次へボタン押下時に値を保持して決済方法選択に画面遷移する。
		**********************************/
		$("#next").click(function () {

			// // HIDDENデータをSESSIONに積込む処理
			// $.ajax({
			// 	url:  '../../classes/setMemDataToSess.php',
			// 	type: 'POST',
			// 	data:{
			// 	}
			// })

			// // Ajaxリクエストが成功した時発動
			// .done( (data) => {
			// 	url = '../paymentSelectNoLogin/';
			// 	$('form').attr('action', url);
			// 	$('form').submit();
			// })

			// // Ajaxリクエストが失敗した時発動
			// .fail( (data) => {
			// 	console.log(data);
			// })

			// // Ajaxリクエストが成功・失敗どちらでも発動
			// .always( (data) => {
			// });
		});
	});
})(jQuery);