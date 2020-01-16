(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
        jQuery.ajax({
        url:  '../../classes/getCeuQuizJoho.php',
            success: function(rtn) {
                // rtn = 0 の場合は、該当なし
                if (rtn == 0) {
                    return false;
                } else {

                    //※正常にCEUクイズ情報を取得できた時の処理
                    getCeuQuizJoho = JSON.parse(rtn);
                    console.log(getCeuQuizJoho);
                    $('#txt1').html(getCeuQuizJoho[0]["shutoku_naiyo"]);
                    $('#txt2').html(getCeuQuizJoho[1]["shutoku_naiyo"]);
                    //$('#txt3').html(getCeuQuizJoho[2]["shutoku_naiyo"]);

                    //1件目の関連記事URLがセットされていない場合、関連記事ボタンを非表示にする
                    var kiji1 = getCeuQuizJoho[0]["kanren_kiji_url"];

                    if (kiji1 !== "") {
                        $(".kiji1").attr('onclick', 'location.href=' + "'" + kiji1 + "'");
                    } else {               
                        $('.kiji1').hide();
                    }

                    //2件目の関連記事URLがセットされていない場合、関連記事ボタンを非表示にする
                    var kiji2 = getCeuQuizJoho[1]["kanren_kiji_url"];

                    if (kiji2 !== "") {
                        $(".kiji2").attr('onclick', 'location.href=' + "'" + kiji2 + "'");
                    } else {               
                        $('.kiji2').hide();
                    }
                    
                    //3件目の関連記事URLがセットされていない場合、関連記事ボタンを非表示にする
                    // var kiji3 = getCeuQuizJoho[2]["kanren_kiji_url"];

                    // if (kiji3 !== "") {
                    //     $(".kiji3").attr('onclick', 'location.href=' + "'" + kiji3 + "'");
                    // } else {               
                    //     $('.kiji3').hide();
                    // }


                    //参加者登録して未納入の場合、又は納入していても合格している場合は解答ボタンを非表示にする

                    //1行目
                    var nonyubi1  = getCeuQuizJoho[0]["nonyubi"];
                    var sankaryo1 = getCeuQuizJoho[0]["sankaryo"];
                    var gohi_kbn1 = getCeuQuizJoho[0]["gohikbn_"];
                    var ceu_id1   = getCeuQuizJoho[0]["ceu_id"];

                    if (nonyubi1 == "" && sankaryo1 == "0.00" || gohi_kbn1 !== 2) {
                       
                        //$('.kaito1').hide();
                        $('#ceu_id1').val(ceu_id1);
                    } else {

                        //解答ボタンが有効の場合、ceuidをhiddenにセット
                        $('#ceu_id1').val(ceu_id1);

                    }

                    //2行目
                    var nonyubi2  = getCeuQuizJoho[1]["nonyubi"];
                    var sankaryo2 = getCeuQuizJoho[1]["sankaryo"];                
                    var gohi_kbn2 = getCeuQuizJoho[1]["gohikbn_"];
                    var ceu_id2   = getCeuQuizJoho[1]["ceu_id"];

                    if (nonyubi2 == "" && sankaryo2 == "0.00" || gohi_kbn2 !== 2) {
                        
                        //$('.kaito2').hide();

                    } else {

                        //解答ボタンが有効の場合、ceuidをhiddenにセット
                        $('#ceu_id2').val(ceu_id2);
                        
                    }

                    //3行目
                    // var nonyubi3  = getCeuQuizJoho[2]["nonyubi"];
                    // var sankaryo3 = getCeuQuizJoho[2]["sankaryo"];                
                    // var gohi_kbn3 = getCeuQuizJoho[2]["gohikbn_"];
                    // var ceu_id3   = getCeuQuizJoho[2]["ceu_id"];

                    // if (nonyubi3 == "" && sankaryo3 == "0.00" || gohi_kbn3 !== 2) {
                        
                    //     $('.kaito3').hide();

                    // } else {

                    //     //解答ボタンが有効の場合、ceuidをhiddenにセット
                    //     $('#ceu_id3').val(ceu_id3);
                        
                    // }     

                }
            },
            fail: function(rtn) {
                return false;
            },
            error: function(rtn) {
                return false;
            }
        });

        //解答ボタンが押された時の処理
        $(".kaito1").click(function() {

            //1行目の解答ボタンが押された時、クイズテキストをhidden項目にセットする
            var quiz_txt = $('#txt1').html();
            $('#quiz_txt').val(quiz_txt);
            
            //解答入力画面に画面遷移
            url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();
        });

        $(".kaito2").click(function() {
            
            //2行目の解答ボタンが押された時、クイズテキストをhidden項目にセットする
            var quiz_txt = $('#txt2').html();
            $('#quiz_txt').val(quiz_txt);

            //解答入力画面に画面遷移
            url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();
        });

        $(".kaito3").click(function() {
            
            //2行目の解答ボタンが押された時、クイズテキストをhidden項目にセットする
            var quiz_txt = $('#txt3').html();
            $('#quiz_txt').val(quiz_txt);

            //解答入力画面に画面遷移
            url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();
        });
        
    });


})(jQuery);
