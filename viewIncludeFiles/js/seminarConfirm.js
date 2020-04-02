(function ($) {

	$(document).ready(function () {

		/********************************
        * イベント情報表示処理
        ********************************/

        $.ajax({
			url: '../../classes/getEventJoho.php',
			type: 'POST',
			data: {
				tb_name: $('#tb_name').val(),
				ceu_id: $('#ceu_id').val(),
			}
		}).done((rtn) => {
			getEventJoho = JSON.parse(rtn);
			//イベント区分表示
			$('#sel_event_sbt').val(getEventJoho[0]['event_kbn']);

        $.ajax({
				url: '../../classes/getEventSbt.php'
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

				$('#sel_event_name').val(getEventJoho[0]['kentei_title']);
				$('#sel_event_day').val(getEventJoho[0]['kaisaibi']);
				$('#sel_event_hiyo_ippan').val(getEventJoho[0]['ippan_sankaryo']);
			} else {
				$('#event_name').append(getEventJoho[0]['shutoku_naiyo']);
				$('#event_day').append(getEventJoho[0]['shutokubi'].slice(0, 10).split('-').join('/'));

				$('#sel_event_name').val(getEventJoho[0]['shutoku_naiyo']);
				$('#sel_event_day').val(getEventJoho[0]['shutokubi']);

				if ($('#tb_name').val() == 'tb_ceu_conference_joho') {

					//会員種別によって、表示内容を変える
					if ($('#kaiin_no').val() != "") {
						//会員種別取得
				        $.ajax({
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

									$('#sel_event_hiyo_ryojitsu').val(getEventJoho[0]['riyo_toroku_ryojitsu_sankaryo']);
									$('#sel_event_hiyo_1').val(getEventJoho[0]['riyo_toroku_1_nichime_sankaryo']);
									$('#sel_event_hiyo_2').val(getEventJoho[0]['riyo_toroku_2_nichime_sankaryo']);
									break;
								//正会員の場合
								case "1":
									$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_ryojitsu_sankaryo']) + '円<br>');
									$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_1_nichime_sankaryo']) + '円<br>');
									$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['conference_seikaiin_2_nichime_sankaryo']) + '円<br>');

									$('#sel_event_hiyo_ryojitsu').val(getEventJoho[0]['conference_seikaiin_ryojitsu_sankaryo']);
									$('#sel_event_hiyo_1').val(getEventJoho[0]['conference_seikaiin_1_nichime_sankaryo']);
									$('#sel_event_hiyo_2').val(getEventJoho[0]['conference_seikaiin_2_nichime_sankaryo']);
									break;
								//学生会員の場合
								case "2":
									$('#event_hiyo').append('両日参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_ryojitsu_sankaryo']) + '円<br>');
									$('#event_hiyo').append('1日目参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_1_nichime_sankaryo']) + '円<br>');
									$('#event_hiyo').append('2日目参加料:' + Math.floor(getEventJoho[0]['conference_gakuseikaiin_2_nichime_sankaryo']) + '円<br>');

									$('#sel_event_hiyo_ryojitsu').val(getEventJoho[0]['conference_gakuseikaiin_ryojitsu_sankaryo']);
									$('#sel_event_hiyo_1').val(getEventJoho[0]['conference_gakuseikaiin_1_nichime_sankaryo']);
									$('#sel_event_hiyo_2').val(getEventJoho[0]['conference_gakuseikaiin_2_nichime_sankaryo']);
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

						$('#sel_event_hiyo_ryojitsu').val(getEventJoho[0]['ippan_ryojitsu_sankaryo']);
						$('#sel_event_hiyo_1').val(getEventJoho[0]['ippan_1_nichime_sankaryo']);
						$('#sel_event_hiyo_2').val(getEventJoho[0]['ippan_2_nichime_sankaryo']);
					}
					$('#event_hiyo').append('懇親会参加料:' + Math.floor(getEventJoho[0]['konshinkai_sankaryo']) + '円<br>');
					$('#sel_event_hiyo_konshin').val(getEventJoho[0]['konshinkai_sankaryo']);
				} else {
					$('#event_hiyo').append(Math.floor(getEventJoho[0]['ippan_sankaryo']) + '円');
					$('#sel_event_hiyo_ippan').val(getEventJoho[0]['ippan_sankaryo']);
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
				$.ajax({
				url: '../../classes/getTbkaiinJoho.php'
			}).done((rtn) => {
				// rtn = 0 の場合は、該当なし
				if (rtn == 0) {
					return false;
				} else {
					getTbkaiinJoho = JSON.parse(rtn);
					//hidden項目に値をセット
					$('#name_sei').val(getTbkaiinJoho['shimei_sei']);
					$('#name_mei').val(getTbkaiinJoho['shimei_mei']);
					$('#name_sei_kana').val(getTbkaiinJoho['furigana_sei']);
					$('#name_mei_kana').val(getTbkaiinJoho['furigana_mei']);
					$('#yubin_nb_1').val(getTbkaiinJoho['yubin_no'].slice(0, 3));
					$('#yubin_nb_2').val(getTbkaiinJoho['yubin_no'].slice(3, 7));
					$('#kenmei').val(getTbkaiinJoho['ken_no']);
					$('#sel_math').val(getTbkaiinJoho['kemmei']);
					$('#address_shiku').val(getTbkaiinJoho['jusho_1']);
					$('#address_tatemono').val(getTbkaiinJoho['jusho_2']);
					$('#tel').val(getTbkaiinJoho['tel']);
					$('#bei_kaiin_no').val(getTbkaiinJoho['beikoku_kaiin_no']);
					$('#sel_shikaku').val(getTbkaiinJoho['beikoku_kaiin_shikaku_kbn']);

					//会員情報を表示させる
					$('#shimei').append(getTbkaiinJoho['shimei_sei'] + ' ' + getTbkaiinJoho['shimei_mei']);
					$('#furigana').append(getTbkaiinJoho['furigana_sei'] + ' ' + getTbkaiinJoho['furigana_mei']);
					$('#denwa_bango').append(getTbkaiinJoho['tel']);
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

			// HIDDENデータをSESSIONに積込む処理
			$.ajax({
				url: '../../classes/setSeminarDataToSess.php',
				type: 'POST',
				data: {

					//会員情報
					name_mei: $("#name_mei").val(),
					name_sei: $("#name_sei").val(),
					name_sei_kana: $("#name_sei_kana").val(),
					name_mei_kana: $("#name_mei_kana").val(),
					tel: $("#tel").val(),
					yubin_nb_1: $('#yubin_nb_1').val(),
					yubin_nb_2: $('#yubin_nb_2').val(),
					ken_no: $('#sel_math').val(),
					kemmei: $('#kenmei').val(),
					address_shiku: $('#address_shiku').val(),
					address_tatemono: $('#address_tatemono').val(),
					beikoku_kaiin_no: $('#bei_kaiin_no').val(),
					beikoku_kaiin_shikaku_kbn: $('#sel_shikaku').val(),

					//イベント情報
					event_sbt: $('#sel_event_sbt').val(),
					event_name: $('#sel_event_name').val(),
					event_day: $('#sel_event_day').val(),
					event_hiyo_ippan: $('#sel_event_hiyo_ippan').val(),
					event_hiyo_ryojitsu: $('#sel_event_hiyo_ryojitsu').val(),
					event_hiyo_1: $('#sel_event_hiyo_1').val(),
					event_hiyo_2: $('#sel_event_hiyo_2').val(),
					event_hiyo_konshin: $('#sel_event_hiyo_konshin').val(),

					tranScreen: 'seminarConfirm'
				}
			})

				// Ajaxリクエストが成功した時発動
				.done((data) => {
					url = '../paymentSelectNoLogin/';
					$('form').attr('action', url);
					$('form').submit();
				})

				// Ajaxリクエストが失敗した時発動
				.fail((data) => {
					return false;
				})
		});
	});
})(jQuery);