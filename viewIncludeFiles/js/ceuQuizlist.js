(function($){
    $(document).ready(function(){
    
        /*************
        * 初期画面表示
        **************/
        $.ajax({
        url:  '../../classes/getCeuQuizJoho.php',
        })
        .done( (rtn) => {
            // rtn = 0 の場合は、該当なし
            if (rtn == 0) {

                return false;

            } else {

                    //※正常にCEUクイズ情報を取得できた時の処理
                    getCeuQuizJoho = JSON.parse(rtn);

                    var i = 0;
                    $.each(getCeuQuizJoho,function(index, elem) {

                        // 設問が見つからなかったところで出力停止
                        if (elem.shutoku_naiyo == "") {
                            return false;
                        }
                        

                        // //動的にhiddenのinputタグを作成
                        // var input1 = $('<input>').attr({
                        //     type: 'hidden',
                        //     id: 'ceu_id' + [i] + '',
                        //     name: 'ceu_id[' + [i] + ']',
                        //     value: ''
                        // });
                        // $('form').prepend(input1);

                        // //動的にhiddenのinputタグを作成
                        // var input1 = $('<input>').attr({
                        //     type: 'hidden',
                        //     id: 'quiz_txt' + [i] + '',
                        //     name: 'quiz_txt[' + [i] + ']',
                        //     value: ''
                        // });
                        // $('form').prepend(input1);


                    //動的に<table>を作成
                    var table = '<tr>' 
                              + '<th id="txt' + [i] + '"></th>'
                              + '<td>'
                              + '<div class="btn">' 
                              + '<button class="button  test kaito' + [i] + '" value="" onclick="" location.href=""><span>解答</span></button>'
                              + '<button class="button kiji' + [i] + '" onclick="" location.href=""><span>関連記事</span></button>'
                              + '</div>'
                              + '</td>'
                              + '</tr>'

                    //<div>を作成
                    $("table").append(table);

                    $('#txt' + [i] + '').html(getCeuQuizJoho[i]["shutoku_naiyo"]);

                    
                    //1件目の関連記事URLがセットされていない場合、関連記事ボタンを非表示にする
                    var kiji = getCeuQuizJoho[i]["kanren_kiji_url"];

                    if (kiji !== "") {
                        $(".kiji" + [i] + "").attr('onclick', 'location.href=' + "'" + kiji + "'");
                    } else {               
                        $('.kiji' + [i] + '').hide();
                    }

                    

                    //参加者登録して未納入の場合、又は納入していても合格している場合は解答ボタンを非表示にする

                    //1行目
                    var nonyubi  = getCeuQuizJoho[i]["nonyubi"];
                    var sankaryo = getCeuQuizJoho[i]["sankaryo"];
                    var gohi_kbn = getCeuQuizJoho[i]["gohikbn_"];
                    var ceu_id   = getCeuQuizJoho[i]["ceu_id"];

                    if (nonyubi == "" && sankaryo == "0.00" || gohi_kbn !== 2) {
                       
                        $('.kaito1').hide();

                    } else {

                        //解答ボタンが有効の場合、ceuidをhiddenにセット
                        $('.kaito' + [i] + '').val(ceu_id);

                    }

                i = i + 1;

                });

                };
            })
            // Ajaxリクエストが失敗した時発動
        .fail( (rtn) => {
            $('.error_ul').html('システムエラーが発生しました。');
            return false;
        })

        // Ajaxリクエストが成功・失敗どちらでも発動
        .always( (data) => {
        });


        //ラジオボタンが押されたらチェックされた値とテキストをhidden項目にセットする
        $(".content_wrap").on('click', '.test', function () {

            var sel_val = "";

            sel_val = $(this).attr('value');

            $('#ceu_id1').val(sel_val);

            url = '../inputAnswer/';
            $('form').attr('action', url);
            $('form').submit();
            
        });
    });


})(jQuery);
