(function($){
    $(document).ready(function(){

        //alert("aaaa");
/***************************************
* 送信ボタン押下時、メールを送信する
****************************************/
$("#button").click(function () {






/***************************************
* 出願状況確認へボタン押下時、一つ前の画面に戻る
****************************************/
$("#button btn_gray").click(function () {
    url = '../checkEntryStatus/';
    $('form').attr('action', url);
    $('form').submit();
});


    });
})(jQuery);
