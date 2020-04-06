(function ($) {
	$(document).ready(function () {

		/**
		*** 戻るボタン押下時
		**/
		$("#__goBack").click(function () {
			let folderName = $("#tranScreen").val();
			url = '../' + folderName + '/';
			$('form').attr('action', url);
			$('form').submit();
		});

		/**
		 * カード決済支払い開始ボタンクリック処理
		 */
		$('#pay_credit_start').click(function() {

			// 決済種別を取得

            $.ajax({
                url: '../../classes/paymentSelect_checkFregiSettle.php',
                type: 'POST'
            })
            .done( (payMode) => {

                switch (payMode) {
                    case '1':
                        $.ajax({
                            url: '../../classes/paymentSelect_applyFregiCompSettle.php',
                            type: 'POST'
                        })
                        .done( (result) => {
                            return;
                        })
                        .fail( () => {
                            $('#err_msg').html('システムエラーが発生しました。');
                            return;
                        });
                        break;

                    // *************************************************************************
                    //
                    // ※新規以外の決済種別の際の処理も実装すること
                    //
                    // *************************************************************************

                    default:
                }

                // location.href = '../cardInfoInput/'
            })
            .fail( () => {
                $('#err_msg').html('システムエラーが発生しました。');
                return;
            });
		})

		/**
		 * コンビニ支払い開始ボタンクリック処理
		 */
		$('#pay_cvs_start').click(function() {
			location.href = '../cvs/'
		})

	});



})(jQuery);
