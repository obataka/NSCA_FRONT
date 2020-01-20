(function ($) {

	$(document).ready(function () {

		/**
		*** 内容を修正するボタン押下時に値を保持して画面遷移する
		**/
		$("#return_button").click(function () {
			url = '../registMember/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/**
		*** 次へボタン押下時に値を保持して決済方法選択に画面遷移する。
		**/
		$("#next_button").click(function () {

			// HIDDENデータをSESSIONに積込む処理
			$.ajax({
				url:  '../../classes/setMemDataToSess.php',
				type: 'POST',
				data:{
					//会員情報のテーブル項目
					kaiinType: $("#kaiinType").val(),
					kaiinSbt: $("#kaiinSbt").val(),
					sel_option: $("#sel_option").val(),
					wk_sel_option: $("#wk_sel_option").val(),
					sel_riyu: $("#sel_riyu").val(),
					wk_sel_riyu: $("#wk_sel_riyu").val(),
					sel_riyu_sonota: $("#sel_riyu_sonota").val(),
					sel_hoji: $("#sel_hoji").val(),
					wk_sel_hoji: $("#wk_sel_hoji").val(),
					file_front: $("#filepath_front").val(),
					file_back: $("#filepath_back").val(),
					name_mei: $("#name_mei").val(),
					name_sei: $("#name_sei").val(),
					name_sei_kana: $("#name_sei_kana").val(),
					name_mei_kana: $("#name_mei_kana").val(),
					name_last: $("#name_last").val(),
					name_first: $("#name_first").val(),
					year: $("#year").val(),
					month: $("#month").val(),
					day: $("#day").val(),
					sel_gender: $("#sel_gender").val(),
					wk_sel_gender: $("#wk_sel_gender").val(),
					sel_nagareyama: $("#sel_nagareyama").val(),
					wk_sel_nagareyama: $("#wk_sel_nagareyama").val(),
					sel_math: $("#sel_math").val(),
					yubin_nb_1: $("#yubin_nb_1").val(),
					yubin_nb_2: $("#yubin_nb_2").val(),
					address_shiku: $("#address_shiku").val(),
					address_tatemono: $("#address_tatemono").val(),
					address_yomi_shiku: $("#address_yomi_shiku").val(),
					address_yomi_tatemono: $("#address_yomi_tatemono").val(),
					tel: $("#tel").val(),
					keitai_tel: $("#keitai_tel").val(),
					fax: $("#fax").val(),
					mail_address_1: $("#mail_address_1").val(),
					mail_address_2: $("#mail_address_2").val(),
					wk_sel_mail: $("#wk_sel_mail").val(),
					sel_mail: $("#sel_mail").val(),
					wk_sel_merumaga: $("#wk_sel_merumaga").val(),
					sel_merumaga: $("#sel_merumaga").val(),
					pass_1: $("#pass_1").val(),
					url: $("#url").val(),
					shoku_1: $("#shoku_1").val(),
					shoku_2: $("#shoku_2").val(),
					shoku_3: $("#shoku_3").val(),
					sel_shoku_1: $("#sel_shoku_1").val(),
					sel_shoku_2: $("#sel_shoku_2").val(),
					sel_shoku_3: $("#sel_shoku_3").val(),
					office_name: $("#office_name").val(),
					office_yubin_nb_1: $("#office_yubin_nb_1").val(),
					office_yubin_nb_2: $("#office_yubin_nb_2").val(),
					sel_office_math: $("#sel_office_math").val(),
					office_shiku: $("#office_shiku").val(),
					office_tatemono: $("#office_tatemono").val(),
					office_tel: $("#office_tel").val(),
					office_fax: $("#office_fax").val(),
					sel_shikaku: $("#sel_shikaku").val(),
					wk_sel_shikaku: $("#wk_sel_shikaku").val(),
					sel_shikaku_sonota: $("#sel_shikaku_sonota").val(),
					sel_bunya: $("#sel_bunya").val(),
					wk_sel_bunya: $("#wk_sel_bunya").val(),
					sel_bunya_sonota: $("#sel_bunya_sonota").val(),
					sel_k_chiiki: $("#sel_k_chiiki").val(),
					wk_sel_k_chiiki: $("#wk_sel_k_chiiki").val(),
					sel_hoho: $("#sel_hoho").val(),
					wk_sel_hoho: $("#wk_sel_hoho").val(),
					sel_web: $("#sel_web").val(),
					wk_sel_web: $("#wk_sel_web").val(),
					sel_yubin: $("#sel_yubin").val(),
					wk_sel_yubin: $("#wk_sel_yubin").val(),
					sel_qa: $("#sel_qa").val(),
					wk_sel_qa: $("#wk_sel_qa").val(),
					sel_chiiki: $("#sel_chiiki").val(),
					sel_office_chiiki: $("#sel_office_chiiki").val(),
					kenmei: $("#kenmei").val(),
					tranScreen: 'confirmMember'
				}
			})

			// Ajaxリクエストが成功した時発動
			.done( (data) => {
				url = '../paymentSelectNoLogin/';
				$('form').attr('action', url);
				$('form').submit();
			})

			// Ajaxリクエストが失敗した時発動
			.fail( (data) => {
				console.log(data);
			})

			// Ajaxリクエストが成功・失敗どちらでも発動
			.always( (data) => {
			});
		});
	});
})(jQuery);