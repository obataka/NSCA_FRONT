(function($){
    $(document).ready(function(){

        /***********************************************
        * 選択済みのラジオボタン、テキストエリア初期表示処理
        ************************************************/
        //退会理由ラジオボタン
        var sel_riyu = $('#sel_riyu').val();
        if (sel_riyu != "") {
            $('input:radio[name="riyu"]').val([sel_riyu]);
        }
        //ご案内希望ラジオボタン
        var sel_annai = $('#sel_annai').val();
        if (sel_annai != "") {
            $('input:radio[name="annai"]').val([sel_annai]);
        }
        /********************************
        * 次へボタン押下時のエラーチェック
        ********************************/
        $("#next_button").click(function() {  
            $("#error1").html("");
            $("#error2").html("");
            $("#error3").html("");
            var wk_err_msg = "";
            //退会理由のラジオボタンが選択されているかチェック
            if (!$("input:radio[name='riyu']:checked").val()) {
                //チェックされていない場合
                wk_err_msg = "";
                wk_err_msg = "退会理由を選択してください。";
                $("#error1").html(wk_err_msg);
            }
            //退会理由が入力されているかチェック
            var riyu = $('#taikai_riyu').val();  
            if (riyu == "") {
                //チェックされていない場合
                wk_err_msg = "";
                wk_err_msg = "退会の理由をお聞かせください";
                $("#error2").html(wk_err_msg);
            }
            //ご案内希望のラジオボタンが選択されているかチェック
            if (!$("input:radio[name='annai']:checked").val()) {
                //チェックされていない場合
                wk_err_msg = "";
                wk_err_msg = "ご案内希望を選択してください。";
                $("#error3").html(wk_err_msg);
            }
            //エラーがある場合、処理を中断する
            if (wk_err_msg != "") {
                return false;
            }
            //退会理由のvalueとtextセット
            if ($("input:radio[name='riyu']:checked").val()) {        
                var riyu = $("input:radio[name='riyu']:checked").val();
                $("#sel_riyu").val(riyu);
                var test1 = $('[name="riyu"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_riyu_txt').val(test2);
            }
             //退会理由記述セット
             riyu_kijutsu = $('textarea[id="taikai_riyu"]').val();
             $('#textarea').val(riyu_kijutsu);

            //案内希望のvalueとtextセット
            if ($("input:radio[name='annai']:checked").val()) {        
                var annai = $("input:radio[name='annai']:checked").val();
                $("#sel_annai").val(annai);
                var test1 = $('[name="annai"]:checked').attr('id');
                var test2 = $('label[for="' + test1 + '"]').text();
                $('#sel_annai_txt').val(test2);  
            }
            //エラーがない場合確認画面に画面遷移
            url = '../unsubscrideConfirm/';
            $('form').attr('action', url);
            $('form').submit();
        });

        /***************************************
        * クリアボタン押下時、フォーム内をクリアする
        ****************************************/
        $(".btn_gray").bind("click", function(){
            $('textarea').val("");
            $('input:radio').prop("checked", false);
            $("#error1").html("");
            $("#error2").html("");
            $("#error3").html("");
        });

    });
})(jQuery);
