(function($){
    $(document).ready(function(){
        
        
        
        
        
        
        
        $(".btn_gray").click(function() {
            url = '../unsubscride/';
            $('form').attr('action', url);
            $('form').submit();
        });
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        
        // /********************************
        // * 次へボタン押下時のエラーチェック
        // ********************************/
        // $(".button").click(function() {  
        //     $("#error1").html("");
        //     $("#error2").html("");
        //     $("#error3").html("");
        //     var wk_err_msg = "";
        //     //退会理由のラジオボタンが選択されているかチェック
        //     if (!$("input:radio[name='riyu']:checked").val()) {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "退会理由を選択してください。";
        //         $("#error1").html(wk_err_msg);
        //     }
        //     //退会理由が入力されているかチェック
        //     var riyu = $('#taikai_riyu').val();  
        //     if (riyu == "") {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "退会の理由をお聞かせください";
        //         $("#error2").html(wk_err_msg);
        //     }
        //     //ご案内希望のラジオボタンが選択されているかチェック
        //     if (!$("input:radio[name='annai']:checked").val()) {
        //         //チェックされていない場合
        //         wk_err_msg = "";
        //         wk_err_msg = "ご案内希望を選択してください。";
        //         $("#error3").html(wk_err_msg);
        //     }
        //     //エラーがある場合、処理を中断する
        //     if (wk_err_msg != "") {
        //         return false;
        //     }
        //     //退会理由のvalueとtextセット
        //     if ($("input:radio[name='riyu']:checked").val()) {        
        //         var riyu = $("input:radio[name='riyu']:checked").val();
        //         $("#sel_riyu").val(riyu);
        //         var test1 = $('[name="riyu"]:checked').attr('id');
        //         var test2 = $('label[for="' + test1 + '"]').text();
        //         $('#sel_riyu_txt').val(test2);
        //     }
        //     //案内希望のvalueとtextセット
        //     if ($("input:radio[name='annai']:checked").val()) {        
        //         var annai = $("input:radio[name='annai']:checked").val();
        //         $("#sel_annai").val(annai);
        //         var test1 = $('[name="annai"]:checked').attr('id');
        //         var test2 = $('label[for="' + test1 + '"]').text();
        //         $('#sel_annai_txt').val(test2);  
        //     }        
        // });

        // /***************************************
        // * クリアボタン押下時、フォーム内をクリアする
        // ****************************************/
        // $(".btn_gray").bind("click", function(){
        //     $('textarea').val("");
        //     $('input:radio').prop("checked", false);
        // });

    });
})(jQuery);
