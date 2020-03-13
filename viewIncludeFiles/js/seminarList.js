(function ($) {
    $(document).ready(function () {

        //全レコードを格納する配列
        var getCeuConference = [];
        var getCeuJoho = [];
        var getCeuToreken = [];

        //イベント種別名称を格納する配列
        var getEventSbt = [];

        /********************************
       * 初期表示処理
       ********************************/

        jQuery.ajax({
            url: '../../classes/getEventSbt.php',
        }).done((rtn) => {
            getEventSbt = JSON.parse(rtn);

            $.each(getEventSbt, function (i, val) {
                //イベント区分を表示させる
                $('#event').append(
                    '<tr id="tr_' + val['meisho_cd'] + '">' +
                        '<th>' +
                            '<span class="sub">' + val['meisho'] + '</span>' +
                        '</th>' +
                        '<td>' +
                        '</td>' +
                    '</tr>'
                );
            });

            //CEUカンファレンス情報
            jQuery.ajax({
                url: '../../classes/getCeuConference.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuConference = JSON.parse(rtn);
                    $.each(getCeuConference, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>' +
                                '<td>' +
                                    val['shutoku_naiyo'] +
                                '</td>' +
                                '<td>' +
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" value="tb_ceu_conference_joho-'+ val['ceu_id'] +'"><span>申請</span></button>' +
                                    '</div>' +
                                '</td>' +
                            '<tr>'
                        );
                    });

                }
            }).fail((rtn) => {
                return false;
            });

            //CEU情報
            jQuery.ajax({
                url: '../../classes/getCeuJoho.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuJoho = JSON.parse(rtn);
                    $.each(getCeuJoho, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>' +
                                '<td>' +
                                    val['shutoku_naiyo'] +
                                '</td>' +
                                '<td>' +
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" value="tb_ceu_joho-'+ val['ceu_id'] +'"><span>申請</span></button>' +
                                    '</div>' +
                                '</td>' +
                            '<tr>'
                        );
                    });
                }
            }).fail((rtn) => {
                return false;
            });

            //トレ検情報
            jQuery.ajax({
                url: '../../classes/getToreken.php',
            }).done((rtn) => {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {
                    getCeuToreken = JSON.parse(rtn);
                    $.each(getCeuToreken, function (i, val) {
                        //イベント内容表示
                        $('#tr_' + val['event_kbn']).after(
                            '<tr>' +
                                '<td>' +
                                    val['kentei_title'] +
                                '</td>' +
                                '<td>' +
                                    '<div class="btn">' +
                                        '<button class="button" onclick="location.href=\'' + val['moshikomi_mae_annai_url'] + '\'"><span>詳細</span></button>' +
                                        '<button class="button shinsei" value="tb_toreken_joho-'+ val['ceu_id'] +'"><span>申請</span></button>' +
                                    '</div>' +
                                '</td>' +
                            '<tr>'
                        );
                    });
                }
            }).fail((rtn) => {
                return false;
            });

        }).fail((rtn) => {
            return false;
        });

        //申請ボタン押下時処理
        $(document).on("click", ".shinsei", function () {
            //ログイン有りの場合
            if ($('#kaiin_no').val()) {
                //ボタンのvalueをテーブル名とidに分ける
                var btn_val = $(this).val().split('-');
                var tb_name = btn_val[0];
                var ceu_id = btn_val[1];
                //テーブル名とidをhiddenタグにセットする
                $('#tb_name').val(tb_name);
                $('#ceu_id').val(ceu_id);
                //申込内容確認画面に遷移する
                url = '../seminarConfirm/';
                $('form').attr('action', url);
                $('form').submit();
            //ログインなしの場合
            } else {
                //ボタンのvalueをテーブル名とidに分ける
                var btn_val = $(this).val().split('-');
                var tb_name = btn_val[0];
                var ceu_id = btn_val[1];
                //テーブル名とidをhiddenタグにセットする
                $('#tb_name').val(tb_name);
                $('#ceu_id').val(ceu_id);
                //申込入力画面に遷移する
                url = '../seminarEntryVis/';
                $('form').attr('action', url);
                $('form').submit();
            }
        });
    });

})(jQuery);